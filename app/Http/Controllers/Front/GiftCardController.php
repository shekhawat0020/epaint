<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Models\Compare;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Collection;

class GiftCardController extends Controller
{

    public function index()
    {
        return view('front.gift-card');
    }


    public function addToCart(Request $request)
    {
       // Session::forget('cart');
        $errors = [];
        if (!isset($request->term)){
            $errors[] = 'Please Agree term and Conditions';            
        }
        if (!isset($request->card_type)){
            $errors[] = 'Please select card type';            
        }

        if ($request->shipping_country == ""){
            $errors[] = 'Please select shipping country';            
        }

        if ($request->gift_amount == ""){
            $errors[] = 'Please enter Gift amount';            
        }
        if ($request->recipiant_name == ""){
            $errors[] = 'Please enter Recipiant Name';            
        }

        if ($request->recipiant_email == ""){
            $errors[] = 'Please enter Recipiant Email';            
        }

        if ($request->confirm_recipiant_email == ""){
            $errors[] = 'Please enter Confirm Recipiant Email';            
        }

        if ($request->confirm_recipiant_email != $request->recipiant_email){
            $errors[] = 'Recipiant Email and Confirm Recipiant Email not same';            
        }

        

        if ($request->recipiant_message == ""){
            $errors[] = 'Please enter Recipiant Message';            
        }

        if ($request->sender_name == ""){
            $errors[] = 'Please enter Sender name';            
        }

        

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);


        if (isset( $cart->items[0])){
            $errors[] = 'An gift card already exist into the cart. please remove first from cart';            
        }

        if(!empty($errors)){
            return response()->json(array('errors' => $errors));
        }



        $prod = new Collection();
        $prod->id = 0;
        $prod->name = $request->card_type;
        $prod->photo = asset('assets/front/images/giftcard.webp');
        $prod->price = $request->gift_amount;
        $prod->type = "Gift Card";
        $prod->size_qty = "";
        $prod->size_price = 0;
        $prod->size = 0;
        $prod->color = 0;
        $prod->stock = 1;
        $prod->user_id = 0;
        //add recipt detail
        $prod->recipiant_name = $request->recipiant_name;
        $prod->recipiant_email = $request->recipiant_email;
        $prod->recipiant_message = $request->recipiant_message;
        $prod->sender_name = $request->sender_name;

      
        

        $size = "";
        $color = "";
        $keys = "";
        $values = "";
        $cart->add($prod, 0,$size, $color, $keys, $values);
        $cart->totalPrice = 0;
        foreach($cart->items as $data)
        $cart->totalPrice += $data['price'];

        Session::put('cart',$cart);
        $data[0] = count($cart->items);        
        return response()->json($data);  
     

    }

}