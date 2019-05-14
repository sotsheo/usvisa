<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Model\Html_model;
use App\Http\Model\Websites_model;
class Html_controller extends Controller
{

    function index(){
        $messages= Session::get('messages');
        $html=Html_model::paginate(10);
        return view("admin.home.html.index",["html"=>$html,'messages'=>$messages]);
    }
    function create(){
        return view("admin.home.html.insert");
    }
    function create_html(Request $request){
        if($request->isMethod('post')){
            $html=new Html_model;
            $html->name=$request->name;
            $html->values="";
            if($request->editor1){
                $html->values=$request->editor1;
            }
            if($html->save()){
                Session::flash('messages', 'Đã thêm thành công nội dung tĩnh '.$html->name);
            }
        }
        return redirect('admin/html/');
    } 

    function edit($id){

        $html= Html_model::where("id",$id)->first();
        if($html){
            return view("admin.home.html.edit",["html"=>$html]);
        }   
        return redirect('admin/html/');
    }
     function edit_html(Request $request){
         $w=Websites_model::where('status','1')->first();
        if($request->isMethod('post')){
            $html= Html_model::where('id_site',$w->id)->where("id",$request->id)->first();
            $html->name=$request->name;
            if($request->editor1){
                $html->values=$request->editor1;
            }
            if($html->save()){
                Session::flash('messages', 'Đã  sửa  thành công nội dung tĩnh '.$html->name);
            }
        }
        return redirect('admin/html/');
    } 

    function delete($id){
        $html= Html_model::where("id",$id)->first();
        if($html){
           $name=$html->name;
           if($html->delete()){
            Session::flash('messages', 'Đã  xóa thành công nội dung tĩnh '.$name);
           }
        }   
        return redirect('admin/html/');
    }

    function get_html(Request $request){;
        $category=Html_model::all();
        $data['category']=$category;
        return $data;
    }
   
}
