<?php

namespace App\Http\Controllers;
//Author: Loh Wei Sheng

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Http\Controllers\Session;

class CustomerController extends Controller
{
    public function profile()
    {
        $customerData = Auth::user();
        return view('/user/pages/customer_profile', compact('customerData'));
    }

    public function CustomerLogout()
    {
        Auth::logout();
        session()->flush();
        return Redirect()->route('login');
    } //end method

    public function toCalc()
    {
        return view('/user/pages/installment_calc_Client');
    }

    public function installmentCalcAPI(Request $request)
    {

        $price = $request->price;
        $duration = $request->duration;
        $rate = $request->rate;
        $budget = $request->budget;

        $url = "http://localhost/WebService/lib/InstallCalRESTService.php?price=" . $price . "&duration=" . $duration . "&rate=" . $rate . "&budget=" . $budget;

        $client = curl_init($url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);

        $result = json_decode($response);
        
        return view('/user/pages/installment_calc_Client', compact('result', 'price', 'duration', 'rate', 'budget'));
    }

    public function redirectToShippingFeeCalculator()
    {
        return view('/user/pages/shippingFeeCalculator');
    }

    public function shippingFeeCalculatorApi(Request $request)
    {
        $from = $request->from;
        $to = $request->to;
        $weight = $request->weight;
        
        $url = "http://localhost/ShippingWebService/resource/CalculatorService.php?from=" . $from . "&to=" . $to . "&weight=" . $weight;

        $client = curl_init($url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);

        $result = json_decode($response);
        
        return view('/user/pages/shippingFeeCalculator', compact('result', 'from', 'to', 'weight'));
    }
}
