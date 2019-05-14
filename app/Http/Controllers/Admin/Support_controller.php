<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Model\Support_model;
use App\Http\Model\Type_support_model;

class Support_controller extends Controller
{
    function index(){
        $messages= Session::get('messages');
        $support=Support_model::all();
        $type_support=Type_support_model::all();
        return view("admin.home.support.index",["support"=>$support,'type_support'=>$type_support,'messages'=>$messages]);
    }
    function edit_support(Request $request){
         if($request->isMethod('post')){
            if(isset($request->count)){
                for ($i=1; $i <=$request->count ; $i++) { 
                    $index='item_type_id_'.$i;
                    $id_type=$request->input($index); 
                    $index='item_name_'.$i;
                    $name=$request->input($index);
                    $index='item_link_'.$i;
                    $link=$request->input($index);
                    if($id_type){
                      $supports=Support_model::where("id_type",$id_type)->first();
                        if($supports){
                            $support=Support_model::find($supports->id);
                            if($name){
                                $support->name=$name;
                            }
                            if($link){
                                $support->link=$link;
                            }
                            $support->save();
                        }
                        else{

                            $support=new Support_model;
                            $support->name='';
                            $support->link='';
                            if($name){
                                $support->name=$name;
                            }
                            if($link){
                                $support->link=$link;
                            }
                            $support->id_type=$id_type;
                            $support->save();
                        }
                       Session::flash('messages', 'Đã thêm thành công ');
                    }
                    
                }
            }
        }
        return redirect('admin/support/');

    }
    function delete($id){
        if($id){
            $supports=Support_model::find($id);
            if($supports){
                if($supports->delete()){
                    Session::flash('messages', 'Đã xoá công ');
                }
            }
        }
         return redirect('admin/support/');
       
    }
}
