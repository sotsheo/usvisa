<?php

// admin
Route::group(['namespace' => 'admin','prefix' => 'admin'],function(){
    Route::get("/",array('as' => 'index', 'uses' => 'Login_controller@index'))->middleware("checklogins");
    Route::post('/login', array('as' => 'login', 'uses' => 'Login_controller@login'));
    Route::post('/login', array('as' => 'login', 'uses' => 'Login_controller@login'));
    Route::get("/register", 'Login_controller@register')->middleware("checklogins");
    Route::post('/registers', array('as' => 'register', 'uses' => 'Login_controller@registers'));
    Route::get('/logout', array('as' => 'logout', 'uses' => 'Login_controller@logout'));
    

    // setting website
    Route::group(['prefix' => 'setting'],function(){
        Route::get("/",array('as' => 'setting', 'uses' => 'Setting_controller@index'))->middleware("checklogins");
        Route::post('/edit', array('as' => 'edit_setting', 'uses' => 'Setting_controller@edit'))->middleware("checklogins");

    });
  // support
    Route::group(['prefix' => 'support'],function(){
        Route::get("/","Support_controller@index")->middleware("checklogins");
        Route::post('/edit_support', array('as' => 'edit_support', 'uses' => 'Support_controller@edit_support'))->middleware("checklogins");

        Route::get('/delete/{id}', 'Support_controller@delete')->middleware("checklogins");
    });
    

    // news
    Route::group(['prefix' => 'news'],function(){
        Route::get("/", 'News_controller@index')->middleware("checklogins");
        Route::post("/search",array('as' => 'news', 'uses' => 'News_controller@search'))->middleware("checklogins");
          // Add 
        Route::get("/create","News_controller@create")->middleware("checklogins")->middleware("checklogins");
        Route::post('/create_news', array('as' => 'create_news', 'uses' => 'News_controller@create_news'))->middleware("checklogins");
        //  Edit
        Route::get("/edit/{id}","News_controller@edit")->middleware("checklogins");
        Route::post('/edit_news', array('as' => 'edit_news', 'uses' => 'News_controller@edit_news'))->middleware("checklogins");
         // Delete
        Route::get("/delete/{id}","News_controller@delete")->middleware("checklogins");
        
    });
    // catgory_ news
    Route::group(['prefix' => 'category_news'],function(){
        Route::get("/","Category_news_controller@index")->middleware("checklogins");
        // Add 
        Route::get("/create","Category_news_controller@create")->middleware("checklogins")->middleware("checklogins");
        Route::post('/create_news', array('as' => 'create_category_news', 'uses' => 'Category_news_controller@create_news'))->middleware("checklogins");
        //  Edit
        Route::get("/edit/{id}","Category_news_controller@edit")->middleware("checklogins");
        Route::post("/edit_news",array('as' => 'edit_category_news', 'uses' => 'Category_news_controller@edit_news'))->middleware("checklogins");
        // Delete
        Route::get("/delete/{id}","Category_news_controller@delete")->middleware("checklogins");
        Route::post('/get_news_category', array('as' => 'get_news_category', 'uses' => 'Category_news_controller@get_news_category'))->middleware("checklogins");

    });
    // catgory_banner
    Route::group(['prefix' => 'category_banner'],function(){
        Route::get("/","Category_banner_controller@index")->middleware("checklogins")->middleware("checklogins");
        // Add
        Route::get("/create","Category_banner_controller@create")->middleware("checklogins")->middleware("checklogins");
        Route::post('/create_cat_banner', array('as' => 'create_category_banner', 'uses' => 'Category_banner_controller@create_cat'))->middleware("checklogins");
        //  Edit
        Route::get("/edit/{id}","Category_banner_controller@edit")->middleware("checklogins")->middleware("checklogins");
        Route::post("/edit_cat_banner",array('as' => 'edit_category_banner', 'uses' => 'Category_banner_controller@edit_cat'))->middleware("checklogins");
        // Delete
        Route::get("/delete/{id}","Category_banner_controller@delete")->middleware("checklogins");
        Route::post("/get_category_banner",array('as' => 'get_category_banner', 'uses' => 'Category_banner_controller@get_category_banner'));
    });

    // banner
    Route::group(['prefix' => 'banner'],function(){
        Route::get("/","Banner_controller@index")->middleware("checklogins");
        // Add
        Route::get("/create","Banner_controller@create")->middleware("checklogins")->middleware("checklogins");
        Route::post('/create_banner', array('as' => 'create_banner', 'uses' => 'Banner_controller@create_banner'))->middleware("checklogins");
        //  Edit
        Route::get("/edit/{id}","Banner_controller@edit")->middleware("checklogins");
        Route::post("/edit_banner",array('as' => 'edit_banner', 'uses' => 'Banner_controller@edit_banner'))->middleware("checklogins");
        // Delete
        Route::get("/delete/{id}","Banner_controller@delete")->middleware("checklogins");
    });
    
    // menu
    Route::group(['prefix' => 'menu'],function(){
        Route::get("/","Menu_controller@index");

        Route::get("/menu_create_category","Menu_controller@menu_create_category")->middleware("checklogins");
        Route::post('/menu_category', array('as' => 'create_category_menu', 'uses' => 'Menu_controller@create_category_menu'))->middleware("checklogins");

        // Insert menu item
        Route::get("/create_id/{id}","Menu_controller@create_menu_id");
        Route::post('/create_menu_id_cr', array('as' => 'create_menu_id_cr', 'uses' => 'Menu_controller@create_menu_id_cr'))->middleware("checklogins");


        // Edit menu
        Route::get("/edit_menu/{id}","Menu_controller@edit_menu");
        Route::post('/edit_menu_p', array('as' => 'edit_menu_p', 'uses' => 'Menu_controller@edit_menu_p'))->middleware("checklogins");

        // Delete menu
        Route::get("/delete_menu/{id}","Menu_controller@delete_menu")->middleware("checklogins");
         // delete menu category
        Route::get("/delete_category/{id}","Menu_controller@delete_category")->middleware("checklogins");
        Route::get("/edit_category/{id}","Menu_controller@edit_category")->middleware("checklogins");
        Route::post('/edit_category_p', array('as' => 'edit_category_p', 'uses' => 'Menu_controller@edit_category_p'))->middleware("checklogins");
        
        Route::post('/menu_get', array('as' => 'menu_get', 'uses' => 'Menu_controller@menu_get'))->middleware("checklogins");

    });

   // Sản phẩm
    Route::group(['prefix' => 'category_product'],function(){
        Route::get("/","Category_product_controller@index")->middleware("checklogins");

        // create category_product
        Route::get("/create","Category_product_controller@create")->middleware("checklogins");
        Route::post('/create_catgory_product', array('as' => 'create_catgory_product', 'uses' => 'Category_product_controller@create_catgory_product'))->middleware("checklogins");

        // edit category_product
        Route::get("/edit/{id}","Category_product_controller@edit")->middleware("checklogins");
        Route::post('/edit_catgory_product', array('as' => 'edit_catgory_product', 'uses' => 'Category_product_controller@edit_catgory_product'))->middleware("checklogins");

        Route::get("/delete/{id}","Category_product_controller@delete")->middleware("checklogins");

        Route::post('/get_product_category', array('as' => 'get_product_category', 'uses' => 'Category_product_controller@get_product_category'))->middleware("checklogins");
        

    });

    // product
    Route::group(['prefix' => 'product'],function(){
        Route::get("/","Product_controller@index")->middleware("checklogins");

        Route::post('/search', array('as' => 'product', 'uses' => 'Product_controller@product'))->middleware("checklogins");
        Route::get("/create","Product_controller@create")->middleware("checklogins");
        Route::post('/create_product', array('as' => 'create_product', 'uses' => 'Product_controller@create_product'))->middleware("checklogins");

        Route::get("/edit/{id}","Product_controller@edit")->middleware("checklogins");
        Route::post('/edit_product', array('as' => 'edit_product', 'uses' => 'Product_controller@edit_product'))->middleware("checklogins");

        Route::get("/delete/{id}","Product_controller@delete")->middleware("checklogins");
        
    });

    
     // support
    Route::group(['prefix' => 'support'],function(){
        Route::get("/","Support_controller@index")->middleware("checklogins");
        Route::post('/edit_support', array('as' => 'edit_support', 'uses' => 'Support_controller@edit_support'))->middleware("checklogins");

        Route::get('/delete/{id}', 'Support_controller@delete')->middleware("checklogins");
    });

    // widget
    Route::group(['prefix' => 'html'],function(){
        Route::get("/","Html_controller@index")->middleware("checklogins");

        Route::get("/create","Html_controller@create")->middleware("checklogins");
        Route::post('/create_html', array('as' => 'create_html', 'uses' => 'Html_controller@create_html'))->middleware("checklogins");

        Route::get("/edit/{id}","Html_controller@edit")->middleware("checklogins");
        Route::post('/edit_html', array('as' => 'edit_html', 'uses' => 'Html_controller@edit_html'))->middleware("checklogins");
        Route::post('/get_html', array('as' => 'get_html', 'uses' => 'Html_controller@get_html'))->middleware("checklogins");
        Route::get("/delete/{id}","Html_controller@delete");
    });

     // newsletter
    Route::group(['prefix' => 'newsletter'],function(){
        Route::get("/","Newsletter_controller@index")->middleware("checklogins");
        Route::post('/create_newsletter', array('as' => 'create_newsletter', 'uses' => 'Newsletter_controller@create_newsletter'));
        Route::get("/delete/{id}","Newsletter_controller@delete")->middleware("checklogins");
    });

    
     // pagecontent
    Route::group(['prefix' => 'pagecontent'],function(){
        Route::get("/","PageContent_controller@index")->middleware("checklogins");
        Route::get("/create","PageContent_controller@create")->middleware("checklogins");
        Route::post('/create_page/', array('as' => 'create_page', 'uses' => 'PageContent_controller@create_page'))->middleware("checklogins");
        Route::post('/edit_page/', array('as' => 'edit_page', 'uses' => 'PageContent_controller@edit_page'))->middleware("checklogins");
        Route::get("/edit/{id}","PageContent_controller@edit")->middleware("checklogins");
        Route::get("/delete/{id}","PageContent_controller@delete")->middleware("checklogins");
        Route::post('/get_page_content/', array('as' => 'get_page_content', 'uses' => 'PageContent_controller@get_page_content'))->middleware("checklogins");
        
    });
    
    Route::group(['prefix' => 'introduce'],function(){
        Route::get("/","Introduce_controller@index")->middleware("checklogins");
        Route::post('/edit_introduce/', array('as' => 'edit_introduce', 'uses' => 'Introduce_controller@edit_introduce'))->middleware("checklogins");
        
    });

     // widget
    Route::group(['prefix' => 'widget'],function(){
        Route::get("/","Widget_controller@index")->middleware("checklogins");

        Route::get("/create","Widget_controller@create")->middleware("checklogins");
        Route::post('/create_widget', array('as' => 'create_widget', 'uses' => 'Widget_controller@create_widget'))->middleware("checklogins");

        Route::get("/edit/{id}","Widget_controller@edit")->middleware("checklogins");
        Route::post('/edit_widget', array('as' => 'edit_widget', 'uses' => 'Widget_controller@edit_widget'))->middleware("checklogins");

        Route::get("/delete/{id}","Widget_controller@delete");
        Route::post('/getDataWidget', array('as' => 'getDataWidget', 'uses' => 'WidgetAdmin_controller@getDataWidget'))->middleware("checklogins");
         
    });
     // manufacturer
    Route::group(['prefix' => 'manufacturer'],function(){
        Route::get("/","Manufacturer_controller@index")->middleware("checklogins");

        Route::get("/create","Manufacturer_controller@create")->middleware("checklogins");
        Route::post('/create_manufacturer', array('as' => 'create_manufacturer', 'uses' => 'Manufacturer_controller@create_manufacturer'))->middleware("checklogins");

        Route::get("/edit/{id}","Manufacturer_controller@edit")->middleware("checklogins");
        Route::post('/edit_manufacturer', array('as' => 'edit_manufacturer', 'uses' => 'Manufacturer_controller@edit_manufacturer'))->middleware("checklogins");

        Route::get("/delete/{id}","Manufacturer_controller@delete")->middleware("checklogins");
    });
});


// Front end
// giỏ hàng
Route::get("/cart/",'Cart_controller@index');
Route::get("/cart/add/{id}/{qty}",'Cart_controller@add');
Route::get("/cart/delete/{id}",'Cart_controller@delete');
Route::get("/cart/order",'Cart_controller@order');
Route::get("/cart/update/{id}/{qty}",'Cart_controller@update');
Route::post('/order_v2/', array('as' => 'order_v2', 'uses' => 'Cart_controller@order_v2'));

Route::get("/",'Home_controller@index');









