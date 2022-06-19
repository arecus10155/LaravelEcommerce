<?php

namespace App\Http\Controllers\Admin;

//Author:NG SE CHIAN

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Validation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ProductList;
use App\Repositories\CategoryInterface;

class CategoryController extends Controller
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

    protected $category;

    public function __construct(CategoryInterface $cat){
        $this->category = $cat;
    }
    
    public function AllCategory(){
        $categories = $this->category->all();
        return $categories;
    }

    public function AllCat(){
        $categories = $this->category->all();
        $products = ProductList::all();
        return view('user.pages.HomePage',compact('categories','products'));
    }

    public function AllPrtCategory(){
        $category = Category::paginate(5);
        return view('backend.category.category_view', compact('category'));
    }

    public function AddCategory(){

      return view('backend.category.category_add');
    }

    public function StoreCategory(Validation $request){

        $this->category->store([
            'category_name' => $request->category_name
        ]);

        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.categoryAdmin')->with($notification);



    }

    public function EditCategory($id){

        $category = $this->category->get($id);

        return view('backend.category.category_edit',compact('category'));
    }

    public function UpdateCategory(Validation $request){

        
        $category_id = $request->id;

        $this->category->update($category_id,[
            'category_name' => $request->category_name,
        ]);

    

        $notification = array(
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.categoryAdmin')->with($notification);

    }

    public function DeleteCategory($id){

        $category_id = $id;
        $category_id = $this->category->get($category_id);
        
        if($category_id != null){
            $this->category->delete($id);
        
        }


        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

   

}
