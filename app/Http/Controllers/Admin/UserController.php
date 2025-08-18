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
       return view('admin.user.show', compact('user'));
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



}
