<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Model\Product_model;
use App\Http\Model\Category_product_model;
use App\Http\Model\Manufacturer_model;
class Product_controller extends Controller
{

    function index(){
    	$messages= Session::get('messages');
      $product=Product_model::orderByRaw('location ASC,id DESC')->paginate(10);
      $category=Category_product_model::all();
      return view("admin.home.product.index",['product'=>$product,'category'=>$category,'messages'=>$messages]);
    }

    function product(Request $request){
      $messages= Session::get('messages');
      $product=Product_model::orderByRaw('location ASC,id DESC')->paginate(10);
      $category=Category_product_model::all();

      $name='';
      $id_category=0;
      $state=-1;
      $id_manufacturer=0;
      if($request->isMethod('post')){
          if($request->name){
              $name=strtolower($request->name);
          }
          if($request->id_category){
              $id_category=$request->id_category;
          }
          if($request->state!=-1){
              $state=$request->state;
          }
        
          $product=Product_model::orderByRaw('location ASC,id DESC')->where("name",'like','%'.$name.'%')->paginate(10);
          $where=array();
          if($id_category){
              $where['id_category']=$id_category;
          }
          if($state!=-1 && isset($state)){
              $where['state']=$state;
          }
        
          if(count($where)>0){
            $product=Product_model::orderByRaw('location ASC,id DESC')->where("name",'like','%'.$name.'%')->where($where)->paginate(10); 

          }
    
      }
      return view("admin.home.product.index",['product'=>$product,'category'=>$category,'messages'=>$messages,'name'=>$name,'where'=>$where]);
    }
     function create(){
        $manufacturer=Manufacturer_model::all();
     		$category=Category_product_model::all();
     		return view("admin.home.product.insert",['category'=>$category,'manufacturer'=>$manufacturer]);
     }

      function create_product(Request $request){
      		if($request->isMethod('post')){
      			$product=new Product_model;
      			$check=0;
      			$category=[];
             $products=Product_model::orderBy('id','desc')->first();
      			$time=strtotime(date("d-m-Y h:i:s"));
      			if($request->id_manufacturer){
      				$pro=Manufacturer_model::find($request->id_manufacturer);
      				if(!$pro){
      					$check=1;
      				}
      			}
      			if($request->id_category){
      				$category=Category_product_model::find($request->id_category);
      				if(!$category){
      					$check=1;
      				}
      			}

      			if($check==0){
      				$product->name =$request->name;
      				$product->code='';
      				if($request->code){
      					$product->code =$request->code;
      				}
              $product->url_seo =$this->create_url($request->name);
      				if($request->url_seo){
      					$product->url_seo =$this->create_url($request->url_seo);
      				}
      				
      				$product->id_category =$request->id_category;
      				$product->id_manufacturer=0;
      				if($request->id_manufacturer){
      					$product->id_manufacturer =$request->id_manufacturer;
      				}
      				if((int)$request->price){
      					$product->price =$request->price;
      				}
              if($request->manufacturer){
                $product->manufacturer =$request->manufacturer;
              }
      				if((int)$request->price_market){
      					$product->price_market =$request->price_market;
      				}
      				$product->short_description =$request->short_description;
      				$product->description ='';
      				if($request->editor1){
      					$product->description =$request->editor1;
      				}
      				$product->img='';
      				$destinationPath = 'upload/product/';
      				if($request->img){
      					$file = $request->file('img');
		                $product->img=$destinationPath.$time.".".$file->getClientOriginalExtension();
      				}
              $product->link="/product/".$product->url_seo."-pd-".'1'.'.html';
              if($products){
                $product->link="/product/".$product->url_seo."-pd-".($products->id+1).'.html';
              }
      				
      				$product->state =$request->state;
      				if($request->get('ishot', 0)!=0){
                    	$product->ishot=1;
                	}
      				if($request->get('isselling', 0)!=0){
                    	$product->isselling=1;
                	}
                	$product->key_card='';
                	if($request->key_card){
                		$product->key_card =$request->key_card;
                	}
      				if((int)$request->location){
      					$product->location =$request->location;
      				}
      				$product->imgs='';
      				$product->user=1;
      				$product->date_create=strtotime(date("d-m-Y"));
      				if($request->date_create){
                    $product->date_create=strtotime($request->date_create);
		            }
		            $product->date_public=strtotime(date("d-m-Y"));
      				if($request->date_public){
                    $product->date_public=strtotime($request->date_public);
		            }
      				$files = $request->file('attachment');
      					$i=0;
						if($request->hasFile('attachment'))
						{
						    foreach ($files as $f) {
						    	$i++;
						    	if($i==1){
						    		$product->imgs=$destinationPath.($time+$i).".".$f->getClientOriginalExtension();
						    		
						    	}else{
						    		$product->imgs.=' , '.$destinationPath.($time+$i).".".$f->getClientOriginalExtension();
						    	}
						    }
						}
      				if($product->save()){
      				 	Session::flash('messages', 'Đã thêm thành công sản phẩm'.$category->name);
      				 	 if(isset($file)){
      				 	 	$result=$file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
      				 	}
      				 	if($product->imgs ){
      				 		$i=0;
      				 		foreach ($files as $f) {
      				 			$i++;
      				 			$results=$f->move($destinationPath,($time+$i).".".$f->getClientOriginalExtension());
      				 		}
      				 	}
      				 	return redirect('admin/product/');
      				 }
      			}
      			
      		}
      		return redirect('admin/product/');
    }
    function edit($id){
     	$product=Product_model::where('id',$id)->first();
     	if($product){

				$cat=Category_product_model::where('id',$product->id_category)->first();
				$category=Category_product_model::all();

     		return view("admin.home.product.edit",[
     			'product'=>$product,
					'cat'=>$cat,
					'category'=>$category
     		]);
     	} 	
    }

