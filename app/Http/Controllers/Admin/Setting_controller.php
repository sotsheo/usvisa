<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Model\Website_model;

class Setting_controller extends Controller
{

    function index(){
        $website=Website_model::get();
        //  neu chua ton tai thi tao
        if(!isset($website) || count($website)==0){
            $website=new Website_model;
            $website->name="";
            $website->icon="";
            $website->logo="";
            $website->phone="";
            $website->address="";
            $website->email="";
            $website->map="";
            $website->phone_admin='';
            $website->email_admin='';
            $website->save(); 
        }
        $website=Website_model::first();        
        return view("admin.home.setting.edit",["website"=>$website]);
    }
    function edit(Request $request){
        if($request->isMethod('post')){
            $website=Website_model::find(1);
            if($request->name){
                 $website->name=$request->name;
            }
            $time=strtotime(date("d-m-Y h:i:s"));
            if($request->icon){
                $file = $request->file('icon');
                $destinationPath = 'upload/website/';
                $website->icon=$destinationPath.$time.".".$file->getClientOriginalExtension();
            }
            if($request->logo){
                $files = $request->file('logo');
                $destinationPath = 'upload/website/';
                $website->logo=$destinationPath.$time.".".$files->getClientOriginalExtension();
            }
            if($request->address){
                $website->address=$request->address;
            }
            if($request->phone){
                $website->phone=$request->phone;
            }
            if($request->email){
                $website->email=$request->email;
            }
             $website->phone_admin='';
             $website->email_admin='';
            if($request->phone_admin){
                $website->phone_admin=$request->phone_admin;
            }
            if($request->email_admin){
                $website->email_admin=$request->email_admin;
            }
            if($request->map){
                $website->map=$request->map;
            }
            $website->default=1;
            if(!$request->get('default')){
                $website->default=0;
            }
            if($website->save()){
                if(isset( $file)){
                     $file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
                }
                 if(isset( $files)){
                     $files->move($destinationPath,$time.".".$files->getClientOriginalExtension());
                }
            
                
            }
          
        }
        return redirect('admin/category_news/');
    }

    
}
