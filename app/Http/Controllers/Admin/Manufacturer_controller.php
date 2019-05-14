<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Model\Manufacturer_model;

class Manufacturer_controller extends Controller
{

    function index(){

        $messages= Session::get('messages');
        $manufacturer=Manufacturer_model::paginate(10);
        return view("admin.home.manufacturer.index",['manufacturer'=>$manufacturer,'messages'=>$messages]);
    }

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
    function create(){
       return view("admin.home.manufacturer.insert");
    }
    function create_manufacturer(Request $request){
        if($request->isMethod('post')){
            $manufacturer=new Manufacturer_model;
            $manufacturer->name=$request->name;
            $manufacturer->link="";
            $manufacturer->short_description="";
            $manufacturer->description="";
            $manufacturer->url_seo=$this->create_url($request->name);
             $time=strtotime(date("d-m-Y h:i:s"));
            if($request->link){
                $manufacturer->link=$this->create_url($request->link);
            }
            else{
                $manufacturer->link=$manufacturer->url_seo."-m-";  
            }               
            $manufacturer->img="";
            if($request->img){
                $file = $request->file('img');
                $destinationPath = 'upload/manufacturer/';
                $manufacturer->img=$destinationPath.$time.".".$file->getClientOriginalExtension();
            }
            if($request->short_description){
                $manufacturer->short_description=$request->short_description;
            }
            if((int)$request->location){
                $manufacturer->location=$request->location;
            }
            if($request->editor1){
                $manufacturer->description=$request->editor1;
            }
            $manufacturer->state=$request->state;
            // kiểm tra tồn tại của thời gian nếu không thì lấy thời gian hiện tại
            $manufacturer->date_create=strtotime(date('d-m-Y'));
            if($request->date_create){
                $manufacturer->date_create=strtotime($request->date_create);
            }
            $manufacturer->date_public=strtotime(date('d-m-Y'));
            if($request->date_public){
                 $manufacturer->date_public=strtotime($request->date_public);
            }
            if($manufacturer->save()){
                 Session::flash('messages', 'Đã thêm thành công hãng sản xuất'.$manufacturer->name);
                if(isset($file)){
                     $result=$file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
                    if($result){
                        return redirect('admin/manufacturer/');
                    }
                    else{
                        return redirect('admin/manufacturer/');
                    }
                }
                return redirect('admin/manufacturer/');
                    
            }
                
            return redirect('admin/manufacturer/');
        }
        return redirect('admin/manufacturer/');
    }

    function edit($id){
        $manufacturer=Manufacturer_model::where('id',$id)->first();
        if($manufacturer){
            return view("admin.home.manufacturer.edit",['manufacturer'=>$manufacturer]);
        }
        return redirect('admin/manufacturer/');
    }

    function edit_manufacturer(Request $request){
        if($request->isMethod('post')){

            if($request->id){
                $manufacturer= Manufacturer_model::where('id',$request->id)->first();
                if( $manufacturer){
                    $manufacturer->name=$request->name;
                        $manufacturer->link="";
                        $manufacturer->short_description="";
                        $manufacturer->description="";
                        $manufacturer->url_seo=$this->create_url($request->name);
                        if($request->link){
                            $manufacturer->link=$this->create_url($request->link);
                        }
                        else{
                            $manufacturer->link=$manufacturer->url_seo."-m-";  
                        }      
                        $manufacturer->img="";
                        if($request->img){
                            $file = $request->file('img');
                            $destinationPath = 'upload/manufacturer/';
                            $manufacturer->img=$destinationPath.$time.".".$file->getClientOriginalExtension();
                        }
                        if($request->short_description){
                            $manufacturer->short_description=$request->short_description;
                        }
                        if((int)$request->location){
                            $manufacturer->location=$request->location;
                        }
                        if($request->editor1){
                            $manufacturer->description=$request->editor1;
                        }
                        $manufacturer->state=$request->state;
                        // kiểm tra tồn tại của thời gian nếu không thì lấy thời gian hiện tại
                        $manufacturer->date_create=strtotime(date('d-m-Y'));
                        if($request->date_create){
                            $manufacturer->date_create=strtotime($request->date_create);
                        }
                         $manufacturer->date_public=strtotime(date('d-m-Y'));
                        if($request->date_public){
                             $manufacturer->date_public=strtotime($request->date_public);
                        }

                        if($manufacturer->save()){
                             Session::flash('messages', 'Đã chỉnh sửa thành công thành công hãng sản xuất'.$manufacturer->name);
                            if(isset($file)){
                                 $result=$file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
                                if($result){
                                    return redirect('admin/manufacturer/');
                                }
                                else{
                                    return redirect('admin/manufacturer/');
                                }
                            }
                            return redirect('admin/manufacturer/');
                                
                        }
                            
                        return redirect('admin/manufacturer/');
                }
                return redirect('admin/manufacturer/');
            }
            
        }
        return redirect('admin/manufacturer/');
    }

    function delete($id){
        $w=Websites_model::where('status','1')->first();
        $manufacturer=Manufacturer_model::where('id_site',$w->id)->where('id',$id)->first();
        if($manufacturer){
            $name=$manufacturer->name;
            if($manufacturer->delete()){
                Session::flash('messages', 'Đã chỉnh sửa thành công thành công hãng sản xuất'.$name);
            }
            return redirect('admin/manufacturer/');
        }
        return redirect('admin/manufacturer/');
    }
    static function get_Manufacturer(){

        $manufacturer=Manufacturer_model::all();
        return $manufacturer;
    }
}
