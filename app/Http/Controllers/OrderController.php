<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Traits\ApiResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    use ApiResponseTrait;
    public function create(OrderRequest $request){
        $status = false;
        $message = 'Orden creada.';

        try {
            DB::beginTransaction();
            // Crear el pedido
            $order = new Order;
            $order->total = $request->total; // 102.900.9 // 102.901
            $order->tax = $request->tax;
            $order->shipping_value = $request->shipping_value;
            $order->delivery_date = $request->delivery_date;
            $order->user_id = $request->user_id;
            $order->status_id  = $order->statuses['recibida'];
            $order->order_number  = Carbon::now()->timestamp;
            $order->save();

            // Crear detalles
            $details = [];
            foreach ($request->details as $key => $detail) {
                $order_detail = new OrderDetail;
                $order_detail->price = $detail["price"]; 
                $order_detail->price_with_discount = $detail["price_with_discount"]; 
                $order_detail->product_name = Product::find($detail["product_id"], ["name"])->name; 
                $order_detail->quantity = $detail["quantity"]; 
                $order_detail->tax = $detail["tax"]; 
                $order_detail->status_id = $order->status_id; 
                $order_detail->product_id = $detail["product_id"]; 
                $order_detail->order_id = $order->id; 
                $order_detail->save(); 

                array_push($details, $order_detail);
            }
          
            DB::commit();

            $status = true;
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            DB::rollBack();
        }


        if ($status) {
            $order->details = $details;
            return $this->responseApi($order , 'success', $message);
        }else{
            return $this->responseApi([], 'error', $message, $this->server_error);
        }
    }
}
