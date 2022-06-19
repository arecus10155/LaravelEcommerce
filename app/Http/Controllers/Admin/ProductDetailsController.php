<?php

namespace App\Http\Controllers\Admin;

//Author:NG SE CHIAN

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductDetails;
use App\Models\ProductList;

class ProductDetailsController extends Controller
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
    
    public function ShowDetails(Request $request){
        
        $id = $request->id;
        $productDetails = ProductDetails::where('product_id',$id)->get();
        $productList = ProductList::where('id',$id)->get();

        $item=[
            'productDetails_id' => $productDetails,
            'productList' => $productList,
        ];

        return view('user.pages.ProductDetails',compact('productList','productDetails'));
    }
}
