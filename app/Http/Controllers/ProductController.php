<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Traits\ApiResponseTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use ApiResponseTrait;
    public  function create(ProductRequest $request){
        $status = false;
        $message = '';
        try {

            if(Product::whereName($request->name)->exists()){
                throw new Exception("El producto ya existe.", 1);
            }
            $image_url = Storage::put("products", $request->file('image'));
            $data = [
                'name' => $request->name,
                'description' => $request->description,
                'image_url' => $image_url,
                'price' => $request->price,
                'slug' => Str::slug($request->name),
                'stock' => $request->stock,
                'status_id' => $request->status_id,
            ];

            $product =  Product::create($data);
            $status = true;
        } catch (\Throwable $th) {
            $message = $th->getMessage();
        }

        if($status){
            return $this->responseApi([
                'code' => $this->ok,
                'product' => $product
            ]);
        }else{
            return $this->responseApi([
                'message' => $message,
                'code' => 500,
            ],'error');
        }
    }
}
