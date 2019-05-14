<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Model\Menu_model;
use App\Http\Model\Category_menu_model;
use App\Http\Model\News_model;
use App\Http\Model\Category_news_model;
use App\Http\Model\Product_model;
use App\Http\Model\Category_product_model;
use App\Http\Model\Websites_model;

class Menu_controller extends Controller
{
    
    function index(){
       $messages= Session::get('messages');
       $category=Category_menu_model::all();
       $menu=Menu_model::orderBy('order')->get();
       $this->new_data=[];
       // lặp dữ liệu
       $data=[];
        $i=0;
        foreach($category as $key){
            $i++;
            foreach($menu as $item){
                if($item->id_category==$key->id){
                       $data[$i][]= $item;
                }
            }
        }
        foreach($data as $key =>$item){
             $this->showCategories($item);
             $this->new_data=$this->categorys;
        }
        return view("admin.home.menu.index",['category'=>$category,'menu'=>$this->new_data,'messages'=>$messages]);
       
    }
    function menu_create_category(){
      
    	return view("admin.home.menu.insert_category");

    }
// Phần  danh mục menu
    function create_category_menu(Request $request){

        if($request->isMethod('post')){
            $category=new Category_menu_model;
            $category->name=$request->name;
            $category->short_description=$request->short_description;

             $category->date_create=strtotime(date('d-m-Y'));
             if($request->date_create){
              $category->date_create=strtotime($request->date_create);
             }
            
            if($category->save()){
                Session::flash('messages', 'Đã thêm thành công menu');
                return redirect('admin/menu/');
            }
        }
        return redirect('admin/menu/');
    }
    // Xoá phần category menu
    function delete_category($id){
        // kiem tra co ton tai hong
        $category_menu=Category_menu_model::where('id',$id)->first();
        if($category_menu){
            // xoa nhung menu nam trong menu category
            $id_category=$category_menu->id;
            $data=Menu_model::where('id_category',$id_category)->get();
            foreach ($data as $key => $menu) {
                // xoa du lieu
                $result=Menu_model::find($menu->id);
                if($result){
                    $result->delete();
                }
            }
            Session::flash('messages', 'Đã xóa thành công menu '.$category_menu->name);
             $category_menu->delete();
        }
         return redirect('admin/menu/');
        
    }

    function edit_category($id){
        $category=Category_menu_model::where('id',$id)->first();
        if($category){
            return view("admin.home.menu.edit_category",['category'=>$category]);
        }
         return redirect('admin/menu/');
    }


    function edit_category_p(Request $request){
         if($request->isMethod('post')){
             $category= Category_menu_model::find($request->id);
            $category->name=$request->name;
            $category->short_description=$request->short_description;
            $category->date_create=strtotime($request->date_create);
            if($category->save()){
                Session::flash('messages', 'Đã chỉnh sửa thành công menu');
                return redirect('admin/menu/');
            }
        }
         return redirect('admin/menu/');
    }


     // Phần menu 
    function create_menu_id($id){
        $category= Category_menu_model::where('id',$id)->first();
        $menu= Menu_model::where('id_category',$category->id)->get();

        // Lấy tất cả du liệu về đường dẫn 
        $category_news= Category_news_model::all();
        $news= News_model::all();
        $category_product= Category_product_model::all();
        $product= Product_model::all();
        //  kiểm tra sự tồn tại của category
        if($category){
            return view("admin.home.menu.insert_menu",['id_category'=>$id,'category'=>$menu,'news'=>$news,'category_news'=>$category_news,'product'=>$product,'category_product'=>$category_product]);
        }
        return redirect('admin/menu/');

    }
    function create_menu_id_cr(Request $request){
        if($request->isMethod('post')){
            $menu=new  Menu_model;
            $menu->name=$request->name;
            $menu->link=$request->link;
            if($request->id_category){
                $category_p= Category_menu_model::find($request->id_category);
            }
            if($category_p){
                $menu->id_category=$request->id_category;
                $menu->id_parent=$request->id_parent;
                $menu->date_public=strtotime(date("d-m-Y"));
                 $time=strtotime(date("d-m-Y h:i:s"));
                $menu->img="";
                $menu->icon="";
                $menu->link="";
                $menu->state=0;
                if($request->img){
                    $file = $request->file('img');
                    $destinationPath = 'upload/menu/img/';
                    $menu->img=$destinationPath.$time.".".$file->getClientOriginalExtension();
                }
                if($request->icon){
                    $files = $request->file('icon');
                    $destinationPaths = 'upload/menu/icon/';
                    $menu->icon=$destinationPaths.$time.".".$files->getClientOriginalExtension();
                }
                if($request->state){
                    $menu->state=$request->state;
                }
                $menu->order=0;
                if($request->order){
                    $menu->order=$request->order;
                }
                $menu->short_description="";
                if($request->short_description){
                    $menu->short_description=$request->short_description;
                }
                $menu->date_create=strtotime(date("d-m-Y"));
              
                if($request->link){
                    $menu->link=$request->link;
                }
                if($menu->save()){
                     Session::flash('messages', 'Đã thêm thành công menu thuộc '.$category_p->name);
                   if(isset($file)){
                         $result=$file->move($destinationPath,$time.".".$file->getClientOriginalExtension());        
                    }
                     if(isset($files)){
                        $results=$files->move($destinationPaths,$time.".".$files->getClientOriginalExtension());
                    }
                    return redirect('admin/menu/');
                }
            }
        }
         return redirect('admin/menu/');
    }

