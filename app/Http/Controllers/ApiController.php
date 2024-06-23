<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Api;
use App\Models\Product;

class ApiController extends Controller
{
    public function store(Request $request)
    {
        $data =new Student;
        $data->first_name = $request->first_name;
        $data->last_name = $request->last_name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        if ($data->save()) {
            return ["Result" => "product has been saved"];
        } else {
            return ["Result" => "Not saved"];
        }
        // $request->validate([
        //     'first_name'=>'required',
        //     'last_name'=>'required',
        //     'email'=>'required'
        // ]);

        // $contact = new Student([
        //     'first_name' => $request->get('first_name'),
        //     'last_name' => $request->get('last_name'),
        //     'email' => $request->get('email'),
        //     'phone' =>$request->get('phone')
        // ]);
        // $contact->save();
        // return redirect('/contacts')->with('success', 'Contact saved!');
    }

    // public function show($id=null){
    //     $data = $id?Student::find($id):Student::all();
    //     return response()->json($data);
    // }


    public function index($id=null){
        $data = $id?Student::find($id):Student::all();
        return response()->json($data);
    }

    // public function showbyid($id)
    // {
    // $data= Student::find($id)->get();
    // return response()->json($data);

    // }

    public function update(Request $request)
    {
        $data = Student::find($request->id);
        $data->first_name = $request->first_name;
        $data->last_name = $request->last_name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        if ($data->save()) {
            return ["Result" => "product update been save"];
        } else {
            return ["Result" => "Not update save"];
        }
    }

    public function delete(Request $request,$id)
    {
        $article = Student::find($id);
        // $article->delete();
        if ($article->delete()) {
            return ["Result" => "product has been deleted"];
        } else {
            return ["Result" => "Not deleted"];
        }

        // return 204;
    }
   
}
