<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Cart;
use App\Model\Order;
use App\Model\Product;
use App\User;
use App\Model\Transporter;

use Auth;

class CartController extends Controller
{
    public function cart()
    {
        return Cart::with('products.options.option_name')->where('user_id', Auth::user()->id)->get();
    }

    public function setCart(Request $request)
    {
        $user_id = Auth::user()->id;
        Cart::clearCart($user_id);

        $cart = Cart::Create(['restaurant_id' => $request->restaurant_id, 'user_id' =>  $user_id]);
        //dd($cart->products());

        foreach ($request->products as $product) {
            $real_product = Product::FindOrFail($product['id']);
            $cart_product = $cart->products()->create(['product_id' => $real_product->id, 'count' => $product['count']]);

            foreach ($product['options'] as $package) {

                foreach ($package['options'] as $option) {

                    $cart_product->options()->create(['cart_product_id' => $cart_product->id, 'option_id' => $package['id'], 'option' => $option]);
                }
            }

            //dd($cart_product->options());
        }

        return $this->success_message();
    }

    public function addToCart(Request $request)
    {
        $user_id = Auth::user()->id;

        $cart = Cart::clearCart($user_id, false, $request->restaurant_id);

        if ($cart == null) {
            return json_encode(['message' => 'you input may have an error']);
        }

        $product = $request->product;

        $real_product = Product::FindOrFail($product['id']);
        $cart_product = $cart->products()->create(['product_id' => $real_product->id, 'count' => $product['count']]);

        foreach ($product['options'] as $package) {

            foreach ($package['options'] as $option) {

                $cart_product->options()->create(['cart_product_id' => $cart_product->id, 'option_id' => $package['id'], 'option' => $option]);
            }
        }

        return $this->success_message();
    }

    public function clearCart()
    {
        $user_id = Auth::user()->id;
        Cart::clearCart($user_id);
        return $this->success_message();
    }

    public function makeOrder(Request $request)
    {
        $user_id = Auth::user()->id;
        $cart = Cart::with('products.options')->where('restaurant_id', $request->restaurant_id)->where('user_id',  $user_id)->get()->last();

        if ($cart == null) {
            return json_encode(['message' => 'you should add cart first']);
        }

        $order = new Order();
        $order->user_id = $user_id;
        $order->restaurant_id = $cart->restaurant->id;
        $order->address_source = $cart->restaurant->address;
        $order->position_source = $cart->restaurant->position;
        $order->fill($request->all());
        $order->save();

        //return ($cart->products);


        foreach ($cart->products as $product) {
            //return $product;
            $_product = $order->details()->create(['product_id' => $product->product_id, 'count'=> $product->count, 'custom' => '']);

            //


            // return $_product;
            //$real_product = Product::FindOrFail($product['id']);
            //$cart_product = $cart->products()->create(['product_id' => $real_product->id, 'count' => $product['count']]);

            foreach ($product['options'] as $package) {
                
                $_option = $_product->options()->create(['order_detail_id' => $_product->id, 'option_id' => $package->option_id, 'option' => $package->option]);
                //foreach ($package['options'] as $option) {

                //    $cart_product->options()->create(['cart_product_id' => $cart_product->id, 'option_id' => $package['id'], 'option' => $option]);
                //}
            }

            //dd($cart_product->options());
        }

        Cart::clearCart($user_id);

        $transporter = Transporter::where('active', true)->where('assigment_order_id', null)->first();
        if($transporter != null)
        {
            $transporter->assigment_order_id = $order->id;
            $transporter->save();
            $order->transporter_id = $transporter->id;
            $order->save();
        }

        return $this->success_message();
    }

    private function success_message()
    {
        return json_encode(['message' => 'success']);
    }
}
