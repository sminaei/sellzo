<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function index()
    {
        $products = Product::all(); //دریافت تمامی محصولات از پایگاه داده
        return response()->json(['products' => $products]);
    }
    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);
        $product = Product::create($data); //ایجاد محصول جدید
        return response()->json(['product' => $product],201);

    }
    public function update(Request $request,$id){
        $product = Product::findOrFail($id); //یافتن محصول با استفاده از شناسه
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);
        $product->update($data); //ویرایش اطلاعات محصول
        return response()->json(['product' => $product]);

    }
    public function destroy($id){
        $product = Product::findOrFail($id); //یافتن محصول با استفاده از شناسه
        $product->delete();
        return response()->json(['message' => 'محصول حذف شد']);

    }
}
