<?php

namespace App\Http\Controllers;

//Author:Wong Weng Hong

use Illuminate\Support\Facades\Auth;
use App\Repositories\CartCal;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Validation;
use Illuminate\Http\Request;
use App\Models\ProductList;
use App\Models\ProductDetails;
use App\Models\Cart;
use App\Models\Orders;

class CartController extends Controller
{
    public function index(){
        if(Auth::user()->roleID ==2){ //admin
            $adminName = Auth::user()->name;          
           // session(['username'=> $adminName]);
            session()->put(['username'=>$adminName]);
          return view('admin.index');
        }
        elseif(Auth::user()->roleID ==1)//customer
        {
          return redirect('/');
        }
        else{
          return redirect('login');
        }
    }

    public function AddToCart(Validation $request){
        
        $prtID = $request->prtID;
        
        $username = Auth::user()->email;
        
     
        $productList = ProductList::where('id',$prtID)->get();

        foreach($productList as $product){
           $productTitle = $product['title'];
           $productPrice= $product['price'];
           $productImage = $product['image'];
           
        }

        if (Cart::where('Username', '=', $username)->exists()) {
            if (Cart::where('PrtID', '=', $prtID)->exists()) {

                $cart = Cart::where('PrtID',$prtID)->get();

                foreach($cart as $qty){
                    $productQty = $qty['PrtQty'];
                 }

                $prtExits = ((int)($request->qty)+ (int)$productQty);


                Cart::where('PrtID',$prtID)->update([
                    'PrtQty' =>  $prtExits,
                ]);

            }else{
                Cart::insert([
                    'Username' => $username,
                    'PrtID' => $request->prtID,
                    'PrtName' => $productTitle,
                    'PrtQty' =>  $request->qty,
                    'PrtPrice' => $productPrice,
                    'PrtImage' => $productImage,
                ]);
            }

        }else{
            Cart::insert([
                'Username' => $username,
                'PrtID' => $request->prtID,
                'PrtName' => $productTitle,
                'PrtQty' =>  $request->qty,
                'PrtPrice' => $productPrice,
                'PrtImage' => $productImage,
            ]);
        }


       

        if($username!=null){
            $cart = Cart::where('Username',$username)->get();
            $ProductDetails= ProductDetails::all();
            $total =  CartCal::sum();   
        }


        return view('user.pages.Cart',compact('cart','ProductDetails','total'));
    }


    public function RemoveCart($id){

        $username = Auth::user()->email;
        
        if (Cart::where('Username', '=', $username)->exists()) {
            Cart::where('PrtID', $id)->delete();
        }

        if($username!=null){
            $cart = Cart::where('Username',$username)->get();
            $ProductDetails= ProductDetails::all();
            $total =  CartCal::sum();   
        }


        
        return view('user.pages.cart',compact('cart','ProductDetails','total'));

    }

    public function Cart(){

        $username = Auth::user()->email;

        if($username!=null){
        // $cart = Cart::where('Username',$username)->get();
        $ProductDetails= ProductDetails::all();
        
        
        $cart = CartCal::cartItems($username);
        $total =  CartCal::sum();   
    
        }

        
        


        return view('user.pages.cart',compact('cart','ProductDetails','total'));
    }

    public function Payment(){

        $username = Auth::user()->email;

        if($username!=null){
            $cart = CartCal::cartItems($username);
        }


        return view('user.pages.payment',compact('cart'));
    }


