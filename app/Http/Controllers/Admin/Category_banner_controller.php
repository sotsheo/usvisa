<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Http\Model\Banner_model;
use  App\Http\Model\Category_banner_model;
use App\Http\Model\Websites_model;
class Category_banner_controller extends Controller
{
   
    function index(){
        $messages= Session::get('messages');
        $category=Category_banner_model::paginate(10);
        return view("admin.home.category_banner.index",["category_banner"=>$category,'messages'=>$messages]);
    }
    function create(){
    	return view("admin.home.category_banner.insert");

    }
    function create_cat(Request $request){
        if($request->isMethod('post')){
            $category=new Category_banner_model;
            $category->name=$request->name;
            $category->short_description="";
             $time=strtotime(date("d-m-Y h:i:s"));
            if($request->short_description){
                $category->short_description=$request->short_description;
            }
            $category->img="";
            if($request->img){
                $file = $request->file('img');
                $destinationPath = 'upload/category_banner/';
                $category->img=$destinationPath.$time.".".$file->getClientOriginalExtension();
            }
            $category->state=$request->state;
            // kiểm tra tồn tại của thời gian nếu không thì lấy thời gian hiện tại
            $category->date_create=strtotime(date("d-m-Y"));
            if($request->date_create){
                $category->date_create=strtotime($request->date_create);
            }
            if($category->save()){
                 Session::flash('messages', 'Đã thêm thành công danh mục banner '. $category->name);
                if(isset($file)){
                        $result=$file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
                        if($result){
                            return redirect('admin/category_banner/');
                        }
                        else{
                            return redirect('admin/category_banner/');
                        }
                }
                else{
                    return redirect('admin/category_banner/');
                }
            }
        }
        return redirect('admin/banner/');

    }
    function edit($id){

       $category=Category_banner_model::where('id',$id)->first();
       if($category){
         return view("admin.home.category_banner.edit",['category'=>$category]);
       }
       return redirect('admin/banner/');
    }
    function edit_cat(Request $request){

        if($request->isMethod('post')){
            
           $category=Category_banner_model::where('id',$request->id)->first();
             $time=strtotime(date("d-m-Y h:i:s"));
            if($category){
                $category->name=$request->name;
                $category->short_description="";
            if($request->short_description){
                $category->short_description=$request->short_description;
            }
            if($request->img){
                $file = $request->file('img');
                $destinationPath = 'upload/category_banner/';
                $category->img=$destinationPath.$time.".".$file->getClientOriginalExtension();
            }
            $category->state=$request->state;
            // kiểm tra tồn tại của thời gian nếu không thì lấy thời gian hiện tại
            if($request->date_create){
                $category->date_create=strtotime($request->date_create);
            }
            else{
                $category->date_create=strtotime(date("d-m-Y"));
            }
                if($category->save()){
                    Session::flash('messages', 'Đã chỉnh sửa thành công danh mục banner '. $category->name);
                    if(isset($file)){
                        $result=$file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
                        
                            if($result){
                                return redirect('admin/category_banner/');
                            }
                            else{
                                return redirect('admin/category_banner/');
                            }
                       
                    }
                    else{
                        return redirect('admin/category_banner/');
                    }
                    
                }
                 return redirect('admin/category_banner/');
             }
        }
        return redirect('admin/banner/');

    }

    function delete($id){
        //  Check xem co tồn tại không

       $category=Category_banner_model::where('id',$id)->first();
       
        if($category){
            if( $category->delete()){
               Session::flash('messages', 'Đã xóa thành công danh mục banner '. $category->name);
                return redirect('admin/category_banner/');
            }
        }
        return redirect('admin/category_banner/');

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

    public function getListbannerCategory($id_category){
        $category=Category_banner_model::where('id',$id_category)->first();
        $banner=[];
        if($category){
             $banner=Banner_model::where("id_category",$category->id)->where("id_site",$w->id)->get();
            return $banner;
        }
       
        return $banner;

    }
    function get_category_banner(){
        $category=Category_banner_model::all();
        $data['limit']=0;
        $data['category']=$category;
        return $data;
    }
}
