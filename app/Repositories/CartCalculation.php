<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CartCalculation
{



    public function sum(){

        $username = Auth::user()->email;
        $productTotal = 0;

        if($username!=null){
            $cart = Cart::where('Username',$username)->get();
        }

        foreach($cart as $product){
        
           $productTotal += ($product['PrtPrice']*$product['PrtQty']);
        
        }   

	     $result = $productTotal;

         return $result;
    }

    public function cartItems($username){

        $cart = Cart::where('Username',$username)->get();

	    

         return $cart;
    }

   
}
?>