<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Faker\Provider\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentMethodController extends Controller
{
   public function index()
   {
        $payment_method = PaymentMethod::all();
        return view('admin.payment-method', compact('payment_method'));
   }

   public function store(Request $request)
   {
       $validated = $request->validate([
           'wallet' => 'required',
           'address' => 'required',
           'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]);
       $wallet = new PaymentMethod();

       if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('files', 'public');
        }
       $wallet->wallet = $validated['wallet'];
       $wallet->address = $validated['address'];
       $wallet->avatar = $avatarPath ?? null;
       $wallet->save();
       return redirect()->back()->with('success', 'Payment Method Added');
   }

   public function update(Request $request, $id)
   {
       $validated = $request->validate([
           'wallet' => 'nullable',
           'address' => 'nullable',
           'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]);
       $wallet = PaymentMethod::findOrFail($id);
       if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('files', 'public');
        }
       $wallet->avatar = $avatarPath ?? null;
       $wallet->wallet = $request->wallet;
       $wallet->address = $request->address;
       $wallet->save();
       return redirect()->back()->with('success', 'Payment Method Updated');
   }

   public function destroy($id)
   {
       $wallet = PaymentMethod::findOrFail($id);
       $wallet->delete();
       return redirect()->back()->with('success', 'Payment Method Deleted');
   }
}
