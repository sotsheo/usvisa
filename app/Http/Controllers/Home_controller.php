<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Model\News_model;
use App\Http\Model\Category_news_model;
use App\Http\Model\Product_model;
use App\Http\Model\Category_product_model;
use App\Http\Model\Website_model;
use App\Http\Model\Introduce_model;
class Home_controller extends Controller
{
    function __construct()
    {
        $w=Website_model::find(1);
        if($w){view()->share('w', $w);}
        else{
            $w=new Website_model;
            view()->share('w', $w);
        }
    }

    function index(){

        return view("view.view.home",['meta_description'=>"Home"]);
    }
    function url($urls,Request $request){
        $this->breadcrumb[0]=['name'=>'home','link'=>url('/')];
       
       
        // Check la liên hệ
         if($urls=='lien-he.html'){
            $this->breadcrumb[]=['name'=>'Liên hệ','link'=>''];
            view()->share('breadcrumb', $this->breadcrumb);
            return view("view.view.site.contact");
         }
        // Check la giới thiệu
         if($urls=='gioi-thieu.html'){

            $data=Introduce_model::first();
            $this->breadcrumb[]=['name'=>'Giới thiệu','link'=>''];
            view()->share('breadcrumb', $this->breadcrumb);
            return view("view.view.site.introduce",['data'=>$data]);
         }
         return redirect('themes');
    }

    function search(Request $request){
        $this->breadcrumb[0]=['name'=>'home','link'=>url('/')];
        $this->breadcrumb[]=['name'=>'search','link'=>''];
        view()->share('breadcrumb', $this->breadcrumb);

        if($request->t){
            $data=[];
            if(strlen($request->t)>=2){
                $data=News_model::where('name', 'like', '%'.$request->t.'%')->paginate(10);
                $data->appends(['t' => $request->t]);

                if(count($data)>0){
                    return view("view.view.search.news",['news'=>$data,'t'=>$request->t]);
                }

                $data=Product_model::where('name', 'like', '%'.$request->t.'%')->paginate(10);
                 $data->appends(['t' => $request->t]);
                if(count($data)>0){
                    return view("view.view.search.product",['product'=>$data,'t'=>$request->t]);
                } 
              
                return view("view.view.search.news",['news'=>$data,'t'=>$request->t]);
            }
            else{
                 return view("view.view.search.news",['t'=>'Tìm kiếm phải trên 2 kí tự','news'=>$data]);
            }
           
        }
        return redirect('themes');
    }   

    /*Sort*/
    function sort($pagesize,$price_min,$price_max,$sort_name,$sort_by,$id_category){
        $product=[];
        switch ($sort_name) {
            case 'name':
                $sort_name='name';
                $sort_b='ASC';
            break;
            case 'name_desc':
                $sort_name='name';
                $sort_b='DESC';
           break;
           case 'price_desc':
                $sort_name='name';
                 $sort_b='ASC';
           break;
           case 'price':
                $sort_name='price';
                $sort_b='DESC';
           break;
           case 'new_desc':
                $sort_name='id';
                $sort_b='DESC';
           break;
           case 'new':
                $sort_name='id';
                $sort_b='ASC';
           break;
           
       }
       $product=Product_model::where('id_category', $id_category)->orderBy($sort_name, $sort_by)->paginate($pagesize);
        if($price_max>0){
            $product=Product_model::where('id_category', $id_category)->orderBy($sort_name, $sort_by)->where('price','>=',$price_min)->where('price','<=',$price_max)->paginate($pagesize);
        }
       return $product;
    }

    function themes(){
        $w=Websites_model::all();
        return view("themes.view",['w'=>$w]);
    }
    function active_themes($id){
        if($id){
            $w=Websites_model::find($id);
                if($w->status!=1){
                    if($w){
                        $data=Websites_model::where('status',1)->get();
                        foreach ($data as $key ) {
                            $tem=Websites_model::find($key->id);
                            $tem->status=0;
                            $tem->save();
                        }

                        $w->status=1;
                        $w->save();
                    }
                }
           
        }
        return redirect('themes');
    }

