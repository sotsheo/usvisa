<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Http\Model\Newsletter_model;
use App\Http\Model\Websites_model;
use App\Http\Controllers\Admin\Mail;
class Newsletter_controller extends Controller
{
    function index(){
        $w=Websites_model::where('status','1')->first();
        // Số email chưa biết
        $count=count(Newsletter_model::orderByRaw('id DESC')->where('id_site',$w->id)->where('viewed',0)->get());
        $data=Newsletter_model::orderByRaw('id DESC')->where('id_site',$w->id)->where('viewed',0)->get();
        if($count!=0){
           foreach ($data as $key) {
            $tem=Newsletter_model::where('id_site',$w->id)->where("id", $key->id)->first();
            $tem->viewed=1;
             $tem->save();
           }
       }
       
       $news=Newsletter_model::orderByRaw('id DESC')->where('id_site',$w->id)->paginate(10);
       return view("admin.home.newsletter.index",['news'=>$news,'count'=>$count]);
   }
   function create_newsletter(Request $request){
    
       $w=Websites_model::where('status','1')->first();
       if($request->isMethod('post')){
        $data=array();
        
        $news=new Newsletter_model;
        $news->name='';
        $news->email='';
        $news->phone='';
        $news->id_site= $w->id;
        $news->date_create=strtotime(date('d-m-Y'));
        if($request->name){
            $news->name=$request->name;
        }
        if($request->email){
            $news->email=$request->email;
        }

        if($request->phone){
            $news->phone=$request->phone;
        }
        if($request->email){
            $find=Newsletter_model::where("email",trim($news->email))->first();
        }
        if(!$find){
            if($news->save()){
                Session::flash('success', 'Xin cảm ơn bản đã gửi thông tin cúng toi sẽ liên hệ vs bạn sớm nhất');
                // action send mail
               
              
            }
        }
        else{
            Session::flash('success', 'Email của bạn đã tồn tại trong hệ thống');
        }


    }
    return redirect('/');
}
function delete($id){
    $w=Websites_model::where('status','1')->first();
    $news= Newsletter_model::where('id_site',$w->id)->where('id',$id)->first();
    if($news){
        if($news->delete()){

        }
    }
    return redirect('admin/newsletter');
}
static function get(){
    $w=Websites_model::where('status','1')->first();
    $news= Newsletter_model::where('id_site',$w->id)->where('viewed',0)->get();
    return $news;

}

}   
