<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Model\Product_model;
use App\Http\Model\Websites_model;
use App\Http\Model\Cart_model;
use App\Http\Controllers\Admin\Mail;
class Cart_controller extends Controller
{

	function index(){
		$cart=session('cart');
		return view("cart.view",['cart'=>$cart]);
	}
	function add($id,$qty){
		$cart=session('cart');
		if((int)$id){
			$product=Product_model::where("id",$id)->first();
			if((int)$qty && $product)
			{
				if($cart){
					foreach($cart as $p){
						if($p->id==$id){
							$p->qty=$qty;
							$check=1;
						}
					}
				}
				
				if(!isset($check)){
					$product['qty']=$qty;
					$cart[]=$product;
				}
				session(['cart' => $cart]);
				
			}

		}
		return redirect('/cart');

	}
	function delete($id){
		$cart=session('cart');
		if((int)$id){
			$product=Product_model::where("id",$id)->first();
			if($product)
			{
				if(count($cart)>0){
					$i=0;
					foreach($cart as $p){
						$i++;
						if($p->id==$id){
							$check=$i;
						}
					}
				}
				
				if(isset($check)){
					unset($cart[$check-1]);
				}
				session(['cart' => $cart]);
				return view("cart.view",['cart'=>$cart]);
			}

		}
	}
	function update(Request $request){

		$cart=session('cart');
		$product=Product_model::where("id",$request->id)->first();
		if($product){
			foreach($cart as $p){
				if($p->id==$request->id){
					$p->qty=$request->qty;
				}
			}
			session(['cart' => $cart]);
			
		}
		return redirect('/cart');

	}
	function order(){
		$cart=session('cart');
		if(isset($cart) && count($cart)>0){

			return view("cart.view_2",['cart'=>$cart]);
		}
		return redirect('/cart');
	}
	function order_v2(Request $request){
		if($request->isMethod('post')){
			$product=session('cart');
			$data=array();
			if(isset($product) && count($product)>0){
				foreach ($product as $p) {
					$cart=new Cart_model;
					if($request->name_user){
						$cart->name_user=$request->name_user;
					}
					if($request->phone_user){
						$cart->phone_user=$request->phone_user;
					}
					if($request->address_user){
						$cart->address_user=$request->address_user;
					}
					if($request->note_user){
						$cart->note_user=$request->note_user;
					}
					if($request->address_user && $request->phone_user && $request->name_user){
						$cart->state=0;
						$cart->review=0;
						$cart->id_user=0;
						$cart->date_send=strtotime(date('d-m-Y'));
						$product=session('cart');
						$cart->id_product=$p->id;
						$cart->number=$p->qty;
						$products=Product_model::find($p->id);
						$name=$cart->name_user;
						$address=$cart->address_user;
						$products->number=$p->qty;
						$cart->save();
						$data[]=$products;

					}
				}
				\Mail::send('view.email.view',['data'=>$data,'user'=>$name,'address'=>$address],  function($message)
		        {
		         $message->to('thanhnv.k59cntt@gmail.com', 'Khách đặt hàng sản phẩm')->subject('Order product');
		        });
				session(['cart' => array()]);
				return redirect('/');
			}
			return redirect('/cart');
		}
		return redirect('/cart/order');
	}
	
}
