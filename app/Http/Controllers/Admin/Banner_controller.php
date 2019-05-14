<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Model\Banner_model;
use App\Http\Model\Category_banner_model;
use App\Http\Model\Websites_model;

class Banner_controller extends Controller
{
//https://www.freemysqlhosting.net/account/?msg=943
    function index(){

        $messages= Session::get('messages');
        $banner=Banner_model::paginate(10);
        $category=Category_banner_model::all();
        return view("admin.home.banner.index",["banner"=>$banner,'category'=>$category,'messages'=>$messages]);
    }
    function create(){
        $category=Category_banner_model::all();
    	return view("admin.home.banner.insert",['category'=>$category]);
    }
    function create_banner(Request $request){
        if($request->isMethod('post')){
            $category=new Banner_model;
            $category->name=$request->name;
            $category->link="";
            $category->short_description="";
            $category->description="";
            $time=strtotime(date("d-m-Y h:i:s"));
            if($request->link){
                $category->link=$request->link;
            }
            $category->img="";
            if($request->img){
                $file = $request->file('img');
                $destinationPath = 'upload/banner/';
                $category->img=$destinationPath.$time.".".$file->getClientOriginalExtension();
            }

            if($request->short_description){
                $category->short_description=$request->short_description;
            }
            if($request->editor1){
                $category->description=$request->editor1;
            }
            if($request->id_category){
                $category_b=Category_banner_model::find($request->id_category);
            }
            if($category_b){
                $category->id_category=$request->id_category;
                $category->state=$request->state;

                // kiểm tra tồn tại của thời gian nếu không thì lấy thời gian hiện tại
                $category->date_create=strtotime(date('d-m-Y'));
                if($request->date_create){
                    $category->date_create=strtotime($request->date_create);
                }
                if($category->save()){
                    Session::flash('messages', 'Đã thêm thành công banner'.$category->name);
                    if(isset($file)){
                        $result=$file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
                        if($result){
                            return redirect('admin/banner/');
                        }
                        else{
                            return redirect('admin/banner/');
                        }
                    }
                    return redirect('admin/banner/');
                    
                }
                return redirect('admin/banner/');
            }
            return redirect('admin/banner/');
        }
        return redirect('admin/banner/');

    }
    function edit($id){
       $banner=Banner_model::where("id",$id)->first();
       $category=Category_banner_model::all();
       if($banner){
        return view("admin.home.banner.edit",['banner'=>$banner,'category'=>$category]);
       }
       return redirect('admin/banner/');
    }
    function edit_banner(Request $request){
        if($request->isMethod('post')){
            $category=Banner_model::where("id",$request->id)->first();
             $time=strtotime(date("d-m-Y h:i:s"));
            if($category){
                $category->name=$request->name;
                if($request->link){
                    $category->link=$request->link;
                }
                if($request->img){
                    $file = $request->file('img');
                    $destinationPath = 'upload/banner/';
                    $category->img=$destinationPath.$time.".".$file->getClientOriginalExtension();
                    
                }
                if($request->short_description){
                    $category->short_description=$request->short_description;
                }
                if($request->editor1){
                    $category->description=$request->editor1;
                }
                if($request->id_category){
                    $category_b=Category_banner_model::find($request->id_category);
                }
                if($category_b){
                    $category->state=$request->state;
        
                    // kiểm tra tồn tại của thời gian nếu không thì lấy thời gian hiện tại
                    if($request->date_create){
                        $category->date_create=strtotime($request->date_create);
                    }
                    else{
                        $category->date_create=strtotime(date('d-m-Y'));
                    }
                    if($category->save()){
                         Session::flash('messages', 'Đã chỉnh sửa thành công banner'.$category->name);
                        if(isset($file)){
                             $result=$file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
                            if($result){
                                return redirect('admin/banner/');
                            }
                            else{
                                return redirect('admin/banner/');
                            }
                        }
                        return redirect('admin/banner/');
                    }
                     return redirect('admin/banner/');
                }
                 return redirect('admin/banner/');
            }
            return redirect('admin/banner/');
        }
        return redirect('admin/banner/');

    }

    function delete($id){
        //  Check xem co tồn tại không
         $category=Banner_model::where("id",$id)->first();
       
        if($category){
            if( $category->delete()){
                 Session::flash('messages', 'Đã xóa thành công banner'.$category->name);
                return redirect('admin/banner/');
            }
        }
        return redirect('admin/banner/');

    }

   // đệ quy vòng lặp lấy category
   function showCategories($categories, $parent_id = 0, $char = '') {
    foreach ($categories as $key => $item) {
         // Nếu là chuyên mục con thì hiển thị
         if ($item['id_parent'] == $parent_id) {
             $item['name'] = $char . $item['name'];
             
             $this->categorys[] = $item;
             // Xóa chuyên mục đã lặp
             unset($categories[$key]);
        // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
             $this->showCategories($categories, $item['id'], $char . '|---');
            
         }
     }
 }

 // controller danh cho view
     public static function callcontroller(){
        echo(1);
     }
    static function getCategory($id){
        $category=Category_banner_model::find($id);
        return $category;
    }
}
