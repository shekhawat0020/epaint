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
								
								@if($product['item']->type == 'Gift Card')

									<div class="cart_block cremove{{ $product['item']->id }}">							
									<div class="cart_product">
										<div class="img_block">
											<img alt="" src="{{ $product['item']->photo ? $product['item']->photo :asset('assets/images/noimage.png') }}">
										</div>
										<h3>{{mb_strlen($product['item']->name,'utf-8') > 35 ? mb_substr($product['item']->name,0,35,'utf-8').'...' : $product['item']->name}}</h3>
									
										
									</div>
									<div class="cart_qty">
									<span class="rate">{{ App\Models\Product::convertPrice($product['item_price']) }}   </span> 
										<div class="number_wrap">
										<input type="hidden" id="stock{{$product['item']->id}}" value="1">
										</div>
									</div>
									<div class="cart_price" id="prc{{$product['item']->id}}">
										{{ App\Models\Product::convertPrice($product['price']) }} 
									</div>
									<div class="del_product">
										<a href="javascript::void(0)" class="removecart cart-remove" data-class="cremove{{ $product['item']->id }}" data-href="{{ route('product.cart.remove',$product['item']->id) }}"><i class="fa fa-trash-o"></i></a>
									</div>
								</div>

								@else
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
							@endif
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
                                   <li>GST <span>{{$tx}}%</span></li>
                                    <li>Coupon<a href="#coupon" data-bs-toggle="modal" class="edit">edit</a> <span class="discount">{{ App\Models\Product::convertPrice(0)}}</span><input type="hidden" id="d-val" value="{{ App\Models\Product::convertPrice(0)}}"></li>
                                    <li class="total-price">Total <span class="main-total"> {{ Session::has('cart') ? App\Models\Product::convertPrice($mainTotal) : '0.00' }}</span></li>
                       			</ul>
                       			<div class="coupon_detail cupon-box">
                       				
                       				<div class="after_apply" style="display:none">
                       					<h5 id="applied_coupan"></h5>
                       					<h6>Coupon code applied successfully <a href="javasctip::void(0)" class="remove-coupon">Remove</a></h6>
                       				</div>
                       			</div>
                       		</div>
                        	<div class="all_price">
                            	<label> You pay</label>
                                <div class="main-total">
								{{ Session::has('cart') ? App\Models\Product::convertPrice($mainTotal) : '0.00' }}
									
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


	<div class="modal fade login_modal" id="coupon" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			<div class="modal-body">
				<ul class="coupon_list">
					@if(isset($coupans))
					
						@foreach($coupans as $coupan)
						<li>
							<span class="coupon_name">{{$coupan->code}}</span>

							<p>Get Discount @if($coupan->type) {{ Session::has('currency') ?   DB::table('currencies')->where('id','=',Session::get('currency'))->first()->sign   : DB::table('currencies')->where('is_default','=',1)->first()->sign }} {{$coupan->price}} @else {{$coupan->price}} % @endif</p>
							<button data-code="{{$coupan->code}}" type="button" class="btn applycoupan">Apply</button>
							
						</li>
						@endforeach
					@else
					<h3>No Coupans Found</h3>
					@endif
				</ul>
				<form id="coupon-form" class="coupon" style="display:none">
					<input type="text" class="form-control" placeholder="Enter your coupon code" id="code" required="" autocomplete="off">
					<input type="hidden" class="coupon-total" id="grandtotal" value="{{ Session::has('cart') ? App\Models\Product::convertPrice($mainTotal) : '0.00' }}">
					
				</form>
			</div>
		</div>
	</div>
</div>	

@endsection 

@section('scripts')

<script type="text/javascript">
$('.applycoupan').click(function(){
	code = $(this).data('code');
	$('#code').val(code);
	$('#coupon-form').submit();

});

$('.remove-coupon').click(function(){
	$.ajax({url: "{{route('remove-coupon')}}", success: function(result){
    	if(result.status){
			$('.main-total').text(result.mainTotal);
			$('.after_apply').hide();
			$('#applied_coupan').text('');
			$('.discount').text(result.discount);
		}
  }});
});

</script>
@endsection 