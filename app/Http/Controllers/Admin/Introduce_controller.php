<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Model\Introduce_model;
use App\Http\Model\Websites_model;

class Introduce_controller extends Controller
{
    function index(){
        $in=Introduce_model::first();

        //  neu chua ton tai thi tao
        if(!isset($in)){
            $introduce=new Introduce_model;
            $introduce->name="";
            $introduce->img="";
            $introduce->key="";
            $introduce->short_description="";
            $introduce->description="";
            $introduce->save(); 
        }
        $introduce=Introduce_model::first();     

        return view("admin.home.introduce.edit",["introduce"=>$introduce]);
    }
    function edit_introduce(Request $request){
        if($request->isMethod('post')){
            $in=Introduce_model::first();
            if($request->name){
                 $in->name=$request->name;
            }
            $time=strtotime(date("d-m-Y h:i:s"));
            if($request->img){
                $file = $request->file('img');
                $destinationPath = 'upload/introduct/';
                $in->icon=$destinationPath.$time.".".$file->getClientOriginalExtension();
            }
            if($request->key){
                 $in->key=$request->key;
            }
            if($request->short_description){
                 $in->short_description=$request->short_description;
            }
            if($request->editor1){
                 $in->description=$request->editor1;
            }
            if($in->save()){
                if(isset( $file)){
                     $file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
                }
                 if(isset( $files)){
                     $files->move($destinationPath,$time.".".$files->getClientOriginalExtension());
                }
            
                
            }
          
        }
        return redirect('admin/introduce/');
    }

    
}
