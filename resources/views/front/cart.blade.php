@extends('layouts.front')
@section('content')

<section class="inner_page_wrapper">
		<div class="shoppingcart_section cs_one">
			<div class="container">
           		<div class="security_bar">
           			<ul>
           				<li>
           					<img src="images/head-icon2.png" alt="">
							100% payment <br>protection
           				</li>
           				<li>
							<img src="images/head-icon3.png" alt="">
							 No Hidden <br>Charges
						</li>
						<li>
							<img src="images/head-icon1.png" alt="">
							Need Assistance <br>+91-900 800 7000
						</li>
           			</ul>
           		</div>
            	<div class="row">
					<div class="col-12">
					  @include('includes.form-success')
					</div>
                	<div class="col-8">
                    	<h3>Your are buying</h3>
                    	<div class="cart_outer">
                    		<div class="cart_header">
                    			<div class="head_one">
                    				Product
                    			</div>
                    			<div class="head_two">
                    				Quantity
                    			</div>
                    			<div class="head_three">
                    				Total
                    			</div>
                    		</div>
							@if(Session::has('cart'))
							@foreach($products as $product)
                    		<div class="cart_block cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values']) }}">							
                    			<div class="cart_product">
                    				<div class="img_block">
                    					<img alt="" src="{{ $product['item']['photo'] ? asset('assets/images/products/'.$product['item']['photo']):asset('assets/images/noimage.png') }}">
                    				</div>
                    				<h3><a href="{{ route('front.product', $product['item']['slug']) }}" class="head_link">{{mb_strlen($product['item']['name'],'utf-8') > 35 ? mb_substr($product['item']['name'],0,35,'utf-8').'...' : $product['item']['name']}}</a></h3>
									  @if(!empty($product['size']))
									<b>{{ $langg->lang312 }}</b>: {{ $product['item']['measure'] }}{{str_replace('-',' ',$product['size'])}} <br>
									@endif
									@if(!empty($product['color']))
									<div class="d-flex mt-2">
									<b>{{ $langg->lang313 }}</b>:  <span id="color-bar" style="border: 10px solid #{{$product['color'] == "" ? "white" : $product['color']}};"></span>
									</div>
									@endif

										@if(!empty($product['keys']))

										@foreach( array_combine(explode(',', $product['keys']), explode(',', $product['values']))  as $key => $value)

											<b>{{ ucwords(str_replace('_', ' ', $key))  }} : </b> {{ $value }} <br>
										@endforeach

										@endif
                    				<div class="qty_rate">
                    					<span class="rate">{{ App\Models\Product::convertPrice($product['item_price']) }}   </span> 
                    					<div class="number_wrap">
											<div class="number">
												<span class="minus"><i class="fa fa-minus"></i></span>
												<input type="text" value="1"/>
												<span class="plus"><i class="fa fa-plus"></i></span>
											</div>
										</div>
                    				</div>
                    			</div>
                    			<div class="cart_qty">
								<span class="rate">{{ App\Models\Product::convertPrice($product['item_price']) }}   </span> 
                    				<div class="number_wrap">
										 @if($product['item']['type'] == 'Physical')
										 <input type="hidden" class="prodid" value="{{$product['item']['id']}}">  
										  <input type="hidden" class="itemid" value="{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">     
										  <input type="hidden" class="size_qty" value="{{$product['size_qty']}}">     
										  <input type="hidden" class="size_price" value="{{$product['size_price']}}">   
											<div class="number">
												<span class="minus qtminus1 reducing"><i class="fa fa-minus"></i></span>
												<input  class="qttotal1" id="qty{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}" type="text" value="{{ $product['qty'] }}"/>
												<span class="plus qtplus1 adding"><i class="fa fa-plus"></i></span>
											</div>
										@endif
										 @if($product['size_qty'])
										<input type="hidden" id="stock{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}" value="{{$product['size_qty']}}">
										@elseif($product['item']['type'] != 'Physical') 
										<input type="hidden" id="stock{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}" value="1">
										@else
										<input type="hidden" id="stock{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}" value="{{$product['stock']}}">
										@endif
									</div>
                    			</div>
                    			<div class="cart_price" id="prc{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">
                    				  {{ App\Models\Product::convertPrice($product['price']) }} 
                    			</div>
                    			<div class="del_product">
                    				<a href="javascript::void(0)" class="removecart cart-remove" data-class="cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values']) }}" data-href="{{ route('product.cart.remove',$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])) }}"><i class="fa fa-trash-o"></i></a>
                    			</div>
                    		</div>
							
                    		@endforeach
							@endif
						
						</div>
                    </div>
					@if(Session::has('cart'))
				   <div class="col-4">
                    	<div class="review_order">
                      		<h3>Check out details</h3>	
                       		<div class="price_detail order-box">
                       			<ul class="price_list2 order-list">
                       				<li>Total MRP <span class="cart-total"> {{ Session::has('cart') ? App\Models\Product::convertPrice($totalPrice) : '0.00' }}</span></li>
                                   <li>Tax <span>{{$tx}}%</span></li>
                                    <li>Coupon <span class="discount">{{ App\Models\Product::convertPrice(0)}}</span><input type="hidden" id="d-val" value="{{ App\Models\Product::convertPrice(0)}}"></li>
                                    <li class="total-price">Total <span class="main-total"> {{ Session::has('cart') ? App\Models\Product::convertPrice($mainTotal) : '0.00' }}</span></li>
                       			</ul>
                       			<div class="coupon_detail cupon-box">
                       				<a href="javascript::void(0)" class="cc_link" id="coupon-link">Have a coupon code?</a>
                       				<div class="form-group">
									   <form id="coupon-form" class="coupon" style="display:none">
                       					<input type="text" class="form-control" placeholder="Enter your coupon code" id="code" required="" autocomplete="off">
										<input type="hidden" class="coupon-total" id="grandtotal" value="{{ Session::has('cart') ? App\Models\Product::convertPrice($mainTotal) : '0.00' }}">
                       					<button type="submit" class="btn">Apply Now</button>
									 </form>
                       				</div>
                       				<div class="after_apply" style="display:none">
                       					<h5>(FA10)</h5>
                       					<h6>Coupon code applied successfully <a href="#">Remove</a></h6>
                       				</div>
                       			</div>
                       		</div>
                        	<div class="all_price">
                            	<label> You pay</label>
                                <div>
								{{ Session::has('cart') ? App\Models\Product::convertPrice($mainTotal) : '0.00' }}
									<!--<span>
										MRP: <i class="fa fa-rupee"></i> <span class="text-linethrough">999.00</span> | You save <i class="fa fa-rupee"></i> 466.00
									</span>-->
								</div>
                            </div>
                        	<ul class="btns">
                        		<li>
                        			<a href="{{ route('front.checkout') }}" class="btn">Proceed to checkout</a>
                        		</li>
                        		<li>
                        			<a href="{{ route('front.index') }}" class="btn cont_btn">Continue Shopping</a>
                        		</li>
                        	</ul>
                    		
                    </div>
					@endif
                    </div>
                
				</div>
    		</div>
		</div>
	</section>

@endsection 