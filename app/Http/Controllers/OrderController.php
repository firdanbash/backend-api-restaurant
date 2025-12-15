<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderCollection;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'payment', 'orderProducts.product'])
            ->when(auth()->user()->role === 'kasir', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->latest()
            ->get();

        return new OrderCollection($orders);
    }

    public function store(StoreOrderRequest $request)
    {
        DB::beginTransaction();

        try {
            $validated = $request->validated();

            $totalPrice = collect($validated['items'])->sum(function ($item) {
                return $item['qty'] * $item['price'];
            });
            foreach ($validated['items'] as $item) {
                $product = Product::find($item['product_id']);
                if ($product->stock < $item['qty']) {
                    return response()->json([
                        'success' => false,
                        'message' => "Stok tidak cukup untuk produk: {$product->name}. Stok tersedia: {$product->stock}",
                    ], 422);
                }
            }

            $order = Order::create([
                'user_id' => auth()->id(),
                'payment_type_id' => $validated['payment_type_id'],
                'name' => $validated['name'],
                'total_price' => $totalPrice,
                'total_paid' => $validated['total_paid'],
                'total_return' => $validated['total_paid'] - $totalPrice,
                'receipt_code' => 'RCP-' . time() . '-' . strtoupper(substr(md5(uniqid()), 0, 6)),
            ]);

            foreach ($validated['items'] as $item) {
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'qty' => $item['qty'],
                    'total_price' => $item['qty'] * $item['price'],
                ]);

                Product::find($item['product_id'])->decrement('stock', $item['qty']);
            }

            DB::commit();

            $order->load(['user', 'payment', 'orderProducts.product']);

            return new OrderCollection(collect([$order]));
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat order: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function show(Order $order)
    {
        if (auth()->user()->role === 'kasir' && $order->user_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses ke order ini',
            ], 403);
        }

        $order->load(['user', 'payment', 'orderProducts.product']);
        return new OrderCollection(collect([$order]));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        if (auth()->user()->role === 'kasir' && $order->user_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses ke order ini',
            ], 403);
        }

        $validated = $request->validated();

        if (isset($validated['total_paid'])) {
            $validated['total_return'] = $validated['total_paid'] - $order->total_price;
        }

        $order->update($validated);
        $order->load(['user', 'payment', 'orderProducts.product']);

        return new OrderCollection(collect([$order]));
    }

    public function destroy(Order $order)
    {
        if (auth()->user()->role === 'kasir') {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki izin untuk menghapus order',
            ], 403);
        }

        foreach ($order->orderProducts as $item) {
            Product::find($item->product_id)->increment('stock', $item->qty);
        }

        $order->delete();

        return response()->json([
            'success' => true,
            'message' => 'Order deleted successfully',
        ]);
    }
}
