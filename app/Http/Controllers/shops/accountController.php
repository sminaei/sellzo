<?php

namespace App\Http\Controllers\shops;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class accountController extends Controller
{
    public function show(){
        $customers = Auth::user();
        return response()->json(['customers' => $customers]);
    }
    public function update(Request $request){
     $customers = Auth::user(); //دریافت اطلاعات کاربری کاربر وارد شده
        $data= $request->validate([
            'name' => 'required',
            'phone_number' => 'required|unique' . $customers->id,
            'password' => 'nullable|min:6'
        ]);
        $customers->update($data);
        return response()->json(['customers' => $customers]);

    }
}
