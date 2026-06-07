<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::latest()->get();
        return view('admin.campaigns.index', compact('campaigns'));
    }

    public function create()
    {
        return view('admin.campaigns.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|in:kesehatan,bencana,pendidikan',
            'target_amount' => 'required|numeric|min:1',
            'days_remaining' => 'required|numeric|min:1',
            'description' => 'required|string',
            'donation_options' => 'required|array|min:1',
            'donation_options.*' => 'required|numeric|min:1',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $campaign = new Campaign();
        $campaign->title = $request->title;
        $campaign->slug = Str::slug($request->title) . '-' . time();
        $campaign->category = $request->category;
        $campaign->target_amount = $request->target_amount;
        $campaign->days_remaining = $request->days_remaining;
        $campaign->description = $request->description;
        
        // Clean options: sorting ascending
        $options = array_map('intval', $request->donation_options);
        sort($options);
        $campaign->donation_options = $options;

        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/campaigns');
            
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            
            $image->move($destinationPath, $name);
            $campaign->thumbnail = '/uploads/campaigns/' . $name;
        } else {
            // Default based on category if no thumbnail uploaded
            $campaign->thumbnail = '/images/campaign_' . ($request->category === 'kesehatan' ? 'medical' : ($request->category === 'bencana' ? 'disaster' : 'education')) . '.png';
        }

        $campaign->save();

        return redirect()->route('admin.campaigns.index')->with('success', 'Kampanye berhasil dibuat!');
    }

    public function edit(Campaign $campaign)
    {
        return view('admin.campaigns.edit', compact('campaign'));
    }

    public function update(Request $request, Campaign $campaign)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|in:kesehatan,bencana,pendidikan',
            'target_amount' => 'required|numeric|min:1',
            'days_remaining' => 'required|numeric|min:1',
            'description' => 'required|string',
            'donation_options' => 'required|array|min:1',
            'donation_options.*' => 'required|numeric|min:1',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|string|in:active,completed,draft',
        ]);

        // Only update slug if title changed
        if ($campaign->title !== $request->title) {
            $campaign->slug = Str::slug($request->title) . '-' . time();
        }
        $campaign->title = $request->title;
        $campaign->category = $request->category;
        $campaign->target_amount = $request->target_amount;
        $campaign->days_remaining = $request->days_remaining;
        $campaign->description = $request->description;
        $campaign->status = $request->status;

        $options = array_map('intval', $request->donation_options);
        sort($options);
        $campaign->donation_options = $options;

        if ($request->hasFile('thumbnail')) {
            // Delete old file if exists and not default
            if ($campaign->thumbnail && !str_starts_with($campaign->thumbnail, '/images/')) {
                $oldPath = public_path($campaign->thumbnail);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            $image = $request->file('thumbnail');
            $name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/campaigns');
            
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            
            $image->move($destinationPath, $name);
            $campaign->thumbnail = '/uploads/campaigns/' . $name;
        }

        $campaign->save();

        return redirect()->route('admin.campaigns.index')->with('success', 'Kampanye berhasil diperbarui!');
    }

    public function destroy(Campaign $campaign)
    {
        if ($campaign->thumbnail && !str_starts_with($campaign->thumbnail, '/images/')) {
            $oldPath = public_path($campaign->thumbnail);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }
        }

        $campaign->delete();

        return redirect()->route('admin.campaigns.index')->with('success', 'Kampanye berhasil dihapus!');
    }
}
