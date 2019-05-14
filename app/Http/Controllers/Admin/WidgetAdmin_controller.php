<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Admin\Category_news_controller;
use App\Http\Controllers\Admin\Menu_controller;
use App\Http\Controllers\Admin\Html_controller;
use App\Http\Controllers\Admin\PageContent_controller;
class WidgetAdmin_controller extends Controller
{

	function getDataWidget(Request $request){
		if($request->isMethod('post')){
			if($request->type){
				switch ($request->type) {
					case 'categorynewsishome':
						$data=Category_news_controller::get_category();
					break;
					case 'menu':
						$data=Menu_controller::menu_get();
						break;
					case 'html':
						$data=Html_controller::get_html();
						break;
					case 'banner':
						$data=Category_banner_controller::get_category_banner();
						break;
					case 'pagecontent':
						$data=PageContent_controller::get_page_content();
						break;
						
					default:
					break;
				}
				return view("admin.home.widget.view",["data"=>$data]);
			}
		}
	}

}