    function page($category,$id){
        $wb=Website_model::first();
        $request= new Request();
        $this->breadcrumb[0]=['name'=>'home','link'=>url('/')];
        switch ($category) {
            case 'category':
            // Kieerm tra co phai danh muc tin uc khong
                    $url=explode('-cn-', $id);
                            if(isset($url[1])){
                                $url=explode('.', $url[1]);
                                $category=Category_news_model::where('id',$url[0])->first();
                                $page=$wb->page_size;

                                if($category){
                                     // lấy tin tức thuộc danh mục trên

                                     $news=News_model::where('id_site',$w->id)->where('id_category', $category->id)->paginate($page);
                                        // // kiểm tra xem no có layout khác k 
                                    $this->breadcrumb[]=['name'=>$category->name,'link'=>url($category->link)];
                                    view()->share('breadcrumb', $this->breadcrumb);
                                    if(view()->exists($category->view)){
                                            $view=$w->name.".view.news.".$category[0]->view;
                                            return view($view,['category'=>$category,'news'=>$news,'breadcrumb'=>$this->breadcrumb,'w'=>$w]);
                                         }
                                         else{
                                             return view($w->name.".view.news.category",['category'=>$category,'news'=>$news,'breadcrumb'=>$this->breadcrumb,'w'=>$w]);
                                         } 
                                }

                    }


                    // Kiem tra co phai danh muc san pham khong
                     $url=explode('-cp-', $id);
                        if(isset($url[1])){
                            $url=explode('.', $url[1]);
                            $page=$wb->page_size;
                            $sortmanufacturer='';
                            $sort_name='location';
                            $sort_by='desc';
                            $price_min=0;
                            $price_max=0;
                            // Kiểm tra có pagesize k 
                                if($request->pagesize){
                                   if((int)$request->pagesize!=0){
                                        $page=$request->pagesize;
                                   }
                                }
                                if($request->sortmanufacturer){
                                   if($request->sortmanufacturer){
                                        $sortmanufacturer=$request->sortmanufacturer;
                                   }
                                }
                                 $category=Category_product_model::where('id',$url[0])->first();
                                if(isset($request->price_min) && $request->price_max){
                                    $price_min=$request->price_min;
                                    $price_max=$request->price_max;
                                }
                                if($category){
                                    // lấy danh mục 
                                    // Thuc hien search 
                                     $product=$this->sort($page,$price_min,$price_max,$sort_name,$sort_by,$category->id);
                                     //return $product;
                                    
                                    // // kiểm tra xem no có layout khác k 
                                    $this->breadcrumb[]=['name'=>$category->name,'link'=>url($category->link)];
                                    view()->share('breadcrumb', $this->breadcrumb);

                                     if($category->view_detail){
                                        $view=$w->name.".view.product.".$category->view_detail;
                                        return view($view,['category'=>$category,'product'=>$product]);
                                     }
                                     else{
                                         return view("view.view.product.category",['category'=>$category,'product'=>$product]);
                                     } 
                                }
                        }
                break;
            
            case 'news':
                // kiểm tra có phải tin tức k
                    $url=explode('-n-', $id);
                    if(isset($url[1])){
                        $url=explode('.', $url[1]);
                             $news=News_model::where('id',$url[0])->first();
                            if(count($news)){
                                // lấy danh mục 
                                $category=Category_news_model::find($news->id_category);
                                // // kiểm tra xem no có layout khác k 
                                $this->breadcrumb[]=['name'=>$category->name,'link'=>url($category->link)];
                                $this->breadcrumb[]=['name'=>$news->name,'link'=>$news->link.$category->id];
                                view()->share('breadcrumb', $this->breadcrumb);

                                 if($category->view_detail){
                                    $view="view.view.news.".$category[0]->view_detail;
                                    return view($view,['category'=>$category[0],'news'=>$news]);
                                 }
                                 else{
                                     return view("view.view.news.detail",['category'=>$category,'news'=>$news]);
                                 } 
                            }
                             else{

                                   $news_w=News_model::where('id',$url[0])->first();
                                   $w_site=Websites_model::find($news_w->id_site);
                                   if($w_site){
                                    $category=Category_news_model::find($news_w->id_category);
                                        // // kiểm tra xem no có layout khác k 
                                        $this->breadcrumb[]=['name'=>$category->name,'link'=>url($category->link)];
                                        $this->breadcrumb[]=['name'=>$news_w->name,'link'=>$news_w->link];
                                        if($category->view_detail){
                                            $view=$w_site->name.".view.news.".$category[0]->view_detail;

                                            return view($view,['category'=>$category[0],'news'=>$news]);
                                         }
                                         else{
                                             return view($w_site->name.".view.news.detail",['category'=>$category,'news'=>$news_w,'w'=>$w_site]);
                                         } 
                                   }
                            }
                    }
                break;
            
            case 'product':
                // Check là sản phẩm
                        $url=explode('-pd-', $id);

                        if(isset($url[1])){
                           
                             $url=explode('.', $url[1]);
                                $product=Product_model::where('id',$url[0])->first();
                                if($product){
                                    // lấy danh mục 
                                    $category=Category_product_model::where('id',$product->id_category)->first();
                                    // // kiểm tra xem no có layout khác k 
                                    $this->breadcrumb[]=['name'=>$category->name,'link'=>url($category->link).$category->id];
                                    $this->breadcrumb[]=['name'=>$product->name,'link'=>url($product->link).$product->id];
                                    view()->share('breadcrumb', $this->breadcrumb);
                                     if($category->view_detail){
                                        $view=$w->name.".view.product.".$category->view_detail;
                                        return view($view,['category'=>$category,'product'=>$product]);
                                     }
                                     else{
                                         return view("view.view.product.detail",['category'=>$category,'product'=>$product]);
                                     } 
                                }
                        }
                break;
            
            default:
                # code...
                break;
        }
         return redirect('/');
    }

