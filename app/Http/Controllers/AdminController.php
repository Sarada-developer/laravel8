<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\LoginModel;
use File;

class AdminController extends Controller
{
    public function index(Request $request){

            if($request->session()->has('ADMIN_LOGIN')){
               return redirect('admin');
           }else{
               return view('backend.login');
           }
          return view('backend.login');
    }
      public function auth(Request $req)
      {
          $email=$req->post('email');
          $password=$req->post('password');
          $result=LoginModel::where(['email'=>$email,'password'=>$password])->get();
          if(isset($result['0']->id))
          {
              $req->session()->put('ADMIN_LOGIN',true);
              $req->session()->put('ADMIN_ID',$result['0']->id);
              return redirect('admin');
  
          } 
          else{
              $req->session()->flash('error','Please enter valid login details');
              return redirect('login');
          }
      }
      public function dashboard()
      {
          return view('backend.dashboard');
      }
    public function category(){
        return view('backend.category');
    }

    public function insert(Request $request){

        $data=new Category;
        $data->name = $request->name;
        $data->category_slug = $request->category_slug;
        $data->save();
        return redirect('/category');
    }
    public function category_table()
    {
        $data= Category::all();
        return view('backend.category_table',['category'=>$data]);

    }
    public function category_edit($id)
    {
        $data = Category::find($id);
        return view('backend.edit_category',['category'=>$data]);

    }

    public function update_category(Request $req, $id){

        $data=Category::find($id);
        $data->name = $req->name;
        $data->category_slug = $req->category_slug;
        $data->save();
        $req->session()->flash('message','category Updated successfully');
        return redirect('/category_table');
    }

    public function delete(Request $request, $id)
    {
        $data = Category::find($id);
        $data->delete();
        $request->session()->flash('message','category deleted');
        return redirect('/category_table');
    }

    public function product(){
        return view('backend.product');
    }
    public function product_insert(Request $req)
    {
        $data=new Product;
        $data->name = $req->name;
        $data->category_id = $req->category_id;
        $data->brand = $req->brand;
        $data->price = $req->price;
        $data->offer_price = $req->offer_price;
        $data->sku = $req->sku;
        $data->stock = $req->stock;
        $data->weight = $req->weight;
        $data->details = $req->details;
        $files = [];
        if($req->hasfile('filenames'))
         {
            foreach($req->file('filenames') as $file)
            {
                $name = time().rand(1,100).'.'.$file->extension();
                $file->move(public_path('files'), $name);  
                $files[] = $name;  
            }
         }
  
        //  $file= new File();
        $data->filenames = $files;
        // echo "<pre>";
        // echo print_r($data);
        // die();
        $data->save();
        return redirect('/product');  
    }
    public function product_table()
    {
        $data= Product::all();
        return view('backend.product_table',['product'=>$data]);
    }
    public function product_edit($id)
    {
        $data=Product::find($id);
        return view('backend.edit_product',['product'=>$data]);
    }
    public function update_product(Request $req,$id)
    {
        $data= Product::find($id);
        $data->name=$req->name;
        $data->category_id=$req->category_id;
        $data->brand=$req->brand;
        $data->price=$req->price;
        $data->offer_price=$req->offer_price;
        $data->sku=$req->sku;
        $data->stock=$req->stock;
        $data->weight=$req->weight;
        $data->details=$req->details;
     }
    public function delete_product(Request $req,$id)
    {
    $data= Product::find($id);
    $data->delete();
        // $req=session()->flashdata('message','Produt deleted');
        return redirect('/product_table');
    }
}
