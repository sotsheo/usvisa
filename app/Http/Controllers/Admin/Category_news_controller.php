<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Http\Model\Category_news_model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Http\Model\News_model;
class Category_news_controller extends Controller
{
     public function __construct()
    {
        $category=Category_news_model::groupBy("order");
        // tất cả danh mục bài viết
        View::share('model.categorynews.index', $category);
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
     //  hàm tạo url
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


    function index(){
        $messages= Session::get('messages');
        $category=Category_news_model::get()->toArray();
        if($category){
            $this->showCategories($category);
            return view("admin.home.category_news.index",["category_news"=>$this->categorys,'messages'=>$messages]);
        }
        else{
            return view("admin.home.category_news.index",["category_news"=>$category,'messages'=>$messages]);
        }
    }
    function create(){
    	return view("admin.home.category_news.insert",["category"=>Category_news_model::all()]);
    }
    function create_news(Request $request){
        if($request->isMethod('post')){
            $category=new Category_news_model;
            $this->actionModel($category,$request);
           
        }
         return redirect('admin/category_news/');
    }


    function edit($id){
       $category=Category_news_model::where("id",$id)->first();
       $list_category=Category_news_model::all();
       if($category){
        return view("admin.home.category_news.edit",['category'=>$category,'list_category'=> $list_category]);
       }
        return redirect('admin/category_news/');

    }
    function edit_news(Request $request){

        if($request->isMethod('post')){

            $category=Category_news_model::find($request->id);
             $time=strtotime(date("d-m-Y h:i:s"));
            if($category){
                $this->actionModel($category,$request);
            }
        }
        return redirect('admin/category_news/');

    }
    function get_news_category(Request $request){
        if($request->isMethod('post')){
            $category=Category_news_model::all();
            return $category;
        }else{
            return redirect('admin/menu/');
        }
    }

    function delete($id){
        //  Check xem co tồn tại không
        $category=Category_news_model::where("id",$id)->first();
        $list_category=Category_news_model::get()->toArray();
        if($category){
           // lấy các danh mục con nằm trong nó
           foreach($list_category as $item){
                if( $item["id_parent"]==$category['id']){
                    $category_children=Category_news_model::find( $item["id"]);
                    $category_children->delete();
                }
           }
           $name=$category->name;
            if($category->delete()){
                    Session::flash('messages', 'Đã xóa thành công danh bài viết '.$name);
                    return redirect('admin/category_news/');
               }
            }
            return redirect('admin/category_news/');
        }

        // action model
    function actionModel($category,$request){
            $category->name=$request->name;
            $category->id_parent=0;
            $category->url_seo=$this->create_url($request->name);
            $category->link="/category/".$category->url_seo."-cn-".'1'.'.html';
            $categorys=Category_news_model::orderBy('id','desc')->first();
            if($categorys){
                $category->link="/category/".$category->url_seo."-cn-".($categorys->id+1).'.html';
            }
            $time=strtotime(date("d-m-Y h:i:s"));
            if($request->id_parent){
                $cat=Category_news_model::find($request->id_parent);
                $category->id_parent=$request->id_parent;
            }
            $category->state=0;
            if($request->state){
                $category->state=$request->state;
            }
            if($request->view){
                $category->view=$request->view;
            }
            if($request->view_detail){
                $category->view_detail=$request->view_detail;
            }
            if($request->img){
                $file = $request->file('img');
                $destinationPath = 'upload/category_news/';
                $category->img=$destinationPath.$time.".".$file->getClientOriginalExtension();
            }
            if($request->order){
                $category->order=$request->order;
            }
            if($request->ishome){
                $category->ishome=$request->ishome;
            }
            if($request->short_description){
                 $category->short_description=$request->short_description;
            }
            if($request->id_parent){
                 $cat=Category_news_model::find($request->id_parent);
                $category->id_parent=$request->id_parent;
            }
            if($request->editor1){
                 $category->description=$request->editor1;
            }
            $category->user=1;
            if($request->key_card){
                $category->key_card=$request->key_card;
            }
                // kiểm tra tồn tại của thời gian nếu không thì lấy thời gian hiện tại
            $category->date_create=strtotime(date('d-m-Y'));
            if($request->date_create){
                $category->date_create=strtotime($request->date_create);
            }
                // kiểm tra tồn tại của thời gian nếu không thì lấy thời gian hiện tại
            $category->date_public=strtotime(date('d-m-Y'));
            if($request->date_public){
                $category->date_public=strtotime($request->date_public);
            }
            if($category->save()){
                Session::flash('messages', 'Đã sửa thành công danh bài viết '.$category->name);
                if(isset( $file)){
                     $result=$file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
                }
        }
        return redirect('admin/category_news/');
    }
    public static function get_category(){
        $category=Category_news_model::where('ishome',1)->get();
        $data['limit']=0;
        $data['limit_category']=0;
        $data['category']=$category;
        return $data;
    }

    public  static function categoryishome($limit_category,$limit){
        if($limit_category && $limit){
            $categorys=array();
            $category=Category_news_model::where('ishome',1)->limit($limit_category)->get();
            if($category){
                foreach($category as $cate){
                    $news=News_model::where('id_category',1)->limit($limit)->get();
                    $cate['news']=$news;
                    $categorys[]=$cate;
                }
            }
            return $categorys;
        }
    }
}
