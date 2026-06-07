<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonationController extends Controller
{
    /**
     * Display a listing of donations.
     */
    public function index(Request $request)
    {
        $status = $request->query('status');
        
        $query = Donation::with('campaign')->latest();
        
        if ($status && in_array($status, ['pending', 'confirmed', 'cancelled'])) {
            $query->where('status', $status);
        }

        $donations = $query->paginate(15);

        return view('admin.donations.index', compact('donations', 'status'));
    }

    /**
     * Confirm the specified donation payment.
     */
    public function confirm($id)
    {
        $donation = Donation::findOrFail($id);

        if ($donation->status !== 'pending') {
            return redirect()->back()->with('error', 'Donasi ini sudah tidak berstatus pending.');
        }

        DB::transaction(function () use ($donation) {
            // Update donation status
            $donation->update(['status' => 'confirmed']);

            // Increment campaign target progress
            $campaign = $donation->campaign;
            $campaign->increment('current_amount', $donation->nominal);
        });

        return redirect()->back()->with('success', 'Pembayaran donasi berhasil dikonfirmasi dan saldo kampanye telah diperbarui.');
    }

    /**
     * Cancel the specified donation.
     */
    public function cancel($id)
    {
        $donation = Donation::findOrFail($id);

        if ($donation->status !== 'pending') {
            return redirect()->back()->with('error', 'Donasi ini sudah tidak berstatus pending.');
        }

        $donation->update(['status' => 'cancelled']);

        return redirect()->back()->with('success', 'Status donasi berhasil diubah menjadi dibatalkan.');
    }

    /**
     * Toggle the visibility of a donation comment.
     */
    public function toggleComment($id)
    {
        $donation = Donation::findOrFail($id);
        
        $donation->update([
            'is_comment_visible' => !$donation->is_comment_visible
        ]);

        $message = $donation->is_comment_visible ? 'Komentar/doa kini ditampilkan di halaman publik.' : 'Komentar/doa telah disembunyikan.';
        return redirect()->back()->with('success', $message);
    }
}
