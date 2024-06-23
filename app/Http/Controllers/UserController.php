<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegisterUser;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function index()
    {
        $state= State::all();
        // echo "<pre>";
        // print_r($state);
        // die();
        return view('home',compact('state')); 
    }
    public function getcity($id)
    {
        $city= City::where('state_id',$id)->get();
        return response()->json($city);
        
    }

    public function insert(Request $req)
    {
        $data=new RegisterUser;
        $data->name= $req->name;
        $data->phone_no=$req->phone_no;
        $data->email=$req->email;
        $data->address=$req->address;
        $data->state=$req->state;
        $data->city=$req->city;
        $data->zip=$req->zip;
        $data->password=Hash::make($req->password);
        $data->confirm_password=Hash::make($req->confirm_password);
        $data->save();
        return redirect('/');
    }
    public function state()
    {
        $state= State::all();
    }
    public function user_login(Request $request)
    {
        // $data=$request->input();
        $data=RegisterUser::where(['email'=>$request->email])->first();
        if(!$data ||!Hash::check($request->password,$data->password)){
            return "Email and Password are not matching";
        }
        else{
            $request->session()->put('register_users',$data);
            return redirect('/');
        }

    }
   
}
