<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Database\QueryException;

class ProductsController extends Controller
{
    public function listProducts(Request $request){
        try {
            return response()->json(Product::get());
        } catch (QueryException $e) {
            return response()->json([
                "error" => $e
            ]);
        }  
    }

    public function createProduct(Request $request){
        try {
            $product = new Product();
            $product->name = $request->name;
            $product->brand = $request->brand;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->stock_quantity = $request->stock_quantity;

            $product->save();

            return response()->json(['dados'=>$product,'status'=>1]);

        } catch (QueryException $e) {
            return response()->json([
                "error" => $e
            ]);
        }  
    }

    public function selectProductById(Request $request){
        try {
            $product = Product::where('id', '=', $request->id)->first();
            return response()->json($product);

        } catch (QueryException $e) {
            return response()->json([
                "error" => $e
            ]);
        }  
    }

    public function updateProduct(Request $request){
        try {
            $product = Product::find($request->id);
            $product->name = $request->name;
            $product->brand = $request->brand;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->stock_quantity = $request->stock_quantity;
            $product->save();
            //return 1;
            return response()->json(['dados'=>$product,'status'=>1]);

        } catch (QueryException $e) {
            return response()->json([
                "error" => $e
            ]);
        }  
    }

    
    public function deleteProduct(Request $request){
        try {
            Product::where('id',$request->id)->delete();

            return response()->json(['status'=>1]);
            
        } catch (QueryException $e) {
            return response()->json([
                "error" => $e
            ]);
        }
    }


}