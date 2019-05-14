<?php


namespace App\Http\Controllers\Widget;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use App\Http\Model\Category_menu_model;
use App\Http\Model\Category_news_model;
use App\Http\Model\Category_product_model;
use App\Http\Model\Widget_model;
use App\Http\Model\Type_widget_model;
use App\Http\Model\Menu_model;
use App\Http\Model\News_model;
use App\Http\Model\Product_model;
use App\Http\Model\Support_model;
use App\Http\Model\Type_support_model;
use App\Http\Model\Banner_model;
use App\Http\Model\Category_banner_model;
use App\Http\Model\Manufacturer_model;
use App\Http\Model\Html_model;
use App\Http\Model\PageContent_model;
use App\Http\Model\Website_model;
use App\Http\Controllers\Admin\Category_news_controller;

class AllWidgetController extends Controller
{

    public static function  getDataWidget($view,$number_type){
        $view_v='view.modules.';
        $widget=Widget_model::where('number_type',$number_type)->first();
        if($widget){
            switch ($widget->type){
                case 'menu':
                    $view_v.='menu.';
                    if(view()->exists($view_v.$view)){
                        $view_v=$view_v.$view;
                    }
                    $data=Menu_model::where('id_category',$widget->id_category)->get();
                    return view($view_v,["widget"=>$widget,'data'=>$data]);
                    break;
                case 'banner':
                    $view_v.='banner.';
                    if(view()->exists($view_v.$view)){
                        $view_v=$view_v.$view;
                    }
                    $data=Banner_model::where('id_category',$widget->id_category)->limit($widget->limit)->get();
                    return view($view_v,["widget"=>$widget,'banner'=>$data]);
                    break;

                case 'pagecontent':
                    $view_v.='pagecontent.';
                    if(view()->exists($view_v.$view)){
                        $view_v=$view_v.$view;
                    }
                    $data=PageContent_model::find($widget->id_category) ;
                    return view($view_v,["widget"=>$widget,'news'=>$data]);

                case 'html':
                    $view_v.='html.';
                    if(view()->exists($view_v.$view)){
                        $view_v=$view_v.$view;
                    }
                    $data=Html_model::find($widget->id_category) ;
                    return view($view_v,["widget"=>$widget,'html'=>$data]);
                case 'categorynewsishome':
                    $view_v.='categorynewsishome.';
                    if(view()->exists($view_v.$view)){
                        $view_v=$view_v.$view;
                    }
                    $data=Category_news_controller::categoryishome($widget->limit_category,$widget->limit);
                    return view($view_v,["widget"=>$widget,'category'=>$data]);
                    break;
            }
        }

    }

}
