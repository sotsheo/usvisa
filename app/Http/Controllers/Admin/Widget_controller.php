<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use App\Http\Model\Category_menu_model;
use App\Http\Model\Category_news_model;
use App\Http\Model\Category_product_model;
use App\Http\Model\Widget_model;
use App\Http\Model\Type_widget_model;
use App\Http\Model\Menu_model;
use App\Http\Model\News_model;
use App\Http\Model\Product_model;
use App\Http\Model\Support_model;
use App\Http\Model\Type_support_model;
use App\Http\Model\Banner_model;
use App\Http\Model\Category_banner_model;
use App\Http\Model\Manufacturer_model;
use App\Http\Model\Html_model;
use App\Http\Model\Website_model;

class Widget_controller extends Controller
{

    function index(){
        $messages= Session::get('messages');
        $widget=Widget_model::all();
        return view("admin.home.widget.index",["widget"=>$widget,'messages'=>$messages]);
    }
    function create(){
        return view("admin.home.widget.insert");
    }
    function create_widget(Request $request){

        if($request->isMethod('post')){
            $wedget=new Widget_model;
            $this->actionModel($wedget,$request);
        }
        return redirect('admin/widget/');
    }
    function edit($id){
        $wedget= Widget_model::where('id',$id)->first();
        if($wedget){
            return view("admin.home.widget.edit",['wedget'=>$wedget,]);
        }
        return redirect('admin/widget/');
    }
    function edit_widget(Request $request){

        if($request->isMethod('post')){
            $wedget=Widget_model::where('id',$request->id)->first();
            if($wedget){
                $this->actionModel($wedget,$request);
            }
        }
        return redirect('admin/widget/');
    }

    function delete($id){
        $wedget=Widget_model::where('id',$id)->first();
        if($wedget){
            $name=$wedget->name;
            if($wedget->delete()){
                 Session::flash('messages', 'Đã xoá thành công danh widget '.$name);
            }
        }
        return redirect('admin/widget/');
    }


    function actionModel($wedget,$request){
                $wedget->name='';
                if($wedget->name){
                     $wedget->name=$request->name;
                }
                $wedget->type=0;
                if($wedget->type){
                     $wedget->type=$request->type;
                }
                $wedget->number_type=0;
                if($wedget->number_type){
                     $wedget->number_type=$request->number_type;
                }
                $wedget->text_head='';
                if($request->text_head){
                    $wedget->text_head=$request->text_head;
                }
                $wedget->id_category=0;
                if($request->id_category){
                     $wedget->id_category=$request->id_category;
                }
                $wedget->limit=0;
                if($request->limit){
                     $wedget->limit=$request->limit;
                }
                if($request->limit_category){
                 $wedget->limit=$request->limit;
                }
                $wedget->show_name=0;
                if($request->get('show_name')){
                    $wedget->show_name=$request->get('show_name');
                }
                if($wedget->save()){
                    Session::flash('messages', 'Đã sửa thành công danh widget '.$wedget->name);
                }
    }
    

}
