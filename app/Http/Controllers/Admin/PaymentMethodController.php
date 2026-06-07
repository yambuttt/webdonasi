<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $paymentMethods = PaymentMethod::latest()->get();
        return view('admin.payment_methods.index', compact('paymentMethods'));
    }

    public function create()
    {
        return view('admin.payment_methods.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'type' => 'required|in:qris,bank',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'qris_image' => 'required_if:type,qris|nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'bank_name' => 'required_if:type,bank|nullable|string|max:100',
            'bank_account_number' => 'required_if:type,bank|nullable|string|max:100',
            'bank_account_name' => 'required_if:type,bank|nullable|string|max:150',
            'status' => 'nullable|in:0,1',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = 'logo_' . time() . '_' . Str::random(4) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/logos'), $filename);
            $logoPath = '/images/logos/' . $filename;
        }

        $qrisImagePath = null;
        if ($request->input('type') === 'qris' && $request->hasFile('qris_image')) {
            $file = $request->file('qris_image');
            $filename = 'qris_' . time() . '_' . Str::random(4) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/qris'), $filename);
            $qrisImagePath = '/images/qris/' . $filename;
        }

        PaymentMethod::create([
            'name' => $request->input('name'),
            'code' => Str::slug($request->input('name')) . '-' . Str::random(4),
            'type' => $request->input('type'),
            'logo' => $logoPath,
            'qris_image' => $qrisImagePath,
            'bank_name' => $request->input('type') === 'bank' ? $request->input('bank_name') : null,
            'bank_account_number' => $request->input('type') === 'bank' ? $request->input('bank_account_number') : null,
            'bank_account_name' => $request->input('type') === 'bank' ? $request->input('bank_account_name') : null,
            'status' => $request->input('status', '1') === '1',
        ]);

        return redirect()->route('admin.payment-methods.index')->with('success', 'Metode pembayaran berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        return view('admin.payment_methods.edit', compact('paymentMethod'));
    }

    public function update(Request $request, $id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'type' => 'required|in:qris,bank',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'qris_image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'bank_name' => 'required_if:type,bank|nullable|string|max:100',
            'bank_account_number' => 'required_if:type,bank|nullable|string|max:100',
            'bank_account_name' => 'required_if:type,bank|nullable|string|max:150',
            'status' => 'nullable|in:0,1',
        ]);

        $logoPath = $paymentMethod->logo;
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = 'logo_' . time() . '_' . Str::random(4) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/logos'), $filename);
            $logoPath = '/images/logos/' . $filename;
        }

        $qrisImagePath = $paymentMethod->qris_image;
        if ($request->input('type') === 'qris' && $request->hasFile('qris_image')) {
            $file = $request->file('qris_image');
            $filename = 'qris_' . time() . '_' . Str::random(4) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/qris'), $filename);
            $qrisImagePath = '/images/qris/' . $filename;
        }

        $paymentMethod->update([
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'logo' => $logoPath,
            'qris_image' => $request->input('type') === 'qris' ? $qrisImagePath : null,
            'bank_name' => $request->input('type') === 'bank' ? $request->input('bank_name') : null,
            'bank_account_number' => $request->input('type') === 'bank' ? $request->input('bank_account_number') : null,
            'bank_account_name' => $request->input('type') === 'bank' ? $request->input('bank_account_name') : null,
            'status' => $request->input('status', '1') === '1',
        ]);

        return redirect()->route('admin.payment-methods.index')->with('success', 'Metode pembayaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        $paymentMethod->delete();

        return redirect()->route('admin.payment-methods.index')->with('success', 'Metode pembayaran berhasil dihapus.');
    }
}