    function edit_product(Request $request){

		 if($request->isMethod('post')){
      			$product=Product_model::where('id',$request->id)->first();
            if($request->id_category){
      				$category=Category_product_model::find($request->id_category);
      				if(!$category){
      					$check=1;
      				}
      			}
      			if($product){
	      			$time=strtotime(date("d-m-Y h:i:s"));
	      			$product->name =$request->name;
      				$product->code='';
      				if($request->code){
      					$product->code =$request->code;
      				}
      				if($request->url_seo){
      					$product->url_seo =$this->create_url($request->url_seo);
      				}else{
      					$product->url_seo =$this->create_url($request->name);
      				}
      				$product->id_category =$request->id_category;
      				$product->id_manufacturer=0;
      				if($request->id_manufacturer){
      					$product->id_manufacturer =$request->id_manufacturer;
      				}
      				if((int)$request->price){
      					$product->price =$request->price;
      				}
      				if((int)$request->price_market){
      					$product->price_market =$request->price_market;
      				}
      				$product->short_description =$request->short_description;
      				$product->description ='';
      				if($request->editor1){
      					$product->description =$request->editor1;
      				}
              
      				$destinationPath = 'upload/product/';
      				if($request->img){
      					$file = $request->file('img');
		                $product->img=$destinationPath.$time.".".$file->getClientOriginalExtension();
      				}
      				$product->link="/product/".$product->url_seo."-pd-".($product->id).'.html';
      				$product->state =$request->state;
      				if($request->get('ishot', 0)!=0){
                    	$product->ishot=1;
                	}
      				if($request->get('isselling', 0)!=0){
                    	$product->isselling=1;
                	}
                	$product->key_card='';
                	if($request->key_card){
                		$product->key_card =$request->key_card;
                	}
      				if((int)$request->location){
      					$product->location =$request->location;
      				}
      				$product->imgs='';
      				$product->user=1;
      				$product->date_create=strtotime(date("d-m-Y"));
      				if($request->date_create){
                   		 $product->date_create=strtotime($request->date_create);
		            }
		            $product->date_public=strtotime(date("d-m-Y"));
      				if($request->date_public){
                    	$product->date_public=strtotime($request->date_public);
		            }
		            $str=explode(',',$request->file_now);
		            $stem='';
		            $i=0;
		    		foreach ($str as  $value) {
		    			if($value){
		    				$i++;
		    				if($i==1){
		    					$stem=$value;
		    				}else{
		    					$stem.=' , '.$value;
		    				}
		    			}
		    		}
		    		$product->imgs=$stem;
		    		$files = $request->file('attachment');
      					$i=0;
						if($request->hasFile('attachment'))
						{
						    foreach ($files as $f) {
						    $i++;
						    if($i==1 && $stem==''){
						    	$product->imgs=$destinationPath.($time+$i).".".$f->getClientOriginalExtension();
						    }else{
						    		$product->imgs.=' , '.$destinationPath.($time+$i).".".$f->getClientOriginalExtension();
						    	}
						    }
						}
					  if($product->save()){
      				 	Session::flash('messages', 'Đã thêm thành công sản phẩm'.$category->name);
               
      				 	if(isset($file)){
      				 	 	$result=$file->move($destinationPath,$time.".".$file->getClientOriginalExtension());   				 	 	
      				 	}
      				 	if($files){
      				 		$i=0;
      				 		foreach ($files as $f) {
      				 			$i++;
      				 			$results=$f->move($destinationPath,($time+$i).".".$f->getClientOriginalExtension());
      				 		}
      				 	}
      				 	return redirect('admin/product/');
      				 }
		           return redirect('admin/product/');
      			}
      	}
      	return redirect('admin/product/');
    }

    function delete($id){
    	$product=Product_model::where('id',$id)->first();
    	if($product){
    		$name=$product->name;
    		if($product->delete()){
    			Session::flash('messages', 'Đã xóa thành công sản phẩm'.$name);
    		}
    		return redirect('admin/product/');
    	}
    	return redirect('admin/product/');
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

    // get all manufaturer in category
    static function get_manufaturer($urls){
      $data=[];
      $url=explode('-cp-', $urls);
      if(isset($url[1])){
         $category=Category_product_model::find($url[1]);
         if($category){
            $data=Manufacturer_model::join('product', 'product.id_manufacturer', '=', 'manufacturer.id')->where('product.id_category','=',$category->id)->select('manufacturer.id','manufacturer.name')->distinct()->get();
         }
      }
      return $data;
    }

    // get product category
    static function get($id,$limit){
      $products=Product_model::where('id_category',$id)->limit($limit)->get();
      return  $products;
    }
}
