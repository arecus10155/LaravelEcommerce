<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductListController;
use App\Http\Controllers\Admin\ProductDetailsController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Models\Category;
use App\Repositories\CartCal;

Route::get('/', function () {
    return view('/user/pages/HomePage');
});

Route::get('/register', function () {
    return view('/auth/register');
})->name('register');

Route::get('admin/logout',[AdminController::class, 'AdminLogout'])->name('admin.logout');
Route::get('customer/logout',[CustomerController::class, 'CustomerLogout'])->name('customer.logout');

Route::middleware(['auth:sanctum', 'verified'])->prefix('admin')->group(function(){
    Route::get('/admin/profile',[AdminController::class, 'UserProfile'])->name('user.profile'); 
    
    Route::get('/addNew',[AdminController::class, 'AddNewAdmin'])->name('add.admin');
    
    Route::post('/store', [AdminController::class, 'StoreNewAdmin'])->name('store.admin');
    
    Route::get('/adminList', [AdminController::class,'getAllAdmin'])->name('admin.list');

    Route::get('/Download/AdminListXML',[AdminController::class, 'DownloadAdminListXML'])->name('downloadXML.adminList');

    Route::get('/customerList', [AdminController::class,'getAllCustomer'])->name('admin.custList');

    Route::get('/Download/customerList',[AdminController::class, 'DownloadCustomerListXML'])->name('downloadXML.customerList');

    Route::get('/adminsxml',function(){
        $admins = App\Models\User::all()->where('roleID',2);//admin
        return response()->xml(['Admins' => $admins->toArray()]);
    })->name('adminXML');

    Route::get('/customerXML',function(){
        $customers = App\Models\User::all()->where('roleID',1);//customer
        return response()->xml(['Customers' => $customers->toArray()]);
    })->name('custXML');

    
});




Route::group(['middleware' => 'auth'],function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
  
    Route::get('/customer/profile', [CustomerController::class, 'profile'])->name('customer.profile');

    Route::get('/customer/installmentCalculator', [CustomerController::class,'toCalc'])->name('customer.installmentCalc');

    Route::post('/Calculate',[CustomerController::class, 'installmentCalcAPI'])->name('installmentCalc.call');

    Route::post('/shippingFeeCalculator',[CustomerController::class, 'shippingFeeCalculatorApi'])->name('shippingFeeCalc.call');

    Route::get('/customer/ShippingFeeCalculateApi', [CustomerController::class,'redirectToShippingFeeCalculator'])->name('customer.shippingFeeCalc');

 });

Route::get('/',[CategoryController::class,'AllCat'])->name('all.category');

Route::view('/xslt-route', 'product')->name('xslt-route');

Route::view('/xslt-orders-route', 'orders')->name('xslt-orders-route');

Route::view('/xslt-receipt-route', 'receipt')->name('xslt-receipt');

Route::middleware(['auth:sanctum'])->prefix('category')->group(function(){

    Route::get('/all',[CategoryController::class, 'AllPrtCategory'])->name('all.categoryAdmin');

    Route::get('/add',[CategoryController::class, 'AddCategory'])->name('add.category');

    Route::post('/store',[CategoryController::class, 'StoreCategory'])->name('category.store');

    Route::get('/edit/{id}',[CategoryController::class, 'EditCategory'])->name('category.edit');

    Route::post('/update',[CategoryController::class, 'UpdateCategory'])->name('category.update');
    
    Route::get('/delete/{id}',[CategoryController::class, 'DeleteCategory'])->name('category.delete');

});

Route::middleware(['auth:sanctum'])->prefix('product')->group(function(){

    Route::get('/all',[ProductListController::class, 'GetAllProduct'])->name('all.product');

    Route::get('/add',[ProductListController::class, 'AddProduct'])->name('add.product');

    Route::post('/store',[ProductListController::class, 'StoreProduct'])->name('product.store');

    Route::post('/update',[ProductListController::class, 'UpdateProduct'])->name('update.product');

    Route::get('/edit/{id}',[ProductListController::class, 'EditProduct'])->name('edit.product');

    Route::get('/delete/{id}',[ProductListController::class, 'DeleteProduct'])->name('delete.product');

    Route::get('/ProductXSLT',[ProductListController::class, 'GenerateProduct'])->name('xslt.product');

    Route::get('/ProductXML',[ProductListController::class, 'GenerateXML'])->name('xml.product');

    Route::get('/Download/ProductXML',[ProductListController::class, 'DownloadXML'])->name('downloadXML.product');


});

Route::middleware(['auth:sanctum'])->prefix('orders')->group(function(){

    Route::get('/all',[OrdersController::class, 'GetAllOrders'])->name('all.orders');

    Route::get('/update/{orderID}',[OrdersController::class, 'UpdateOrders'])->name('update.orders');
    
    Route::post('/updateProcess',[OrdersController::class, 'UpdateOrderProcess'])->name('updateOrderProcess.orders');

    Route::get('/OrderXSLT',[OrdersController::class, 'GenerateOrder'])->name('xslt.orders');

    Route::get('/OrderXML',[OrdersController::class, 'GenerateOrderXML'])->name('xml.orders');

    Route::get('/Download/OrderXML',[OrdersController::class, 'DownloadOrderXML'])->name('downloadXML.orders');
});


//fronted
Route::get('/ProductListByCategory/{catName}',[ProductListController::class, 'ProductList'])->name('ProductListByCategory');

Route::prefix('ProductDetails')->group(function(){

Route::get('/detail/{id}',[ProductDetailsController::class, 'ShowDetails'])->name('ProductDetails');

});

Route::prefix('Products')->group(function(){

    Route::get('/',[ProductListController::class, 'productsPage'])->name('productsPage');

});


Route::middleware(['auth:sanctum'])->prefix('cart')->group(function(){

    Route::get('/',[CartController::class, 'Cart'])->name('CartPage');

    Route::get('/cart/{id}',[CartController::class, 'RemoveCart'])->name('Cart.Remove');

    Route::get('/pay',[CartController::class, 'Payment'])->name('Payment.Page');

    Route::post('/payment',[CartController::class, 'PlaceOrder'])->name('Place.Order');

    Route::get('/receipt/{OrderID}',[CartController::class, 'Receipt'])->name('Receipt');

    Route::get('/receiptAdmin/{OrderID}',[CartController::class, 'ReceiptAdmin'])->name('Receipt.Admin');

    Route::get('/receiptXSLT/{OrderID}',[CartController::class, 'GenerateXSLT'])->name('ReceiptXSLT');
    

});

Route::middleware(['auth:sanctum'])->prefix('MyOrder')->group(function(){

    Route::get('/all',[OrdersController::class, 'GetMyOrder'])->name('my.order');

    Route::get('/toship',[OrdersController::class, 'GetMyOrderTOSHIP'])->name('myTOSHIP.order');

    Route::get('/toreceive',[OrdersController::class, 'GetMyOrderTORECEIVE'])->name('myTORECEIVE.order');

    Route::get('/received',[OrdersController::class, 'GetMyOrderRECEIVED'])->name('myRECEIVED.order');
    
    Route::match(array('GET','POST'),'/receiveOrder/{orderID}',[OrdersController::class, 'UpdateReceivedOrder'])->name('receiveOrder.order');
});

Route::middleware(['auth:sanctum'])->post('/',[CartController::class, 'AddToCart'])->name('addToCart');





