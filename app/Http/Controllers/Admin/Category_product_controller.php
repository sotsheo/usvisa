<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Model\Category_product_model;
use App\Http\Model\Group_properties_model;
class Category_product_controller extends Controller
{

    function index(){

    	$messages= Session::get('messages');
        $category=Category_product_model::get()->toArray();
        if($category){
            $this->showCategories($category);
            return view("admin.home.category_product.index",["category"=>$this->categorys,'messages'=>$messages]);
        }
        else{
            return view("admin.home.category_product.index",["category"=>$category,'messages'=>$messages]);
        }
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
 	function create_url(string $str){
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
	        foreach ( $unicode as $key => $value ){
	            //So sánh và thay thế bằng hàm preg_replace
	            $str = preg_replace("/($value)/", $key, $str);
	        }
	        //Trả về kết quả
	        return $str;
	    } 
	        //Nếu Dữ liệu không phải kiểu string thì trả về null
	        return null;
	}
    function create(){

		$category=Category_product_model::all();
		$category_list=Category_product_model::all();
        return view("admin.home.category_product.insert",['category'=>$category,'category_list'=>$category_list]);
    }

     function create_catgory_product(Request $request){

        if($request->isMethod('post')){
            $category=new Category_product_model;
            $categorys=Category_product_model::orderBy('id','desc')->first();
            $category->name=$request->name; 
            $category->url_seo=$this->create_url($request->name);
            $category->link="/category/".$category->url_seo."-cp-".'1'.'.html';
            if($categorys){
                $category->link="/category/".$category->url_seo."-cp-".($categorys->id+1).'.html';
            }
            $category->id_parent=0;
             $time=strtotime(date("d-m-Y h:i:s"));
            if($request->id_parent){
                $cat=Category_product_model::find($request->id_parent);
                if($cat){
                    $category->id_parent=$request->id_parent;
                }
            }
            if($request->id_group_properties){
                $properties=Group_properties_model::find($request->id_group_properties);
                if($properties){
                    $category->id_group_properties=$request->id_group_properties;
                }  
            }
            $category->view="";
            $category->view_detail="";
             $category->key_card="";
            if($request->img){
                $file = $request->file('img');
                $destinationPath = 'upload/category_product/';
                $category->img=$destinationPath.$time.".".$file->getClientOriginalExtension();
            }
            if($request->view){
             $category->view=$request->view;
            }  
            if($request->view_detail){
             $category->view_detail=$request->view_detail;
           
            }  
            if($request->id_group_properties){
             $category->id_group_properties=$request->id_group_properties;
           
            }  
            if($request->short_description){
             $category->short_description=$request->short_description;
           
            }  
            if($request->editor1){
             $category->description=$request->editor1;
            }
            $category->state=$request->state;
            if((int)$request->location){
                $category->location=$request->location;
            }
            if($request->get('showhome')){
                    $category->showhome=$request->get('showhome');
                }
           if($request->key_card){
                $category->key_card=$request->key_card;
            }
            $category->user=1;
            // kiểm tra tồn tại của thời gian nếu không thì lấy thời gian hiện tại
            if($request->date_create){
                $category->date_create=strtotime($request->date_create);
            }
            else{
                $category->date_create=strtotime(date('d-m-Y'));
            }
            // kiểm tra tồn tại của thời gian nếu không thì lấy thời gian hiện tại
            if($request->date_public){
                $category->date_public=strtotime($request->date_public);
            }
            else{
                $category->date_public=strtotime(date('d-m-Y'));
            }
            if($category->save()){
            	Session::flash('messages', 'Đã thêm thành công danh mục sản phẩm '.$category->name);
                if(isset( $file)){
                    $result=$file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
                    if($result){
                        return redirect('admin/category_product/');
                    }
                    else{
                        return redirect('admin/category_product/');
                    }
                }
                else{
                	return redirect('admin/category_product/');
                }
               
            }
        }
        return redirect('admin/category_product/');
    }


     function edit($id){
 
		$category=Category_product_model::where('id',$id)->first();
		$category_list=Category_product_model::all();
		if($category){
			return view("admin.home.category_product.edit",['category'=>$category,'category_list'=>$category_list]);
		}
        return redirect('admin/category_product/');
    }

     function edit_catgory_product(Request $request){

     	 if($request->isMethod('post')){
             
            $category=Category_product_model::where('id',$request->id)->first();
	            if($category){
	            $category->name=$request->name; 
	            $category->url_seo=$this->create_url($request->name);
	            $category->link="/category/".$category->url_seo."-cp-".($category->id).'.html';
	            $category->id_parent=0;
                 if($request->get('showhome')){
                    $category->showhome=$request->get('showhome');
                }
                 $time=strtotime(date("d-m-Y h:i:s"));
                if($request->id_parent){
                    $cat=Category_product_model::find($request->id_parent);
                     $category->id_parent=$request->id_parent;
                }
	            $category->view="";
	            $category->view_detail="";
	             $category->key_card="";
	            if($request->img){
	                $file = $request->file('img');
	                $destinationPath = 'upload/category_product/';
	                $category->img=$destinationPath.$time.".".$file->getClientOriginalExtension(); 
	            }
	            if($request->view){
	             $category->view=$request->view;
	           
	            }  
	            if($request->view_detail){
	             $category->view_detail=$request->view_detail;
	           
	            }  
	            if($request->short_description){
	             $category->short_description=$request->short_description;
	           
	            }  
                 if($request->id_group_properties){
                    $category->id_group_properties=$request->id_group_properties;
           
                }  
	            if($request->editor1){
	             $category->description=$request->editor1;
	            }
	            $category->state=$request->state;
	            if((int)$request->location){
	                $category->location=$request->location;
	            }
	           if($request->key_card){
	                $category->key_card=$request->key_card;
	            }
	            $category->user=1;
	            // kiểm tra tồn tại của thời gian nếu không thì lấy thời gian hiện tại
	            if($request->date_create){
	                $category->date_create=strtotime($request->date_create);
	            }
	            else{
	                $category->date_create=strtotime(date('d-m-Y'));
	            }
	            // kiểm tra tồn tại của thời gian nếu không thì lấy thời gian hiện tại
	            if($request->date_public){
	                $category->date_public=strtotime($request->date_public);
	            }
	            else{
	                $category->date_public=strtotime(date('d-m-Y'));
	            }
	            if($category->save()){
	            	Session::flash('messages', 'Đã chỉnh sửa thành công danh mục sản phẩm '.$category->name);
	                if(isset( $file)){
	                    $result=$file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
	                    if($result){
	                        return redirect('admin/category_product/');
	                    }
	                    else{
	                        return redirect('admin/category_product/');
	                    }
	                }
	                else{
	                	return redirect('admin/category_product/');
	                }
	               
	            }
            }
        }
     }


     function delete($id){

     	$category=Category_product_model::where('id',$id)->first();
     	$list_category=Category_product_model::get()->toArray();
        if($category){
           // lấy các danh mục con nằm trong nó
           foreach($list_category as $item){
                if( $item["id_parent"]==$category['id']){
                    $category_children=Category_product_model::where('id',$item["id"])->first();
                    $category_children->delete();
                }
           }
            if( $category->delete()){
            	Session::flash('messages', 'Đã xóa thành công danh mục sản phẩm '.$category->name);
                return redirect('admin/category_product/');
            }
        }
        return redirect('admin/category_product/');
     }
    function get_product_category(Request $request){
        if($request->isMethod('post')){
            $category=Category_product_model::all();
            return $category;
        }else{
            return redirect('admin/menu/');
        }
    }
  
}
