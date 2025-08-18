<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Trade;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::where('role', 'user')->count();
        $deposits  = Deposit::where('status', 1)->sum('amount');
        $withdrawal = Withdrawal::where('status', 1)->sum('amount');
        $traded = Trade::where('status', 'closed')->sum('amount');
        return view('admin.dashboard', compact('users', 'deposits', 'withdrawal', 'traded'));
    }

    public function security()
   {
       return view('admin.security');
   }

   public function resetPassword(Request $request)
    {

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['error' => 'Your current password is incorrect.']);
        }
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully!');
    }

}
