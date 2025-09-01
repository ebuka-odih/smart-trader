<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KycController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // For now, we'll show a demo KYC status
        // In a real application, you'd fetch this from a KYC model
        $kycStatus = [
            'personal_info' => [
                'full_name' => $user->name ?? '',
                'email' => $user->email ?? '',
                'phone' => $user->phone ?? '',
                'date_of_birth' => '',
                'nationality' => '',
                'status' => 'completed'
            ],
            'address_info' => [
                'street_address' => '',
                'city' => '',
                'state' => '',
                'postal_code' => '',
                'country' => '',
                'status' => 'pending'
            ],
            'id_info' => [
                'id_type' => '',
                'id_number' => '',
                'id_front' => '',
                'id_back' => '',
                'selfie' => '',
                'status' => 'pending'
            ],
            'overall_status' => 'pending'
        ];
        
        return view('dashboard.kyc.index', compact('user', 'kycStatus'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date_of_birth' => 'required|date',
            'nationality' => 'required|string|max:255',
            'street_address' => 'required|string|max:500',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'id_type' => 'required|string|in:passport,national_id,drivers_license',
            'id_front' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'id_back' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'selfie' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        // Handle file uploads
        if ($request->hasFile('id_front')) {
            $validated['id_front'] = $request->file('id_front')->store('kyc', 'public');
        }
        if ($request->hasFile('id_back')) {
            $validated['id_back'] = $request->file('id_back')->store('kyc', 'public');
        }
        if ($request->hasFile('selfie')) {
            $validated['selfie'] = $request->file('selfie')->store('kyc', 'public');
        }
        
        // In a real application, you'd save this to a KYC model
        // For now, we'll just redirect with success message
        
        return redirect()->route('user.kyc.index')->with('success', 'KYC information submitted successfully! Your application is under review.');
    }
}
