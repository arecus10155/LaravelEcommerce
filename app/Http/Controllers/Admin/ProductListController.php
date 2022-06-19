<?php

namespace App\Http\Controllers\Admin;

//Author:NG SE CHIAN

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Validation;
use App\Http\Controllers\Controller;
use App\Models\ProductDetails;
use App\Models\ProductList;
use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ProductListController extends Controller
{

    public function index()
    {
        if (Auth::user()->roleID == 2) { //admin
            $adminName = Auth::user()->name;
            // session(['username'=> $adminName]);
            session()->put(['username' => $adminName]);
            return view('admin.index');
        } elseif (Auth::user()->roleID == 1) //customer
        {
            return redirect('/');
        } else {
            return redirect('login');
        }
    }

    //ADMIN
    public function ProductListByCategory(Request $request)
    {
        $category = $request->category;
        $productList = ProductList::where('category', $category)->get();

        return $productList;
    }

    public function ProductList($catName)
    {
        $productList = ProductList::where('category', $catName)->get();
        return view('user.pages.ProductList', compact('productList'));
    }

    public function GetAllProductApi($id)
    {

        if ($id == 0) {
            $products =  ProductList::all();
            $productDetails = ProductDetails::all();
        } else {
            $products =  ProductList::where('id', $id)->get();
            $productDetails = ProductDetails::where('product_id', $id)->get();
        }


        return [$products, $productDetails];
    }

    public function GetAllProduct()
    {



        $products =  ProductList::Latest()->paginate(10);
        $productDetails = ProductDetails::all();

        return view('backend.product.product_all', compact('products', 'productDetails'));
    }

    public function AddProduct()
    {

        $category = Category::orderBy('category_name', 'DESC')->get();


        return view('backend.product.product_add', compact('category'));
    }

    public function StoreProduct(Validation $request)
    {



        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(274, 274)->save('backend/assets/products/' . $name_gen);
        $save_url = 'http://127.0.0.1:8000/backend/assets/products/' . $name_gen;

        $product_id = ProductList::insertGetId([

            'title' => $request->title,
            'price' => $request->price,
            'category' => $request->category,
            'product_code' => $request->product_code,
            'image' => $save_url,

        ]);

        ProductDetails::insert([
            'product_id' => $product_id,
            'image_one' => $save_url,
            'short_description' => $request->short_description,
            'color' =>  $request->color,
            'long_description' => $request->long_description,
            'quantity' => $request->quantity,

        ]);

        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);
    }


    public function UpdateProduct(Validation $request)
    {



        if ($request->file('image') != null) {

            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(274, 274)->save('backend/assets/products/' . $name_gen);
            $save_url = 'http://127.0.0.1:8000/backend/assets/products/' . $name_gen;
        } else {
            $save_url = asset($request->imageOld);
        }



        ProductList::findOrFail($request->id)->update([
            'title' => $request->title,
            'price' => $request->price,
            'category' => $request->category,
            'product_code' => $request->product_code,
            'image' => $save_url,

        ]);

        ProductDetails::where('product_id', $request->id)->update([
            'product_id' => $request->id,
            'image_one' => $save_url,
            'short_description' => $request->short_description,
            'color' =>  $request->color,
            'long_description' => $request->long_description,
            'quantity' => $request->quantity,
        ]);

        $notification = array(
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);
    }

    public function EditProduct($id)
    {
        $category = Category::orderBy('category_name', 'DESC')->get();

        $product = ProductList::findOrFail($id);
        $details = ProductDetails::where('product_id', $id)->get();

        return view('backend.product.product_edit', compact('category', 'product', 'details'));
    }

    public function DeleteProduct($id)
    {


        ProductList::findOrFail($id)->delete();
        ProductDetails::where('product_id', $id)->delete();


        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    //USER

    public function productsPage(Request $request)
    {
        $products =  ProductList::Latest()->paginate(8);
        $category = Category::All();


        if ($request->price) {

            $price = explode('-', $request->price);
            $minPrice = (int)$price[0];
            $maxPrice = (int)$price[1];
        }


        if ($request->submit == "filter") {

            if ($request->category != null && $request->price != null) {

                $products = ProductList::whereIn('category', $request->category)->whereBetween('price', [$minPrice, $maxPrice])->paginate(8);
            } elseif ($request->category != null && $request->price == null) {

                $products = ProductList::whereIn('category', $request->category)->paginate(8);
            } elseif ($request->price != null && $request->category == null) {

                $products = ProductList::whereBetween('price', [$minPrice, $maxPrice])->paginate(8);
            } else {
                $products =  ProductList::Latest()->paginate(8);
            }
        } else {
            $products =  ProductList::Latest()->paginate(8);
        }

        return view('user.pages.ProductPage', compact('products', 'category'));
    }


    public function ProductXML()
    {
        $productList = ProductList::all();


        return redirect(asset('product.xml'))->with('productList', $productList);
    }

    public function GenerateXML()
    {

        $products = ProductList::all();
        $productsDetails = ProductDetails::all();
        $xml = new \XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);

        $xml->startDocument();


        $xml->startElement('products');

        foreach ($products as $product) {
            $xml->startElement('productList');
            $xml->writeAttribute('prtID', $product->id);



            $xml->startElement('title');
            $xml->writeRaw($product->title);
            $xml->endElement();

            $xml->startElement('price');
            $xml->writeRaw($product->price);
            $xml->endElement();

            $xml->startElement('image');
            $xml->writeRaw($product->image);
            $xml->endElement();

            $xml->startElement('category');
            $xml->writeRaw($product->category);
            $xml->endElement();

            $xml->startElement('product_code');
            $xml->writeRaw($product->product_code);
            $xml->endElement();

            $xml->startElement('color');
            $xml->writeRaw($productsDetails[($product->id - 1)]->color);
            $xml->endElement();

            $xml->startElement('quantity');
            $xml->writeRaw($productsDetails[($product->id - 1)]->quantity);
            $xml->endElement();

            $xml->startElement('short_description');
            $xml->writeRaw($productsDetails[($product->id - 1)]->short_description);
            $xml->endElement();

            $xml->startElement('long_description');
            $xml->writeRaw($productsDetails[($product->id - 1)]->long_description);
            $xml->endElement();



            $xml->endElement();
        }

        $xml->endElement();
        $xml->endDocument();


        $contents = $xml->outputMemory();

        $xml = null;





        if (!Storage::disk('public_uploads')->put('productList.xml', $contents)) {
            return false;
        }


        return redirect(asset('xml/productList.xml'));
    }

    public function GenerateProduct()
    {

        $products = ProductList::all();
        $productsDetails = ProductDetails::all();
        $xml = new \XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);

        $xml->startDocument();

        $xml->writePI('xml-stylesheet', 'href="/xslt-route?" type="text/xsl"');


        $xml->startElement('products');

        $count = 0;

        foreach ($products as $product) {
            $xml->startElement('productList');

            $xml->startElement('id');
            $xml->writeRaw($product->id);
            $xml->endElement();

            $xml->startElement('title');
            $xml->writeRaw($product->title);
            $xml->endElement();

            $xml->startElement('price');
            $xml->writeRaw($product->price);
            $xml->endElement();

            $xml->startElement('image');
            $xml->writeRaw($product->image);
            $xml->endElement();

            $xml->startElement('category');
            $xml->writeRaw($product->category);
            $xml->endElement();

            $xml->startElement('product_code');
            $xml->writeRaw($product->product_code);
            $xml->endElement();

            $xml->startElement('color');
            $xml->writeRaw($productsDetails[$count]->color);
            $xml->endElement();

            $xml->startElement('quantity');
            $xml->writeRaw($productsDetails[$count]->quantity);
            $xml->endElement();

            $xml->startElement('short_description');
            $xml->writeRaw($productsDetails[$count]->short_description);
            $xml->endElement();

            $xml->startElement('long_description');
            $xml->writeRaw($productsDetails[$count]->long_description);
            $xml->endElement();

            $count++;

            $xml->endElement();
        }

        $xml->endElement();
        $xml->endDocument();


        $contents = $xml->outputMemory();

        $xml = null;



        if (!Storage::disk('public_uploads')->put('productList.xml', $contents)) {
            return false;
        }




        return redirect(asset('xml/productList.xml'));
    }


    public function DownloadXML()
    {
        $filepath = public_path() . "/xml/productList.xml";

        return response()->download($filepath);
    }
}
