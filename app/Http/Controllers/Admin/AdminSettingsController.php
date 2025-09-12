<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateSystemSettingsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminSettingsController extends Controller
{
    public function index()
    {
        $admin = Auth::user();
        $systemSettings = $this->getSystemSettings();
        
        return view('admin.settings.index', compact('admin', 'systemSettings'));
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $admin = Auth::user();
        
        $data = $request->validated();
        
        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old profile image if exists
            if ($admin->profile_image && Storage::disk('public')->exists($admin->profile_image)) {
                Storage::disk('public')->delete($admin->profile_image);
            }
            
            $data['profile_image'] = $request->file('profile_image')->store('admin/profiles', 'public');
        }
        
        // Update password if provided
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }
        
        $admin->update($data);
        
        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully!'
        ]);
    }

    public function updateSystemSettings(UpdateSystemSettingsRequest $request)
    {
        $settings = $request->validated();
        
        // Update system settings in config or database
        foreach ($settings as $key => $value) {
            // You can store these in a settings table or config files
            // For now, we'll use a simple approach with config
            config([$key => $value]);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'System settings updated successfully!'
        ]);
    }

    private function getSystemSettings()
    {
        return [
            'site_name' => config('app.name', 'CryptBroker'),
            'site_email' => config('mail.from.address', 'admin@cryptbroker.com'),
            'maintenance_mode' => config('app.maintenance_mode', false),
            'registration_enabled' => config('auth.registration_enabled', true),
            'email_verification_required' => config('auth.email_verification_required', true),
            'max_file_upload_size' => config('app.max_file_upload_size', 2048), // in KB
            'default_currency' => config('app.default_currency', 'USD'),
            'timezone' => config('app.timezone', 'UTC'),
        ];
    }
}
