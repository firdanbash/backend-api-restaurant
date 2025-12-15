<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Http\Resources\PaymentCollection;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new PaymentCollection(Payment::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $filename = time() . '_' . uniqid() . '.' . $logo->getClientOriginalExtension();
            $logo->storeAs('payments', $filename, 'public');
            $data['logo'] = $filename;
        } else {
            $data['logo'] = 'default-payment.png';
        }

        $payment = Payment::create($data);
        return new PaymentCollection(collect()->push($payment));
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        return new PaymentCollection(collect([$payment]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            if ($payment->logo && $payment->logo !== 'default-payment.png' && Storage::disk('public')->exists('payments/' . $payment->logo)) {
                Storage::disk('public')->delete('payments/' . $payment->logo);
            }

            $logo = $request->file('logo');
            $filename = time() . '_' . uniqid() . '.' . $logo->getClientOriginalExtension();
            $logo->storeAs('payments', $filename, 'public');
            $data['logo'] = $filename;
        }

        $payment->update($data);
        return new PaymentCollection(collect([$payment]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        if ($payment->logo && $payment->logo !== 'default-payment.png' && Storage::disk('public')->exists('payments/' . $payment->logo)) {
            Storage::disk('public')->delete('payments/' . $payment->logo);
        }

        $payment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Payment deleted successfully',
        ]);
    }
}