    function edit_menu($id){
       $menu=Menu_model::where('id',$id)->first();
       $category= Menu_model::where('id_category',$menu->id_category)->get();
        $category_news= Category_news_model::all();
        $news= News_model::all();
        $category_product= Category_product_model::all();
        $product= Product_model::all();
       if($menu){
            return view("admin.home.menu.edit_menu",['menu'=>$menu,'category'=>$category,'category_news'=>$category_news,'news'=>$news,'product'=>$product,'category_product'=>$category_product]);
       }
       else{
         return redirect('admin/menu/');
       }
    }

    function edit_menu_p(Request $request){
       if($request->isMethod('post')){
        $menu=Menu_model::where('id',$request->id)->first();
         $time=strtotime(date("d-m-Y h:i:s"));
         if($menu){
            $category_p=0;
            if($request->id_category){
                $category_p= Category_menu_model::find($request->id_category);
            }
            if($category_p){
                $menu->name=$request->name;
                $menu->link=$request->link;
                $menu->id_parent=$request->id_parent;
                $menu->date_public=strtotime(date("d-m-Y"));

                $menu->link="";
                $menu->state=0;
                if($request->img){
                    $file = $request->file('img');
                    $destinationPath = 'upload/menu/img/';
                    $menu->img=$destinationPath.$time.".".$file->getClientOriginalExtension();
                }
                if($request->icon){
                    $files = $request->file('icon');
                    $destinationPaths = 'upload/menu/icon/';
                    $menu->icon=$destinationPaths.$time.".".$files->getClientOriginalExtension();
                }
                if($request->state){
                    $menu->state=$request->state;
                }
                $menu->order=0;
                if($request->order){
                    $menu->order=$request->order;
                }
                $menu->short_description="";
                if($request->short_description){
                    $menu->short_description=$request->short_description;
                }
                $menu->date_create=strtotime(date("d-m-Y"));
              
                if($request->link){
                    $menu->link=$request->link;
                }
                //return $menu->link;
                if($menu->save()){
                     Session::flash('messages', 'Đã chỉnh sửa thành công menu thuộc '.$category_p->name);
                    if(isset($file)){
                         $result=$file->move($destinationPath,$time.".".$file->getClientOriginalExtension());        
                    }
                     if(isset($files)){
                        $results=$files->move($destinationPaths,$time.".".$files->getClientOriginalExtension());
                    }
                    return redirect('admin/menu/');
                }
            }
            return redirect('admin/menu/');
         }
         return redirect('admin/menu/');
       }
        return redirect('admin/menu/');
    }
    

    function delete_menu($id){
        //  Check xem co tồn tại không

        $menu=Menu_model::where('id',$id)->first();
        if($menu){
            $category=Menu_model::where('id_parent',$menu->id)->get();
            if($category){
                 foreach ($category as $key => $item) {
                     $item->delete();
                 }
             }
              $category_p= Category_menu_model::find($menu->id_category);
            if( $menu->delete()){
                Session::flash('messages', 'Đã chỉnh sửa thành công menu thuộc '.$category_p['name']);
                return redirect('admin/menu/');
            }
            
        }
       return redirect('admin/menu/');
    }

    
    function menu_get(Request $request){
        $category=Category_menu_model::all();
        $data['limit']=0;
        $data['category']=$category;
        return $data;
       
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
  
}
