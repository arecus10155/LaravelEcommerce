<?php
namespace App\Http\Controllers\Admin;

//Author:Tan Fu Wee

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Validation;

class OrdersController extends Controller
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

    //ADMIN
    public function GetAllOrders(){
        $orders =  Orders::Latest('id')->groupBy('OrderID')->paginate(10);

        return view('backend.Orders.orders_view',compact('orders'));
    }    

    public function UpdateOrders($OrderID){
        $orders = Orders::all()->where('OrderID',$OrderID);
        $status = array("TOSHIP","TORECEIVE","RECEIVED");

        return view('backend.Orders.orders_update',compact('orders', 'status'));
    }

    public function UpdateOrderProcess(Validation $request)
    {
        $request->validate([
            'orderID' => 'required',
            'orderStatus' => 'required',
        ],[
            'orderID.required' => 'Invalid OrderID',
            'orderStatus.required' => 'Invalid Order Status',
        ]);

        if(is_numeric($request->orderID) == false || ($request->orderStatus != "TOSHIP" && $request->orderStatus != "TORECEIVE" && $request->orderStatus != "RECEIVED" )){
            $notification = array(
                'message' => 'An error is encountered',
                'alert-type' => 'error'
            );
        }
        else{
            Orders::where('OrderID',  $request->orderID)->update([
                'Status' => $request->orderStatus
            ]);

            $notification = array(
                'message' => 'Order Updated Successfully',
                'alert-type' => 'success'
            );
        }

        return redirect()->route('all.orders')->with($notification);
    }

    //XML
    public function DownloadOrderXML()
    {
        $filepath = public_path()."/xml/orders.xml";

        return response()->download($filepath); 
    }

    public function GenerateOrderXML()
    {
        $orders = Orders::all();
        $xml = new \XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        // Start a new document
        $xml->startDocument();

        // Start a element to put data in
        $xml->startElement('orders');
        // Data what goes in your element\
        foreach ($orders as $order) {
            $xml->startElement('orders');
            $xml->writeAttribute('OrderID', $order->OrderID);

            $xml->startElement('OrderID');
            $xml->writeRaw($order->OrderID);
            $xml->endElement();

            $xml->startElement('Username');
            $xml->writeRaw($order->Username);
            $xml->endElement();

            $xml->startElement('TotalPrice');
            $xml->writeRaw($order->TotalPrice);
            $xml->endElement();

            $xml->startElement('Status');
            $xml->writeRaw($order->Status);
            $xml->endElement();

            $xml->startElement('Address');
            $xml->writeRaw($order->Address);
            $xml->endElement();

            $xml->startElement('DateTime');
            $xml->writeRaw($order->DateTime);
            $xml->endElement();

            $xml->startElement('created_at');
            $xml->writeRaw($order->created_at);
            $xml->endElement();

            $xml->startElement('updated_at');
            $xml->writeRaw($order->updated_at);
            $xml->endElement();

            $xml->endElement();
        }
        $xml->endElement();
        $xml->endDocument();

        // You put the XML content in this variable
        $contents = $xml->outputMemory();
        // Reset XML just in case
        $xml = null;

        if (!Storage::disk('public_uploads')->put('orders.xml', $contents)) {
            return false;
        }

        return redirect(asset('xml/orders.xml'));
    }

    public function GenerateOrder()
    {
        $orders = Orders::all();
        $xml = new \XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        // Start a new document
        $xml->startDocument();

        $xml->writePI('xml-stylesheet', 'href="/xslt-orders-route?" type="text/xsl"');

        // Start a element to put data in
        $xml->startElement('orders');
        // Data what goes in your element\
        foreach ($orders as $orders) {
            $xml->startElement('orders');
            
                $xml->startElement('OrderID');
                $xml->writeRaw($orders->OrderID);
                $xml->endElement();

                $xml->startElement('Username');
                $xml->writeRaw($orders->Username);
                $xml->endElement();

                $xml->startElement('TotalPrice');
                $xml->writeRaw($orders->TotalPrice);
                $xml->endElement();

                $xml->startElement('Status');
                $xml->writeRaw($orders->Status);
                $xml->endElement();

                $xml->startElement('Address');
                $xml->writeRaw($orders->Address);
                $xml->endElement();

                $xml->startElement('DateTime');
                $xml->writeRaw($orders->DateTime);
                $xml->endElement();

                $xml->startElement('created_at');
                $xml->writeRaw($orders->created_at);
                $xml->endElement();

                $xml->startElement('updated_at');
                $xml->writeRaw($orders->updated_at);
                $xml->endElement();

            $xml->endElement();
        }
        $xml->endElement();
        $xml->endDocument();

        // You put the XML content in this variable
        $contents = $xml->outputMemory();
        // Reset XML just in case
        $xml = null;

        if (!Storage::disk('public_uploads')->put('orders.xml', $contents)) {
            return false;
        }

        return redirect(asset('xml/orders.xml'));
    }

    //USER
    public function GetMyOrder(){
        $userEmail = Auth::user()->email;
        $orders =  Orders::Latest('id')->where('Username', '=', $userEmail)->groupBy('OrderID')->paginate(10);

        return view('user.pages.MyOrder',compact('orders'));
    }

    public function GetMyOrderTOSHIP(){
        $userEmail = Auth::user()->email;
        $orders =  Orders::Latest('id')->where([['Username', '=', $userEmail], ['Status', '=', "TOSHIP"]])->paginate(10);

        return view('user.pages.MyOrder',compact('orders'));
    }

    public function GetMyOrderTORECEIVE(){
        $userEmail = Auth::user()->email;
        $orders =  Orders::Latest('id')->where([['Username', '=', $userEmail], ['Status', '=', "TORECEIVE"]])->paginate(10);

        return view('user.pages.MyOrder',compact('orders'));
    }
 
    public function GetMyOrderRECEIVED(){
        $userEmail = Auth::user()->email;
        $orders =  Orders::Latest('id')->where([['Username', '=', $userEmail], ['Status', '=', "RECEIVED"]])->paginate(10);

        return view('user.pages.MyOrder',compact('orders'));
    }

    public function UpdateReceivedOrder($OrderID)
    {
        if($OrderID == NULL){
            $notification = array(
                'message' => 'An error is encountered',
                'alert-type' => 'error'
            );
        }
        else{
            Orders::where('OrderID', '=', $OrderID)->update([
                'Status' => 'RECEIVED',
            ]);

            $notification = array(
                'message' => 'Order Received Successfully',
                'alert-type' => 'success'
            );
        }

        return redirect()->route('my.order')->with($notification);
    }
}
