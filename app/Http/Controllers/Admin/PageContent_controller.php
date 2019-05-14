<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Http\Model\PageContent_model;
use App\Http\Model\Websites_model;
class PageContent_controller extends Controller
{
   
   
    function index(){
        $news=PageContent_model::orderByRaw('location ASC,id DESC')->paginate(10);
        $messages= Session::get('messages');
    	return view("admin.home.page.index",['news'=>$news,'messages'=>$messages]);
    }
    function create(){
        return view("admin.home.page.insert");
    }
    function create_page(Request $request){
        if($request->isMethod('post')){
            $news=new PageContent_model;

            $new_cate=PageContent_model::orderBy('id','desc')->first();
            $news->name=$request->name;
            $time=strtotime(date("d-m-Y h:i:s"));
            $news->url_seo=$this->create_url($request->name);
            $news->link="/".$news->url_seo."-nd-".'1'.".html";
            if($new_cate){
                 $news->link="/".$news->url_seo."-nd-".($new_cate->id+1).".html";
            }
            $news->img="";
            if($request->img){
                $file = $request->file('img');
                $destinationPath = 'upload/page/';
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
                    
            }
        }
        return redirect('admin/pagecontent/');
    }

    function edit($id){
        $news=PageContent_model::where("id",$id)->first();
        if($news){
            return view("admin.home.page.edit",['news'=>$news]);
        }
        return redirect('admin/pagecontent/');
    }
    function edit_page(Request $request){
        if($request->isMethod('post')){
            
           $news=PageContent_model::where("id",$request->id)->first();
             $time=strtotime(date("d-m-Y h:i:s"));

            if($news){
                $news->name=$request->name;
                $news->url_seo=$this->create_url($request->name);
                $news->link="/".$news->url_seo."-nd-".($news->id).".html";
                if($request->img){
                    $file = $request->file('img');
                    $destinationPath = 'upload/page/';
                    $news->img=$destinationPath.$time.".".$file->getClientOriginalExtension();
                }
                $news->state=$request->state;
                if($request->short_description){
                    $news->short_description=$request->short_description;
                }  
                if($request->editor1){
                    $news->description=$request->editor1;
                }
                if($request->location){
                    $news->location=$request->location;
                }
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
        return redirect('admin/pagecontent/');
    }

    function delete($id){
        //  Check xem co tồn tại không
        $news=PageContent_model::where("id",$id)->first();
        if($news){
            if( $news->delete()){
                 Session::flash('messages', 'Đã xóa  thành công bài viết');
                return redirect('admin/pagecontent/');
            }
        }
        return redirect('admin/pagecontent/');
    }
    // //  hàm tạo url
    function create_url( string $str )
    {
    // //Kiểm tra xem dữ liệu truyền vào có phải là một chuỗi hay không
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
    public function get_page_content(){
        $category=PageContent_model::all();
        $data['category']=$category;
        return $category;
    }
}   
