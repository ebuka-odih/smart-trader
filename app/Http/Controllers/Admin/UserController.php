<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   public function index()
   {
       $users = User::latest()->get();
       return view('admin.user.list', compact('users'));
   }

   public function show($id)
   {
       $user = User::findOrFail($id);
       
       // Get KYC status for the user (using the same structure as KycController)
       $kycStatus = [
           'personal_info' => [
               'full_name' => $user->name ?? '',
               'email' => $user->email ?? '',
               'phone' => $user->phone ?? '',
               'date_of_birth' => $user->date_of_birth ?? '',
               'nationality' => $user->nationality ?? '',
               'status' => $user->date_of_birth && $user->nationality ? 'completed' : 'pending'
           ],
           'address_info' => [
               'street_address' => $user->street_address ?? '',
               'city' => $user->city ?? '',
               'state' => $user->state ?? '',
               'postal_code' => $user->postal_code ?? '',
               'country' => $user->country ?? '',
               'status' => $user->street_address && $user->city && $user->state && $user->postal_code ? 'completed' : 'pending'
           ],
           'id_info' => [
               'id_type' => $user->id_type ?? '',
               'id_number' => $user->id_number ?? '',
               'id_front' => $user->id_front ?? '',
               'id_back' => $user->id_back ?? '',
               'selfie' => $user->selfie ?? '',
               'status' => $user->id_type && $user->id_front && $user->id_back ? 'completed' : 'pending'
           ],
           'overall_status' => 'pending'
       ];
       
       // Determine overall status
       $completedSections = 0;
       if ($kycStatus['personal_info']['status'] === 'completed') $completedSections++;
       if ($kycStatus['address_info']['status'] === 'completed') $completedSections++;
       if ($kycStatus['id_info']['status'] === 'completed') $completedSections++;
       
       if ($completedSections === 3) {
           $kycStatus['overall_status'] = 'completed';
       } elseif ($completedSections > 0) {
           $kycStatus['overall_status'] = 'in_progress';
       }
       
       return view('admin.user.show', compact('user', 'kycStatus'));
   }

    public function updateBalance(Request $request, $id)
    {
        $request->validate([
            'balance' => 'nullable|numeric|min:0',
            'profit' => 'nullable|numeric|min:0',
            'action_type' => 'required|in:add,defund',
        ]);

        $user = User::findOrFail($id);
        if ($request->action_type == 'add')
        {
            $user->balance += $request->balance;
            $user->profit += $request->profit;
            $user->save();
            return redirect()->back()->with('success', 'User Account Updated Successfully');
        }
         $user->balance -= $request->balance;
         $user->profit -= $request->profit;
         $user->save();
        return redirect()->back()->with('success', 'User Account Updated Successfully');
    }

   public function deleteUser($id)
   {
       $user = User::findOrFail($id);
       $user->delete();
       return redirect()->back()->with('success', 'User has been deleted');
   }

   public function updateStatus(Request $request, $id)
   {
       $request->validate([
           'status' => 'required|in:active,inactive',
       ]);

       $user = User::findOrFail($id);
       $user->status = $request->status;
       $user->save();

       $statusText = $request->status === 'active' ? 'activated' : 'deactivated';
       return redirect()->back()->with('success', "User account has been {$statusText} successfully");
   }

}