    public function PlaceOrder(Validation $request){

        $username = Auth::user()->email;
        $orderID = rand(100000, 999999);
        $dateTime = date("Y-m-d H:i:s");
        $address = $request->name.", ".$request->address." ".$request->city." ".$request->state." ".$request->zipCode;

        if($username!=null){
        $cart = Cart::where('Username',$username)->get();

        foreach ($cart as $product) {

            Orders::insert([
                'OrderID' => $orderID,
                'PrtID' => $product->PrtID,
                'Username' => $username,
                'PrtName' => $product->PrtName,
                'PrtQty' => $product->PrtQty,
                'PrtPrice' => $product->PrtPrice,
                'PrtImage' => $product->PrtImage,
                'TotalPrice' => $request->totalPrice,
                'Status' => 'TOSHIP',
                'Address' => $address,
                'DateTime' =>  $dateTime,
            ]);
            $productDetails = ProductDetails::where('product_id',$product->PrtID)->get();
            
            foreach($productDetails as $productDetail){
                $productQty = $productDetail['quantity'];
             }

            
            ProductDetails::where('product_id',$product->PrtID)->update([
                'quantity' => (($productQty)-($product->PrtQty)),
            ]);

            if (Cart::where('Username', '=', $username)->exists()) {
                Cart::where('PrtID',$product->PrtID)->delete();
            }
        
        }

        if (Orders::where('Username', '=', $username)->exists()) {
            $order =  Orders::where('OrderID', $orderID)->get();
        }
    }
 
        // return view('user.pages.Receipt',compact('order'));
        return redirect()->route('Receipt', $orderID);
    }


    public function Receipt($orderID){
        $username = Auth::user()->email;
        if (Orders::where('Username', '=', $username)->exists()) {
            $order =  Orders::where('OrderID', $orderID)->get();
        }

        return view('user.pages.Receipt',compact('order'));
    }

    public function ReceiptAdmin($orderID){
        $order =  Orders::where('OrderID', $orderID)->get();

        return view('backend.Orders.reciept_Admin',compact('order'));
    }

    public function ReceiptApi($orderID){

      
            $order =  Orders::where('OrderID', $orderID)->get();
        

        return $order;
    }

    public function ReceiptApiAdmin($orderID){
        $order =  Orders::where('OrderID', $orderID)->get();

        return $order;
    }

    public function GenerateXSLT($orderID){
        $username = Auth::user()->email;


        if (Orders::where('Username', '=', $username)->exists()) {
            $order =  Orders::where('OrderID', $orderID)->get();
        }
        $xml = new \XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
      // Start a new document
        $xml->startDocument();

        $xml->writePI('xml-stylesheet', 'href="/xslt-receipt-route?" type="text/xsl"');
 
        

      // Start a element to put data in
        $xml->startElement('receipt');

       
      


        $xml->startElement('username');
        $xml->writeRaw($order[0]->Username);
        $xml->endElement();

        $xml->startElement('address');
        $xml->writeRaw($order[0]->Address);
        $xml->endElement();

        $xml->startElement('dateTime');
        $xml->writeRaw($order[0]->DateTime);
        $xml->endElement();

        $xml->startElement('orderID');
        $xml->writeRaw($order[0]->OrderID);
        $xml->endElement();

        $xml->startElement('status');
        $xml->writeRaw($order[0]->Status);
        $xml->endElement();

        
            
      // Data what goes in your element\
        foreach ($order as $product) {
          $xml->startElement('productList');
          


                $xml->startElement('name');
                $xml->writeRaw($product->PrtName);
                $xml->endElement();

                $xml->startElement('quantity');
                $xml->writeRaw($product->PrtQty);
                $xml->endElement();

                $xml->startElement('price');
                $xml->writeRaw($product->PrtPrice);
                $xml->endElement();

                $xml->startElement('linePrice');
                $xml->writeRaw(($product->PrtQty * $product->PrtPrice));
                $xml->endElement();
     
          $xml->endElement();
        }

        $xml->startElement('totalPrice');
        $xml->writeRaw($order[0]->TotalPrice);
        $xml->endElement();

        $xml->endElement();
        $xml->endDocument();
  
      // You put the XML content in this variable
      $contents = $xml->outputMemory();
      // Reset XML just in case
      $xml = null;
  
      
    //   Storage::put('productList.xml',$contents);

      
      if(!Storage::disk('public_uploads')->put('receipt.xml', $contents)) {
        return false;
      }


       return redirect(asset('xml/receipt.xml'));
      
    }




}
