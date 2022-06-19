@extends('admin.admin_master')
@section('admin')
<x-app-layout>
    

<style>
body{
    
    background:#eee;
}

.invoice {
    background: #fff;
    padding: 20px
}

.invoice-company {
    font-size: 20px
}

.invoice-header {
    margin: 0 -20px;
    background: #f0f3f4;
    padding: 20px
}

.invoice-date,
.invoice-from,
.invoice-to {
    display: table-cell;
    width: 1%
}

.invoice-from,
.invoice-to {
    padding-right: 20px
}

.invoice-date .date,
.invoice-from strong,
.invoice-to strong {
    font-size: 16px;
    font-weight: 600
}

.invoice-date {
    text-align: right;
    padding-left: 20px
}

.invoice-price {
    background: #f0f3f4;
    display: table;
    width: 100%
}

.invoice-price .invoice-price-left,
.invoice-price .invoice-price-right {
    display: table-cell;
    padding: 20px;
    font-size: 20px;
    font-weight: 600;
    width: 75%;
    position: relative;
    vertical-align: middle
}

.invoice-price .invoice-price-left .sub-price {
    display: table-cell;
    vertical-align: middle;
    padding: 0 20px
}

.invoice-price small {
    font-size: 12px;
    font-weight: 400;
    display: block
}

.invoice-price .invoice-price-row {
    display: table;
    float: left
}

.invoice-price .invoice-price-right {
    width: 25%;
    background: #2d353c;
    color: #fff;
    font-size: 28px;
    text-align: right;
    vertical-align: bottom;
    font-weight: 300
}

.invoice-price .invoice-price-right small {
    display: block;
    opacity: .6;
    position: absolute;
    top: 10px;
    left: 10px;
    font-size: 12px
}

.invoice-footer {
    border-top: 1px solid #ddd;
    padding-top: 10px;
    font-size: 10px
}

.invoice-note {
    color: #999;
    margin-top: 80px;
    font-size: 85%
}

.invoice>div:not(.invoice-footer) {
    margin-bottom: 20px
}

.btn.btn-white, .btn.btn-white.disabled, .btn.btn-white.disabled:focus, .btn.btn-white.disabled:hover, .btn.btn-white[disabled], .btn.btn-white[disabled]:focus, .btn.btn-white[disabled]:hover {
    color: #2d353c;
    background: #fff;
    border-color: #d9dfe3;
}

</style>

<div class="page-wrapper">
<div class="page-content">
<div class="card radius-10">
<div class="card-body">
<h5 class="mb-0" style="font-weight: bold; text-align:center;">Reciept</h5>
<div class="container" style="margin-top:50px;">
   <div class="col-md-12">
      <div class="invoice">
         <!-- begin invoice-company -->
         <div class="invoice-company text-inverse f-w-600">
         Lmuted, Inc
            <span class="pull-right hidden-print">
            </span>
            
         </div>
         <!-- end invoice-company -->
         <!-- begin invoice-header -->
         <div class="invoice-header">
            <div class="invoice-from">
               <small>from</small>
               <address class="m-t-5 m-b-5">
                  <strong class="text-inverse">L-muted, Inc.</strong><br>
                  No.100 Jalan Pcl18,<br>
                  Lorong 1,<br>
                  Johor Bahru, 81300<br>
                  Phone: (011) 123-3290<br>
                  Fax: (012) 624-5190
               </address>
            </div>
         
            <div class="invoice-to">
               <small>to</small>
               <address class="m-t-5 m-b-5">
                  <strong class="text-inverse">{{$order[0]->Username}}</strong><br>
                  {{$order[0]->Address}}<br>
               </address>
            </div>
           
            <div class="invoice-date">
               <small>Receipt</small>
               <div class="date text-inverse m-t-5">{{$order[0]->DateTime}}</div>
               <div class="invoice-detail">Order ID:
               {{$order[0]->OrderID}}<br>
               Status: <span class="badge rounded-pill bg-warning text-dark">{{$order[0]->Status}}</span><br>
                  Services Product
               </div>
            </div>
         </div>
         <!-- end invoice-header -->
         <!-- begin invoice-content -->
         <div class="invoice-content">
            <!-- begin table-responsive -->
            <div class="table-responsive">
               <table class="table table-invoice">
                  <thead>
                     <tr>
                         <th>Products</th>
                        <th></th>
                        <th class="text-center" width="10%">Qty</th>
                        <th class="text-center" width="10%">Price</th>
                        <th class="text-right" width="20%">LINE TOTAL</th>
                     </tr>
                  </thead>
                  @foreach($order as $product)
                  <tbody>
                     <tr>
                         <td><img src="{{$product['PrtImage']}}" style="width:150px;height:150px;"/></td>
                        <td>
                        
                           <small>{{$product['PrtName']}}</small>
                        </td>
                        <td class="text-center">{{$product['PrtQty']}}</td>
                        <td class="text-center">{{$product['PrtPrice']}}</td>
                        <td class="text-right">{{($product['PrtQty']*$product['PrtPrice'])}}</td>
                     </tr>
                  </tbody>
                  @endforeach
               </table>
            </div>
            <!-- end table-responsive -->
            <!-- begin invoice-price -->
            <div class="invoice-price">
               <div class="invoice-price-left">
                  <div class="invoice-price-row">
                     <div class="sub-price">
                        <small>SUBTOTAL</small>
                        <span class="text-inverse">RM{{$order[0]->TotalPrice}}</span>
                     </div>
                  
                  </div>
               </div>
               <div class="invoice-price-right">
                  <small>TOTAL</small> <span class="f-w-600">RM{{$order[0]->TotalPrice}}</span>
               </div>
            </div>
            <!-- end invoice-price -->
         </div>
         <!-- end invoice-content -->
         <!-- begin invoice-note -->
         <div class="invoice-note">
            * Make all cheques payable to L-MUTED<br>
            * 100% Guaranteed goods will be shipping out between 5 working days.<br>
            * If you have any questions concerning this invoice, contact  WengHong, 011-12341411, Lmuted@gmail.com
         </div>
         <!-- end invoice-note -->
         <!-- begin invoice-footer -->
         <div class="invoice-footer">
            <p class="text-center">
               <span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i> Lmuted.com</span>
               <span class="m-r-10"><i class="fa fa-fw fa-lg fa-phone-volume"></i> T:011-12341411</span>
               <span class="m-r-10"><i class="fa fa-fw fa-lg fa-envelope"></i> Lmuted@gmail.com</span>
            </p>
         </div>
         <!-- end invoice-footer -->
      </div>
   </div>
</div>




<div>
</div>
</div>
</div>
</div>

    </div>
</x-app-layout>