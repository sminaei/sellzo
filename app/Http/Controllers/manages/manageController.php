<?php

namespace App\Http\Controllers\manages;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;

class manageController extends Controller
{
    public function index()
    {
        $admins = Admin::all(); //دریافت تمامی ادمین ها از پایگاه داده
        return response()->json(['admins' => $admins]);
    }
    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'phone_number' => 'required|unique',
            'password' => 'required',
        ]);
        $admin = Admin::create($data); //ایجاد ادمین جدید
        return response()->json(['admin' => $admin], 201);
    }
    public function update(Request $request,$id){
        $admin = Admin::findOrFail($id); //یافتن ادمین با استفاده از شناسه
        $data = $request->validate([
            'name' => 'required',
            'phone_number' => 'required|unique' . $admin->id,
            'password' => 'required',
        ]);
        $admin->update($data); //ویرایش اطلاعات ادمین
        return response()->json(['admin' => $admin]);

    }
    public function destroy($id){
        $admin = Admin::findOrFail($id);
        $admin->delete(); //حذف کاربر
        return response()->json(['message' => 'کاربر حذف شد']);

    }
}
