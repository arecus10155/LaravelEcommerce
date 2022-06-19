<?php
//Author: Loh Wei Sheng
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
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
}
