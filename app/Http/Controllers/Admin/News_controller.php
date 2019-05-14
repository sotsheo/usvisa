<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Http\Model\News_model;
use App\Http\Model\Category_news_model;
use Mail;
class News_controller extends Controller
{


    function index(){
        
        $news=News_model::orderByRaw('location ASC,id DESC')->paginate(10);
        $messages= Session::get('messages');
        $category=Category_news_model::all();
        return view("admin.home.news.index",['news'=>$news,'category'=>$category,'messages'=>$messages]);
    }
    function search(Request $request){
      
        $news=News_model::orderByRaw('location ASC,id DESC')->paginate(10);
        $category=Category_news_model::all();
         $messages= Session::get('messages');
        $name='';
        $id_category=0;
        $state=-1;
        if($request->isMethod('post')){
            if($request->name){
                $name=$request->name;
            }
            if($request->id_category){
                $id_category=$request->id_category;
            }
            if($request->state!=-1){
              $state=$request->state;
          }
        $news=News_model::orderByRaw('location ASC,id DESC')->where("name",'like','%'.$name.'%')->paginate(10);
          $where=array();
          if($id_category){
              $where['id_category']=$id_category;
          }
          if($state!=-1 && isset($state)){
              $where['state']=$state;
          }
         
          if(count($where)>0){
            $news=News_model::orderByRaw('location ASC,id DESC')->where("name",'like','%'.$name.'%')->where($where)->paginate(10); 
          }

        }
         return view("admin.home.news.index",['news'=>$news,'category'=>$category,'messages'=>$messages,'name'=>$name,'where'=>$where]);
    }
    function create(){
        $category=Category_news_model::all();
        return view("admin.home.news.insert",['category'=>$category]);
    }
    function create_news(Request $request){
        if($request->isMethod('post')){
            $news=new News_model;
            $new_cate=News_model::orderBy('id','desc')->first();
            $news->name=$request->name;
            $time=strtotime(date("d-m-Y h:i:s"));
            if($request->id_category){
                $category=Category_news_model::find($request->id_category);
            }
            if($category){
                $news->id_category=$request->id_category;
                $news->url_seo=$this->create_url($request->name);
                $category=Category_news_model::find($request->id_category);
                $news->link="/news/".$news->url_seo."-n-".'1'.".html";
                if($new_cate){
                    $news->link="/news/".$news->url_seo."-n-".($new_cate->id+1).".html";
                }
                
                $news->img="";
                if($request->img){
                    $file = $request->file('img');
                    $destinationPath = 'upload/news/';
                    $news->img=$destinationPath.$time.".".$file->getClientOriginalExtension();
                }
                $news->state=$request->state;
                if($request->short_description){
                   $news->short_description=$request->short_description;
               }  
               $news->description="";
               if($request->editor1){
                $news->description=$request->editor1;
            }
            if($request->location){
                $news->location=$request->location;
            }
            if($request->get('ishot')){
                $news->ishot=$request->get('ishot');
            }
            $news->key_card="";
            if($request->key_card){
                $news->key_card=$request->key_card;
            }

            $news->user=Auth::user()->name;
                // kiểm tra tồn tại của thời gian nếu không thì lấy thời gian hiện tại
            if($request->date_create){
                $news->date_create=strtotime($request->date_create);
            }
            else{
                $news->date_create=strtotime(date('d-m-Y'));
            }
                // kiểm tra tồn tại của thời gian nếu không thì lấy thời gian hiện tại
            if($request->date_public){
                $news->date_public=strtotime($request->date_public);
            }
            else{
                $news->date_public=strtotime(date('d-m-Y'));
            }
            if($news->save()){
                Session::flash('messages', 'Đã thêm thành công bài viết '.$news->name);
                if(isset( $file))
                {
                    $file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
                }
                return redirect('admin/news/');
            }
        }
        return redirect('admin/news/');
    }
    return redirect('admin/news/');
}

function edit($id){;
    $category=Category_news_model::all();
    $news=News_model::where("id",$id)->first();
    if($news){
        return view("admin.home.news.edit",['news'=>$news,'category'=>$category]);
    }
    return redirect('admin/news/');
}
function edit_news(Request $request){
 if($request->isMethod('post')){

     $news=News_model::where("id",$request->id)->first();
     $time=strtotime(date("d-m-Y h:i:s"));

     if($news){
        $news->name=$request->name;
        if($request->id_category){
            $category=Category_news_model::find($request->id_category);
        }
        if($category){
            $news->url_seo=$this->create_url($request->name);
            $category=Category_news_model::find($request->id_category);
            $news->link="/news/".$news->url_seo."-n-".$news->id.'.html';
            if($request->img){
                $file = $request->file('img');
                $destinationPath = 'upload/news/';
                $news->img=$destinationPath.$time.".".$file->getClientOriginalExtension();
            }
            $news->state=$request->state;
            if($request->short_description){
               $news->short_description=$request->short_description;
           }  
           $news->description="";
           if($request->editor1){
            $news->description=$request->editor1;
        }
        if($request->location){
            $news->location=$request->location;
        }
        if($request->get('ishot', 0)!=0){
            $news->ishot=1;
        }
        $news->key_card="";
        if($request->key_card){
            $news->key_card=$request->key_card;
        }

        $news->user=Auth::user()->name;
                // kiểm tra tồn tại của thời gian nếu không thì lấy thời gian hiện tại
        if($request->date_create){
            $news->date_create=strtotime($request->date_create);
        }
        else{
            $news->date_create=strtotime(date('d-m-Y'));
        }
                // kiểm tra tồn tại của thời gian nếu không thì lấy thời gian hiện tại
        if($request->date_public){
            $news->date_public=strtotime($request->date_public);
        }
        else{
            $news->date_public=strtotime(date('d-m-Y'));
        }

        if($news->save()){
            Session::flash('messages', 'Đã chỉnh sửa  thành công bài viết '.$news->name);
            if(isset( $file)){
                $file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
            }

        }
    }           

}    
}
return redirect('admin/news/');
}

function delete($id){

        //  Check xem co tồn tại không
   $news=News_model::where("id",$id)->first();
   if($news){
    if( $news->delete()){
       Session::flash('messages', 'Đã xóa  thành công bài viết');
       return redirect('admin/news/');
   }
}
return redirect('admin/news/');
}
    //  hàm tạo url
function create_url( string $str )
{
    //Kiểm tra xem dữ liệu truyền vào có phải là một chuỗi hay không
    if( is_string( $str ) ){
            // Chuyển đổi toàn bộ chuỗi sang chữ thường
        $str = mb_convert_case($str, MB_CASE_LOWER, "UTF-8"); 
            //Tạo mảng chứa key và chuỗi regex cần so sánh
        $unicode = [
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd' => 'đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            '-' => '\+|\*|\/|\&|\!| |\^|\%|\$|\#|\@',
        ];

        foreach ( $unicode as $key => $value )
        {
                //So sánh và thay thế bằng hàm preg_replace

            $str = preg_replace("/($value)/", $key, $str);
        }
            //Trả về kết quả
        return $str;
    } 
            //Nếu Dữ liệu không phải kiểu string thì trả về null
    return null;
}
    // lay bai viet liên quan
static function  getRelatedPosts($id_category,$id,$limit){
    $news=News_model::where('id_category',$id_category)->where('id','!=',$id)->limit($limit)->get();
    return $news;
}
}   