    function url_page($site,$category,$id,Request $request){

        if($site){
             $w=Websites_model::where('name',trim($site))->first();
             if($w){
                $this->breadcrumb[0]=['name'=>'home','link'=>url('/')];
            switch ($category) {
                    case 'category':
                    // Kieerm tra co phai danh muc tin uc khong
                            $url=explode('-cn-', $id);
                                if(isset($url[1])){
                                    $url=explode('.', $url[1]);
                                    $wb=Website_model::where('id_site',$w->id)->first();
                                    $category=Category_news_model::where('id',$url[0])->first();
                                    $page=$wb->page_size;
                                    if($category){
                                             // lấy tin tức thuộc danh mục trên
                                    $news=News_model::where('id_site',$w->id)->where('id_category', $category->id)->paginate($page);
                                                // // kiểm tra xem no có layout khác k 
                                    $this->breadcrumb[]=['name'=>$category->name,'link'=>url($category->link)];
                                    view()->share('breadcrumb', $this->breadcrumb);
                                    foreach ($news as $key ) {
                                        $key->link=$w->name.$key->link;
                                    }
                                    if(view()->exists($category->view)){
                                        $view=$w->name.".view.news.".$category[0]->view;
                                        return view($view,['category'=>$category,'news'=>$news,'breadcrumb'=>$this->breadcrumb,'w'=>$w]);
                                    }
                                     else{
                                         return view($w->name.".view.news.category",['category'=>$category,'news'=>$news,'breadcrumb'=>$this->breadcrumb,'w'=>$w]);
                                    } 
                                }

                            }


                            // Kiem tra co phai danh muc san pham khong
                             $url=explode('-cp-', $id);
                                if(isset($url[1])){
                                    $wb=Website_model::where('id_site',$w->id)->first();
                                    $url=explode('.', $url[1]);
                                    $page=$wb->page_size;
                                    $sortmanufacturer='';
                                    $sort_name='location';
                                    $sort_by='desc';
                                    $price_min=0;
                                    $price_max=0;
                                    // Kiểm tra có pagesize k 
                                        if($request->pagesize){
                                           if((int)$request->pagesize!=0){
                                                $page=$request->pagesize;
                                           }
                                        }
                                        if($request->sortmanufacturer){
                                           if($request->sortmanufacturer){
                                                $sortmanufacturer=$request->sortmanufacturer;
                                           }
                                        }
                                         $category=Category_product_model::where('id_site',$w->id)->where('id',$url[0])->first();
                                        if(isset($request->price_min) && $request->price_max){
                                            $price_min=$request->price_min;
                                            $price_max=$request->price_max;
                                        }
                                        if($category){
                                            // lấy danh mục 
                                            // Thuc hien search 
                                             $product=$this->sort($page,$price_min,$price_max,$sort_name,$sort_by,$category->id);
                                            // // kiểm tra xem no có layout khác k 
                                            $this->breadcrumb[]=['name'=>$category->name,'link'=>url($category->link)];
                                            view()->share('breadcrumb', $this->breadcrumb);
                                            foreach ($product as $key ) {
                                                $key->link=$w->name.$key->link;
                                            }
                                             if($category->view_detail){
                                                $view=$w->name.".view.product.".$category->view_detail;
                                                return view($view,['category'=>$category,'product'=>$product]);
                                             }
                                             else{
                                                 return view($w->name.".view.product.category",['category'=>$category,'product'=>$product,'w'=>$w]);
                                             } 
                                        }
                                }
                    break;

                    case 'news':
                        // kiểm tra có phải tin tức k
                                $url=explode('-n-', $id);
                                if(isset($url[1])){
                                    $url=explode('.', $url[1]);
                                    $news_w=News_model::where('id',$url[0])->first();
                                    $w_site=Websites_model::find($news_w->id_site);
                                    if($w_site){

                                        $category=Category_news_model::find($news_w->id_category);
                                                        // // kiểm tra xem no có layout khác k 
                                        $this->breadcrumb[]=['name'=>$category->name,'link'=>url($category->link)];
                                        $this->breadcrumb[]=['name'=>$news_w->name,'link'=>$news_w->link];
                                        view()->share('breadcrumb', $this->breadcrumb);
                                        if($category->view_detail){
                                            $view=$w_site->name.".view.news.".$category[0]->view_detail;

                                            return view($view,['category'=>$category[0],'news'=>$news]);
                                        }
                                        else{
                                           return view($w_site->name.".view.news.detail",['category'=>$category,'news'=>$news_w,'w'=>$w_site]);

                                       }
                                   }
                               }
                    break;
                    
                    case 'product':
                                // Check là sản phẩm
                                        $url=explode('-pd-', $id);

                                        if(isset($url[1])){
                                           
                                             $url=explode('.', $url[1]);
                                                $product=Product_model::where('id_site',$w->id)->where('id',$url[0])->first();
                                                if($product){
                                                    // lấy danh mục 
                                                    $category=Category_product_model::where('id_site',$w->id)->where('id',$product->id_category)->first();
                                                    // // kiểm tra xem no có layout khác k 
                                                    $this->breadcrumb[]=['name'=>$category->name,'link'=>url($category->link).$category->id];
                                                    $this->breadcrumb[]=['name'=>$product->name,'link'=>url($product->link).$product->id];
                                                    view()->share('breadcrumb', $this->breadcrumb);
                                                     if($category->view_detail){
                                                        $view=$w->name.".view.product.".$category->view_detail;
                                                        return view($view,['category'=>$category,'product'=>$product]);
                                                     }
                                                     else{
                                                         return view($w->name.".view.product.detail",['category'=>$category,'product'=>$product,'w'=>$w]);
                                                     } 
                                                }
                                        }
                    break;
                    }
                 }
            }
        return redirect('/');
    }
}
