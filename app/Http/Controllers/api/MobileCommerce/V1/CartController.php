<?php

namespace App\Http\Controllers\api\MobileCommerce\V1;

use App\Http\Controllers\Controller;
use App\Models\Carts;
use Illuminate\Http\Request;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;

class CartController extends Controller
{

    public function index(Request $request) {
        
        $cart = Carts::where('user_id', '=', $request->user_id)
            ->with('product')
            ->get();
        
        if ($cart) {
            return ResponseBuilder::success($cart);
        } else {
            return ResponseBuilder::error(404, null, [
                'message' => 'Cart Error',
            ]);
        }
    }

    public function addCart(Request $request) {
        $request->validate([
            'user_id'       => ['required', 'integer'],
            'product_id'    => ['required', 'integer'],
            'quantity'      => ['required', 'integer'],
            // 'image'         => ['required', 'string'],
            // 'product_name'  => ['required', 'string'],
            // 'total_price'   => ['required'],
        ]);

        $cart = Carts::where('user_id', $request->user_id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($cart) {
            // $user->update($request->only(['quantity', 'total_price']));
            $cart->update($request->only(['quantity']));
            return ResponseBuilder::success([
                'value' => 'successfully updated',
                'id' => $cart->id,
            ]);

        } else {
            $newCart = Carts::create($request->all());
            return ResponseBuilder::success([
                'value' => 'successfully added',
                'id' => $newCart->id,
            ]);
        }
    }


    public function updateCart(Request $request) {

        $cart = Carts::where('id', $request->cart_id)->first();

        if ($cart) {

            if ($request->add == 1) { // Plus quantity

                $cart->update([
                    'quantity' => $cart->quantity + 1
                ]);
    
                return ResponseBuilder::success([
                    'value' => 'successfully increased',
                    'cart_id' => $cart->id,
                    'quantity' => $cart->quantity,
                    'total_price' => $cart->total_price,
                ]);
                
            } else if ($request->add == 0) { // reduce quantity
    
                if ($cart->quantity == 1) { // remove cart if quantity is 0
                    $cart->delete();
    
                    return ResponseBuilder::success([
                        'value' => 'successfully deleted',
                        'cart_id' => $cart->id,
                    ]);
    
                } else {
                    $cart->update([
                        'quantity' => $cart->quantity - 1
                    ]);
                    return ResponseBuilder::success([
                        'value' => 'successfully decreased',
                        'cart_id' => $cart->id,
                        'quantity' => $cart->quantity,
                        'total_price' => $cart->total_price,
                    ]);
                }
            } else {
                return ResponseBuilder::error(404, null, [
                    'message' => 'Actions not clear',
                ]);
            }
        } else {
            return ResponseBuilder::error(404, null, [
                'message' => 'Product on this cart not exist',
            ]);
        }
    }

    
}
