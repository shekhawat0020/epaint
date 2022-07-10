@extends('layouts.front')

@section('styles')
<style>
.checkboxdiv{
	margin-bottom: 10px;
}
.checkboxdiv input{
	float: left;
}
.checkboxdiv label{
	float: left;
    margin-left: 8px;
    margin-top: -4px;
}
.editsecond{
	display:none;
}
.step_four .billing-info-area  p, .step_four .payment-information p {
	font-size: 16px;
    color: #444;
    padding-top: 10px;
}
.billing-info-area {
    margin-bottom: 21px;
}

.payment-information .nav a {
    padding: 6px 0px 0px 30px;
    position: relative;
}

.payment-information .nav a .icon {
    position: absolute;
    left: 0px;
    margin-top: 1px;
}
.payment-information .nav a span {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    display: inline-block;
    position: relative;
    border: 1px solid rgba(0, 0, 0, 0.20);
}
.payment-information .nav a span::after {
    background: #0f78f2;
}

.payment-information .nav a span::after {
    position: absolute;
    content: "";
    width: 0%;
    height: 0%;
    border-radius: 50%;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #ff5500;
    -webkit-transition: all 0.3s ease-in;
    -o-transition: all 0.3s ease-in;
    transition: all 0.3s ease-in;
}

.payment-information .nav a.active span:after {
    width: 80%;
    height: 80%;
}
.payment-information .nav a p {
    display: inline-block;
    margin-bottom: 0px;
    position: relative;
    top: -5px;
    left: 5px;
    font-weight: 600;
}
.payment-information .nav a p small {
    display: block;
}

.radio-design {
    display: block;
    position: relative;
    padding-left: 0px;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    margin-bottom: 7px;
}
.radio-design input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    z-index: 9;
    width: 100%;
    height: 100%;
}
.radio-design label {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 0px;
    position: relative;
    top: -4px;
    left: 35px;
	display: inline-block;
}
.radio-design .checkmark {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    display: inline-block;
    position: absolute;
    border: 1px solid rgba(0, 0, 0, 0.20);
    top: -2px;
}
.radio-design input:checked ~ .checkmark::after {
    width: 80%;
    height: 80%;
}
.radio-design .checkmark::after {
    background: #0f78f2;
}
.radio-design .checkmark::after {
    position: absolute;
    content: "";
    width: 0%;
    height: 0%;
    border-radius: 50%;
    top: 50%;
    left: 50%;
    z-index: 99;
    transform: translate(-50%, -50%);
    background: #ff5500;
    -webkit-transition: all 0.3s ease-in;
    -o-transition: all 0.3s ease-in;
    transition: all 0.3s ease-in;
}
.packeging-area .title {
    font-size: 16px;
    font-weight: 700;
    text-transform: uppercase;
    color: #143250;
    line-height: 28px;
    margin-bottom: 15px;
	margin-top: 15px;
}
.radio-design label small {
    display: block;
}

</style>
@endsection

@section('content')

<section class="inner_page_wrapper">
		<div class="shoppingcart_section checkout_section">
			<div class="container">
			<form id="" action="" method="POST" class="checkoutform">
				
			@include('includes.form-success')
			@include('includes.form-error')

			{{ csrf_field() }}
           		<div class="checkout_wrap">
					<div class="step_block step_one active">
						<div class="value_block">
							<div class="heading">
								<h4>
									<div class="icon">
										<i class="fa fa-address-card-o"></i>	
										<span class="complete_sign"><i class="fa fa-address"></i></span>
									</div>
									Address Details <span class="br">Step 1/3</span>
								</h4>
							</div>
							<div class="inner">
								<!--<h3>Personal Information</h3>-->
								<div class="row">
									<div class="col-8 fb_login_left">
										<div class="personal-info">
											<h5 class="title">
												Personal Information
											</h5>
											<hr/>
											<div class="row">
												<div class="form-group col-lg-6">
													<input type="text" id="personal-name" class="form-control" name="personal_name" placeholder="{{ $langg->lang747 }}" value="{{ Auth::check() ? Auth::user()->name : '' }}" {!! Auth::check() ? 'readonly' : '' !!}>
												</div>
												<div class="form-group col-lg-6">
													<input type="email" id="personal-email" class="form-control" name="personal_email" placeholder="{{ $langg->lang748 }}" value="{{ Auth::check() ? Auth::user()->email : '' }}"  {!! Auth::check() ? 'readonly' : '' !!}>
												</div>
											</div>
											@if(!Auth::check())
											<div class="row">
												<div class="col-lg-12 mt-3 checkboxdiv">
														<input class="styled-checkbox" id="open-pass" type="checkbox" value="1" name="pass_check">
														<label for="open-pass">Create an account ?</label>
												</div>
											</div>
											<div class="row set-account-pass d-none">
												<div class="form-group col-lg-6">
													<input type="password" name="personal_pass" id="personal-pass" class="form-control" placeholder="{{ $langg->lang750 }}">
												</div>
												<div class="form-group col-lg-6">
													<input type="password" name="personal_confirm" id="personal-pass-confirm" class="form-control" placeholder="{{ $langg->lang751 }}">
												</div>
											</div>
											@endif
										</div>
										<div class="billing-address">
											<h5 class="title">
												{{ $langg->lang147 }}
											</h5>
											<hr/>
											<div class="row">
												<div class="form-group d-none col-lg-6 {{ $digital == 1 ? 'd-none' : '' }}">
													<select class="form-control" id="shipop" name="shipping" required="">
														<option value="shipto">{{ $langg->lang149 }}</option>
													{{--	<option value="pickup">{{ $langg->lang150 }}</option>--}}
													</select>
												</div>
		
												<div class="form-group col-lg-6 d-none" id="shipshow">
													<select class="form-control nice" name="pickup_location">
														@foreach($pickups as $pickup)
														<option value="{{$pickup->location}}">{{$pickup->location}}</option>
														@endforeach
													</select>
												</div>
		
												<div class="form-group col-lg-6">
													<input class="form-control" type="text" id="u_name" name="name"
														placeholder="{{ $langg->lang152 }}" required=""
														value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->name : '' }}">
												</div>
												<div class="form-group col-lg-6">
													<input class="form-control" type="text" id="u_phone" name="phone"
														placeholder="{{ $langg->lang153 }}" required=""
														value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->phone : '' }}">
												</div>
												<div class="form-group col-lg-6">
													<input class="form-control" type="text" id="u_email"  name="email"
														placeholder="{{ $langg->lang154 }}" required=""
														value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->email : '' }}">
												</div>
												<div class="form-group col-lg-6">
													<input class="form-control" type="text" id="u_address" name="address"
														placeholder="{{ $langg->lang155 }}" required=""
														value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->address : '' }}">
												</div>
												<div class="form-group col-lg-6">
													<select class="form-control" id="u_country" name="customer_country" required="">
														@include('includes.countries')
													</select>
												</div>
												<div class="form-group col-lg-6">
												
													<select class="form-control" id="u_state" name="customer_state" required="">
													<option value="">Select State</option>
													</select>	
												</div>
												<div class="form-group col-lg-6">
													<select class="form-control" id="u_city" name="city" required="">
														<option value="">Select City</option>
													</select>
												</div>
												<div class="form-group col-lg-6">
													<input class="form-control" type="text" id="u_zip" name="zip"
														placeholder="{{ $langg->lang159 }}" required=""
														value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->zip : '' }}">
												</div>
											</div>
										</div>

										<div class="row {{ $digital == 1 ? 'd-none' : '' }}">
											<div class="col-lg-12 mt-3 checkboxdiv">
													<input class="styled-checkbox" id="ship-diff-address" type="checkbox" value="value1" >
													<label for="ship-diff-address">{{ $langg->lang160 }}</label>
											</div>
										</div>
										<div class="ship-diff-addres-area d-none">
												<h5 class="title">
														{{ $langg->lang752 }}
												</h5>
												<hr/>
											<div class="row">
												<div class="form-group col-lg-6">
													<input class="form-control ship_input" type="text" name="shipping_name"
														id="shippingFull_name" placeholder="{{ $langg->lang152 }}">
														<input type="hidden" name="shipping_email" value="">
												</div>
												<div class="form-group col-lg-6">
													<input class="form-control ship_input" type="text" name="shipping_phone"
														id="shipingPhone_number" placeholder="{{ $langg->lang153 }}">
												</div>
											</div>
											<div class="row">
												<div class="form-group col-lg-6">
													<input class="form-control ship_input" type="text" name="shipping_address"
														id="shipping_address" placeholder="{{ $langg->lang155 }}">
												</div>

												<div class="form-group col-lg-6">
													<select class="form-control ship_input" name="shipping_country" id="shipping_country">
														@include('includes.countries')
													</select>
												</div>
											</div>
											<div class="row">
												<div class="form-group col-lg-6">
													<select class="form-control" id="shipping_state" name="shipping_state">
													<option value="">Select State</option>
													</select>
												</div>
												<div class="form-group col-lg-6">
														<select class="form-control ship_input" id="shipping_city" name="shipping_city">
														<option value="">Select City</option>
														</select>
												</div>
												

											</div>
											<div class="row">
											<div class="form-group col-lg-6">
													<input class="form-control ship_input" type="text" name="shipping_zip"
														id="shippingPostal_code" placeholder="{{ $langg->lang159 }}">
												</div>
											</div>

										</div>
										<div class="order-note mt-3">
											<div class="row">
												<div class="form-group col-lg-12">
												<input type="text" id="Order_Note" class="form-control" name="order_notes" placeholder="{{ $langg->lang217 }} ({{ $langg->lang218 }})">
												</div>
											</div>
										</div>

										<div class="form-group">
											<button type="submit" class="btn mybtn1 checkout-step1">Continue</button>
										</div>
											
										
									</div>
									<div class="col-4">
									@if(!Auth::check())
										<div class="fb_login">
											<span class="or">OR</span>
											<h5>Login With</h5>
											<ul class="fb_list">
												<li><a href="#"><i class="fa fa-google"></i>Login with Google</a></li>
												<li><a href="#"><i class="fa fa-facebook"></i>Login with Facebook</a></li>
											</ul>
										</div>
									@else
										<div class="col-12">

										@foreach($address_list as $add)
											<div class="address_block">
												<div class="add_inner">
													<p>{{$add->name}}</p>
													<p>{{$add->address}}, {{$add->city}} , {{$add->state}}, {{$add->country}}, {{$add->zip}}   </p>
													<div class="float-left">
														<p>{{$add->phone}} </p>
														<a href="javascript::void(0)" class="btn deliver_this"  data-zip="{{$add->zip}}" data-id="{{$add->id}}" data-name="{{$add->name}}" data-phone="{{$add->phone}}"  data-address="{{$add->address}}" data-city="{{$add->city}}" data-country="{{$add->country}}" data-state="{{$add->state}}">Deliver Here</a>
													</div>
													<ul class="edit_list">
														<li><a href="{{route('user-dashboard')}}"><i class="fa fa-edit"></i></a></li>
														
													</ul>
												</div>
											</div>
										@endforeach

										</div>
									@endif





									</div>
								</div>
							</div>
							
						</div>
						<div class="edit_block">
							<ul class="step_list step_one_list">
								<li>
									<h4>
										<div class="icon">
											<i class="fa fa-address-card-o"></i>	
											<span class="complete_sign"><i class="fa fa-check"></i></span>
										</div>
										Address Details <span class="br">Step 1/3</span>
									</h4>
								</li>
								<li>
									<ul>
										<li><span>Name:</span> <div class="d_name"> </div></li>
										<li><span>Mobile:</span> <div class="d_phone">  </div></li>
										<li><span>Email:</span>  <div class="d_email"></div></li>
									</ul>
								</li>
								<li><a href="javascript::void(0)" class="edit_step_block"><i class="fa fa-pencil"></i></a></li>
							</ul>
						</div>
					</div>
					
					
					<div class="step_block step_two complete">
						<div class="value_block">
							<div class="heading">
								<h4>
									<div class="icon">
										<i class="fa fa-map-signs"></i>	
										<span class="complete_sign"><i class="fa fa-check"></i></span>
									</div>
									Order Summary <span class="br">Step 2/3</span>
								</h4>
							</div>
							<div class="inner">
								<h3>Order Summary</h3>
								<div class="row">
									<div class="col-12">
									@foreach($products as $product)
									@php   $product['item'] =  ($product['item']->type == 'Gift Card')?(array)$product['item']:$product['item'];  @endphp
										<div class="cart_outer">
											<div class="cart_block">
												<div class="cart_product">
													<div class="img_block">
														@if($product['item']['type'] == 'Gift Card')
														<img alt="" src="{{$product['item']['photo']}}">
														@else
														<img alt="" src="{{ asset('assets/images/products/'.$product['item']['photo']) }}">
														@endif
													</div>
													@if($product['item']['type'] == 'Gift Card')
														<h5>{{ $product['item']['name'] }}</h5>
														@else
														<h5><a href="{{ route('front.product', $product['item']['slug']) }}" class="head_link">{{ $product['item']['name'] }}</a></h5>
														@endif
													
													<h5><span>Price -</span> {{ App\Models\Product::convertPrice($product['item_price']) }}</h5>
													@if($product['item']['type'] != 'Gift Card')
															@if(!empty($product['size']))
															<h5><span>{{ $langg->lang312 }} -</span> {{ str_replace('-',' ',$product['size']) }}</h5>
															@endif
															@if(!empty($product['color']))
															<h5><span>{{ $langg->lang313 }} -</span> <span id="color-bar" style="border: 10px solid {{$product['color'] == "" ? "white" : '#'.$product['color']}}; position: absolute; margin-left: 5px;"></span></h5>
															@endif
															@if(!empty($product['keys']))

															@foreach( array_combine(explode(',', $product['keys']), explode(',', $product['values']))  as $key => $value)
															<h5><span>{{ ucwords(str_replace('_', ' ', $key))  }} -</span> {{ $value }}</h5>
															
															@endforeach

															@endif
													@endif
													<h5><span>Qty -</span> {{ $product['qty'] }}</h5>
													<h5>{{ App\Models\Product::convertPrice($product['price']) }}</h5>
												</div>
											</div>
										</div>
									@endforeach

									<a href="javascript:;" id="step3-btn"  class="mybtn1 btn">Continue</a>
										
									</div>
								</div>
								
							</div>
						</div>
						<div class="edit_block">
							<ul class="step_list">
								<li>
									<h4>
										<div class="icon">
											<i class="fa fa-map-signs"></i>	
											<span class="complete_sign"><i class="fa fa-check"></i></span>
										</div>
										Order Summary <span class="br">Step 2/3</span>
									</h4>
								</li>
								<li>
									<ul>
										<li><span></span> </li>
										<li><span></span> </li>
										<li><span></span></li>
									</ul>
								</li>
								<li><a href="javascript::void(0)" class="edit_step_block"><i class="fa fa-pencil"></i></a></li>
							</ul>
						</div>
					</div>
					<div class="step_block step_four complete">
						<div class="value_block">
							<div class="heading">
								<h4>
									<div class="icon">
										<i class="fa fa-rupee"></i>	
										<span class="complete_sign"><i class="fa fa-check"></i></span>
									</div>
									Payment Detail<span class="br">Step 3/3</span>
								</h4>
							</div>
							<div class="inner">
								<h3>Payment Summary</h3>
								<div class="row">
									<div class="col-8">
										<div class="billing-info-area {{ $digital == 1 ? 'd-none' : '' }}">
														<h4 class="title">
																{{ $langg->lang758 }}
														</h4><hr/>
												<ul class="info-list">
													<li>
														<p id="shipping_user"></p>
													</li>
													<li>
														<p id="shipping_location"></p>
													</li>
													<li>
														<p id="shipping_phone"></p>
													</li>
													<li>
														<p id="shipping_email"></p>
													</li>
												</ul>
										</div>


										<div class="payment-information">
													<h4 class="title">
														{{ $langg->lang759 }}
													</h4>
												<hr/>
												<div class="row">
													<div class="col-lg-12">
														<div class="nav flex-column"  role="tablist" aria-orientation="vertical">
														@if($gs->paypal_check == 1)
															<a class="nav-link payment" data-val="" data-show="no" data-form="{{route('paypal.submit')}}" data-href="{{ route('front.load.payment',['slug1' => 'paypal','slug2' => 0]) }}" id="v-pills-tab1-tab" data-toggle="pill" href="#v-pills-tab1" role="tab" aria-controls="v-pills-tab1" aria-selected="true">
																	<div class="icon">
																			<span class="radio"></span>
																	</div>
																<p>
																		{{ $langg->lang760 }}

																	@if($gs->paypal_text != null)

																	<small>
																			{{ $gs->paypal_text }}
																	</small>

																	@endif

																</p>
															</a>
														@endif
														@if($gs->stripe_check == 1)
															<a class="nav-link payment" data-val="" data-show="yes" data-form="{{route('stripe.submit')}}" data-href="{{ route('front.load.payment',['slug1' => 'stripe','slug2' => 0]) }}" id="v-pills-tab2-tab" data-toggle="pill" href="#v-pills-tab2" role="tab" aria-controls="v-pills-tab2" aria-selected="false">
																	<div class="icon">
																			<span class="radio"></span>
																	</div>
																	<p>
																	{{ $langg->lang761 }}

																		@if($gs->stripe_text != null)

																		<small>
																			{{ $gs->stripe_text }}
																		</small>

																		@endif

																	</p>
															</a>
														@endif
														@if($gs->cod_check == 1)
														 @if($digital == 0)
															<a class="nav-link payment" data-val="" data-show="no" data-form="{{route('cash.submit')}}" data-href="{{ route('front.load.payment',['slug1' => 'cod','slug2' => 0]) }}" id="v-pills-tab3-tab" data-toggle="pill" href="#v-pills-tab3" role="tab" aria-controls="v-pills-tab3" aria-selected="false">
																	<div class="icon">
																			<span class="radio"></span>
																	</div>
																	<p>
																			{{ $langg->lang762 }}

																		@if($gs->cod_text != null)

																		<small>
																				{{ $gs->cod_text }}
																		</small>

																		@endif

																	</p>
															</a>
														 @endif
														@endif
														@if($gs->is_instamojo == 1)
															<a class="nav-link payment" data-val="" data-show="no" data-form="{{route('instamojo.submit')}}" data-href="{{ route('front.load.payment',['slug1' => 'instamojo','slug2' => 0]) }}"  id="v-pills-tab4-tab" data-toggle="pill" href="#v-pills-tab4" role="tab" aria-controls="v-pills-tab4" aria-selected="false">
																	<div class="icon">
																			<span class="radio"></span>
																	</div>
																	<p>
																			{{ $langg->lang763 }}

																		@if($gs->instamojo_text != null)

																		<small>
																				{{ $gs->instamojo_text }}
																		</small>

																		@endif

																	</p>
															</a>
															@endif
															@if($gs->is_paytm == 1)
																<a class="nav-link payment" data-val="" data-show="no" data-form="{{route('paytm.submit')}}" data-href="{{ route('front.load.payment',['slug1' => 'paytm','slug2' => 0]) }}"  id="v-pills-tab5-tab" data-toggle="pill" href="#v-pills-tab5" role="tab" aria-controls="v-pills-tab5" aria-selected="false">
																		<div class="icon">
																				<span class="radio"></span>
																		</div>
																		<p>
																				{{ $langg->paytm }}
	
																			@if($gs->paytm_text != null)
	
																			<small>
																					{{ $gs->paytm_text }}
																			</small>
	
																			@endif
	
																		</p>
																</a>
																@endif
																@if($gs->is_razorpay == 1)
																	<a class="nav-link payment" data-val="" data-show="no" data-form="{{route('razorpay.submit')}}" data-href="{{ route('front.load.payment',['slug1' => 'razorpay','slug2' => 0]) }}"  id="v-pills-tab6-tab" data-toggle="pill" href="#v-pills-tab6" role="tab" aria-controls="v-pills-tab6" aria-selected="false">
																			<div class="icon">
																					<span class="radio"></span>
																			</div>
																			<p>
																					
																				{{ $langg->razorpay }}
		
																				@if($gs->razorpay_text != null)
		
																				<small>
																						{{ $gs->razorpay_text }}
																				</small>
		
																				@endif
		
																			</p>
																	</a>
																	@endif
															@if($gs->is_paystack == 1)

															<a class="nav-link payment" data-val="paystack" data-show="no" data-form="{{route('paystack.submit')}}" data-href="{{ route('front.load.payment',['slug1' => 'paystack','slug2' => 0]) }}" id="v-pills-tab7-tab" data-toggle="pill" href="#v-pills-tab7" role="tab" aria-controls="v-pills-tab7" aria-selected="false">
																	<div class="icon">
																			<span class="radio"></span>
																	</div>
																	<p>
																			{{ $langg->lang764 }}

																		@if($gs->paystack_text != null)

																		<small>
																				{{ $gs->paystack_text }}
																		</small>

																		@endif
																	</p>
															</a>

															@endif


															@if($gs->is_molly == 1)
															<a class="nav-link payment" data-val="" data-show="no" data-form="{{route('molly.submit')}}" data-href="{{ route('front.load.payment',['slug1' => 'molly','slug2' => 0]) }}" id="v-pills-tab8-tab" data-toggle="pill" href="#v-pills-tab8" role="tab" aria-controls="v-pills-tab8" aria-selected="false">
																	<div class="icon">
																			<span class="radio"></span>
																	</div>
																	<p>
																			{{ $langg->lang802 }}

																		@if($gs->molly_text != null)

																		<small>
																				{{ $gs->molly_text }}
																		</small>

																		@endif
																	</p>
															</a>

															@endif


@if($digital == 0)

@foreach($gateways as $gt)

															<a class="nav-link payment" data-val="" data-show="yes" data-form="{{route('gateway.submit')}}" data-href="{{ route('front.load.payment',['slug1' => 'other','slug2' => $gt->id]) }}" id="v-pills-tab{{ $gt->id }}-tab" data-toggle="pill" href="#v-pills-tab{{ $gt->id }}" role="tab" aria-controls="v-pills-tab{{ $gt->id }}" aria-selected="false">
																	<div class="icon">
																			<span class="radio"></span>
																	</div>
																	<p>
																			{{ $gt->title }}

																		@if($gt->subtitle != null)

																		<small>
																				{{ $gt->subtitle }}
																		</small>

																		@endif

																	</p>
															</a>



@endforeach

@endif

														</div>
													</div>
													<div class="col-lg-12">
													  <div class="pay-area d-none">
														<div class="tab-content" id="v-pills-tabContent">
															@if($gs->paypal_check == 1)
															<div class="tab-pane fade" id="v-pills-tab1" role="tabpanel" aria-labelledby="v-pills-tab1-tab">

															</div>
															@endif
															@if($gs->stripe_check == 1)
															<div class="tab-pane fade" id="v-pills-tab2" role="tabpanel" aria-labelledby="v-pills-tab2-tab">
															</div>
															@endif
															@if($gs->cod_check == 1)
															@if($digital == 0)
															<div class="tab-pane fade" id="v-pills-tab3" role="tabpanel" aria-labelledby="v-pills-tab3-tab">
															</div>
															@endif
															@endif
															@if($gs->is_instamojo == 1)
																<div class="tab-pane fade" id="v-pills-tab4" role="tabpanel" aria-labelledby="v-pills-tab4-tab">
																</div>
															@endif
															@if($gs->is_paytm == 1)
																<div class="tab-pane fade" id="v-pills-tab5" role="tabpanel" aria-labelledby="v-pills-tab5-tab">
																</div>
															@endif
															@if($gs->is_razorpay == 1)
																<div class="tab-pane fade" id="v-pills-tab6" role="tabpanel" aria-labelledby="v-pills-tab6-tab">
																</div>
															@endif
															@if($gs->is_paystack == 1)
																<div class="tab-pane fade" id="v-pills-tab7" role="tabpanel" aria-labelledby="v-pills-tab7-tab">
																</div>
															@endif
															@if($gs->is_molly == 1)
																<div class="tab-pane fade" id="v-pills-tab8" role="tabpanel" aria-labelledby="v-pills-tab8-tab">
																</div>
															@endif

													@if($digital == 0)
														@foreach($gateways as $gt)

															<div class="tab-pane fade" id="v-pills-tab{{ $gt->id }}" role="tabpanel" aria-labelledby="v-pills-tab{{ $gt->id }}-tab">

															</div>

														@endforeach		
													@endif												
													</div>
														</div>
													</div>
												</div>
											</div>

											
											<input type="hidden" id="shipping-cost" name="shipping_cost" value="0">
											<input type="hidden" id="packing-cost" name="packing_cost" value="0">
											<input type="hidden" name="dp" value="{{$digital}}">
											<input type="hidden" name="tax" value="{{$gs->tax}}">
											<input type="hidden" name="totalQty" value="{{$totalQty}}">

											<input type="hidden" name="vendor_shipping_id" value="{{ $vendor_shipping_id }}">
											<input type="hidden" name="vendor_packing_id" value="{{ $vendor_packing_id }}">


											@if(Session::has('coupon_total'))
												<input type="hidden" name="total" id="grandtotal" value="{{ $totalPrice }}">
												<input type="hidden" id="tgrandtotal" value="{{ $totalPrice }}">
											@elseif(Session::has('coupon_total1'))
												<input type="hidden" name="total" id="grandtotal" value="{{ preg_replace("/[^0-9,.]/", "", Session::get('coupon_total1') ) }}">
												<input type="hidden" id="tgrandtotal" value="{{ preg_replace("/[^0-9,.]/", "", Session::get('coupon_total1') ) }}">
											@else
												<input type="hidden" name="total" id="grandtotal" value="{{round($totalPrice * $curr->value,2)}}">
												<input type="hidden" id="tgrandtotal" value="{{round($totalPrice * $curr->value,2)}}">
											@endif

											<input type="hidden" id="ttotal" value="{{ Session::has('cart') ? App\Models\Product::convertPrice(Session::get('cart')->totalPrice) : '0' }}">
											<input type="hidden" name="coupon_code" id="coupon_code" value="{{ Session::has('coupon_code') ? Session::get('coupon_code') : '' }}">
											<input type="hidden" name="coupon_discount" id="coupon_discount" value="{{ Session::has('coupon') ? Session::get('coupon') : '' }}">
											<input type="hidden" name="coupon_id" id="coupon_id" value="{{ Session::has('coupon') ? Session::get('coupon_id') : '' }}">
											<input type="hidden" name="user_id" id="user_id" value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->id : '' }}">

									</div>
									@if(Session::has('cart'))
									<div class="col-4">
										<div class="gift_bag">
											
										</div>
										<div class="review_order">
											<h3>Check out details</h3>	
											<div class="price_detail">
												<ul class="price_list2">
													<li>Total MRP <span>{{ Session::has('cart') ? App\Models\Product::convertPrice(Session::get('cart')->totalPrice) : '0.00' }}</span></li>
													@if($gs->tax != 0)
													<li>GST <span>{{$gs->tax}}% </span></li>
													@endif
													@if(Session::has('coupon'))
													<li class="discount-bar">Coupon <a href="#coupon" data-bs-toggle="modal" class="edit">edit</a>
													<i class="dpercent">{{ Session::get('coupon_percentage') == 0 ? '' : '('.Session::get('coupon_percentage').')' }}</i>	
													
														@if($gs->currency_format == 0)
															<span id="discount">{{ $curr->sign }}{{ Session::get('coupon') }}</span>
														@else 
															<span id="discount">{{ Session::get('coupon') }}{{ $curr->sign }}</span>
														@endif
													</li>
													@else
													<li class="discount-bar">Coupon <a href="#coupon" data-bs-toggle="modal" class="edit">edit</a>
														<span id="discount">{{ $curr->sign }}{{ Session::get('coupon') }} 0.00</span>
													</li>
													@endif
													<li  class="total-price">Total 
															@if(Session::has('coupon_total'))
																@if($gs->currency_format == 0)
																	<span id="total-cost">{{ $curr->sign }}{{ $totalPrice }}</span>
																@else 
																	<span id="total-cost">{{ $totalPrice }}{{ $curr->sign }}</span>
																@endif

															@elseif(Session::has('coupon_total1'))
																<span id="total-cost"> {{ Session::get('coupon_total1') }}</span>
																@else
																<span id="total-cost">{{ App\Models\Product::convertPrice($totalPrice) }}</span>
															@endif
													
													</li>
												</ul>
												<div class="coupon_detail" style="margin-bottom:5px;">	
												@if(Session::has('coupon'))
													<div class="after_apply">
														<h5 id="applied_coupan">{{Session::get('already')}}</h5>
															<h6>Coupon code applied successfully <a href="javasctip::void(0)" class="remove-coupon">Remove</a></h6>
													</div>
												@else
													<div class="after_apply" style="display:none">
													<h5 id="applied_coupan"></h5>
														<h6>Coupon code applied successfully <a href="javasctip::void(0)" class="remove-coupon">Remove</a></h6>
													</div>
												@endif
												</div>
											</div>

											@if($digital == 0)

												{{-- Shipping Method Area Start --}}
												<div class="packeging-area">
														<h4 class="title">{{ $langg->lang765 }}</h4>

													@foreach($shipping_data as $data)
												
														<div class="radio-design">
																<input type="radio" class="shipping" id="free-shepping{{ $data->id }}" name="shipping" value="{{ round($data->price * $curr->value,2) }}" {{ ($loop->first) ? 'checked' : '' }}> 
																<span class="checkmark"></span>
																<label for="free-shepping{{ $data->id }}"> 
																		{{ $data->title }}
																		@if($data->price != 0)
																		+ {{ $curr->sign }}{{ round($data->price * $curr->value,2) }}
																		@endif
																		<small>{{ $data->subtitle }}</small>
																</label>
														</div>

													@endforeach		

												</div>
												{{-- Shipping Method Area End --}}

												{{-- Packeging Area Start --}}
												<div class="packeging-area">
														<h4 class="title">{{ $langg->lang766 }}	
														<p style="font-size:10px">do you want to get this gift-wrapped?</p>														
														</h4>
														

													@foreach($package_data as $key => $data)	

														<div class="radio-design @if($key == 0) d-none1 @endif" >
																<input data-giftmsg=@if($key == 0) "0" @else "1" @endif type="radio" class="packing" id="free-package{{ $data->id }}" name="packeging" value="{{ round($data->price * $curr->value,2) }}" {{ ($loop->first) ? 'checked' : '' }}> 
																<span class="checkmark"></span>
																<label for="free-package{{ $data->id }}"> 
																		{{ $data->title }}
																		@if($data->price != 0)
																		+ {{ $curr->sign }}{{ round($data->price * $curr->value,2) }}
																		@endif
																		<small>{{ $data->subtitle }}</small>
																</label>
														</div>

													@endforeach	

													<div class="form-group">
														<textarea name="gift_wrapped_message" id="gift-wrapped-message" class="form-control" style="display:none"></textarea>
													</div>

												</div>
												{{-- Packeging Area End Start--}}





											<div class="all_price final-price">
												<label> You pay</label>
												@if(Session::has('coupon_total'))
													@if($gs->currency_format == 0)
														<div id="final-cost">{{ $curr->sign }}{{ $totalPrice }}</div>
													@else 
														<div id="final-cost">{{ $totalPrice }}{{ $curr->sign }}</div>
													@endif

												@elseif(Session::has('coupon_total1'))
													<div id="final-cost"> {{ Session::get('coupon_total1') }}</div>
													@else
													<div id="final-cost">{{ App\Models\Product::convertPrice($totalPrice) }}</div>
												@endif
											</div>

											{{-- Final Price Area End --}}

											@endif
											<div class="text-center">
												<button type="submit" id="final-btn" class="mybtn1 btn full-width">Proceed to payment</button>
												<p class="tnc">By Clicking "Proceed to payment" you are agreeing to the <a href="#">Terms & Conditions</a></p>
											</div>
										</div>
									</div>
									@endif
								</div>
							</div>
						
						
						
						</div>
						<div class="edit_block">
							<ul class="step_list step_four_list">
								<li>
									<h4>
										<div class="icon">
											<i class="fa fa-address-card-o"></i>	
											<span class="complete_sign"><i class="fa fa-check"></i></span>
										</div>
										Payment Detail <span class="br">Step 3/3</span>
									</h4>
								</li>
								<li>
									
								</li>
								<li></li>
							</ul>
						</div>
					</div>
				
				
				
				</div>
			</form>
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
				<hr/>
				<h3>Apply Coupon Code</h3>
				<div class="form-group coupon" id="check-coupon-form" style="text-align: center;">
					<input type="text" class="form-control" placeholder="Enter your coupon code" id="code" required="" autocomplete="off">
					<button type="button" class="btn btn-primary applycustomCoupon" style="margin-top:5px">Apply</button>
					
				</div>
			</div>
		</div>
	</div>
</div>	
	

@endsection

@section('scripts')

<script src="https://js.paystack.co/v1/inline.js"></script>


<script type="text/javascript">
	$('a.payment:first').addClass('active');
	$('.checkoutform').prop('action',$('a.payment:first').data('form'));
	$($('a.payment:first').attr('href')).load($('a.payment:first').data('href'));


		var show = $('a.payment:first').data('show');
		if(show != 'no') {
			$('.pay-area').removeClass('d-none');
		}
		else {
			$('.pay-area').addClass('d-none');
		}
	$($('a.payment:first').attr('href')).addClass('active').addClass('show');
</script>


<script type="text/javascript">

var coup = 0;
var pos = {{ $gs->currency_format }};

@if(isset($checked))

	//$('#comment-log-reg1').modal('show');

@endif

var mship = $('.shipping').length > 0 ? $('.shipping').first().val() : 0;
var mpack = $('.packing').length > 0 ? $('.packing').first().val() : 0;
mship = parseFloat(mship);
mpack = parseFloat(mpack);

$('#shipping-cost').val(mship);
$('#packing-cost').val(mpack);
var ftotal = parseFloat($('#grandtotal').val()) + mship + mpack;
ftotal = parseFloat(ftotal);
      if(ftotal % 1 != 0)
      {
        ftotal = ftotal.toFixed(2);
      }
		if(pos == 0){
			$('#final-cost').html('{{ $curr->sign }}'+ftotal)
		}
		else{
			$('#final-cost').html(ftotal+'{{ $curr->sign }}')
		}

$('#grandtotal').val(ftotal);

$('#shipop').on('change',function(){

	var val = $(this).val();
	if(val == 'pickup'){
		$('#shipshow').removeClass('d-none');
		$("#ship-diff-address").parent().addClass('d-none');
        $('.ship-diff-addres-area').addClass('d-none');  
        $('.ship-diff-addres-area input, .ship-diff-addres-area select').prop('required',false);  
	}
	else{
		$('#shipshow').addClass('d-none');
		$("#ship-diff-address").parent().removeClass('d-none');
        $('.ship-diff-addres-area').removeClass('d-none');  
        $('.ship-diff-addres-area input, .ship-diff-addres-area select').prop('required',true); 
	}

});


$('.shipping').on('click',function(){
	mship = $(this).val();

$('#shipping-cost').val(mship);
var ttotal = parseFloat($('#tgrandtotal').val()) + parseFloat(mship) + parseFloat(mpack);
ttotal = parseFloat(ttotal);
      if(ttotal % 1 != 0)
      {
        ttotal = ttotal.toFixed(2);
      }
		if(pos == 0){
			$('#final-cost').html('{{ $curr->sign }}'+ttotal);
		}
		else{
			$('#final-cost').html(ttotal+'{{ $curr->sign }}');
		}
	
$('#grandtotal').val(ttotal);

})

$('.packing').on('click',function(){
	mpack = $(this).val();
$('#packing-cost').val(mpack);
var ttotal = parseFloat($('#tgrandtotal').val()) + parseFloat(mship) + parseFloat(mpack);
ttotal = parseFloat(ttotal);
      if(ttotal % 1 != 0)
      {
        ttotal = ttotal.toFixed(2);
      }

		if(pos == 0){
			$('#final-cost').html('{{ $curr->sign }}'+ttotal);
		}
		else{
			$('#final-cost').html(ttotal+'{{ $curr->sign }}');
		}	


$('#grandtotal').val(ttotal);
		
})


$('.applycustomCoupon').click(function(){
	
	if($('#code').val() != ""){
        var val = $("#code").val();
        var total = $("#ttotal").val();
        var ship = 0;
            $.ajax({
                    type: "GET",
                    url:mainurl+"/carts/coupon/check",
                    data:{code:val, total:total, shipping_cost:ship},
                    success:function(data){
                        if(data == 0)
                        {
                        	toastr.error(langg.no_coupon);
                            $("#code").val("");
                        }
                        else if(data == 2)
                        {
                        	toastr.error(langg.already_coupon);
                            $("#code").val("");
                        }
                        else
                        {
                           // $("#check-coupon-form").toggle();
                            $(".discount-bar").removeClass('d-none');

							if(pos == 0){
								$('#total-cost').html('{{ $curr->sign }}'+data[0]);
								$('#discount').html('{{ $curr->sign }}'+data[2]);
							}
							else{
								$('#total-cost').html(data[0]+'{{ $curr->sign }}');
								$('#discount').html(data[2]+'{{ $curr->sign }}');
							}
								$('#grandtotal').val(data[0]);
								$('#tgrandtotal').val(data[0]);
								$('#coupon_code').val(data[1]);
								$('#coupon_discount').val(data[2]);
								$('.after_apply').show();
                            	$('#applied_coupan').text(data[1]);
								if(data[4] != 0){
								$('.dpercent').html('('+data[4]+')');
								}
								else{
								$('.dpercent').html('');									
								}


var ttotal = parseFloat($('#grandtotal').val()) + parseFloat(mship) + parseFloat(mpack);
ttotal = parseFloat(ttotal);
		if(ttotal % 1 != 0)
		{
			ttotal = ttotal.toFixed(2);
		}

			if(pos == 0){
				$('#final-cost').html('{{ $curr->sign }}'+ttotal)
			}
		else{
			$('#final-cost').html(ttotal+'{{ $curr->sign }}')
		}	

			toastr.success(langg.coupon_found);
			$("#code").val("");
		}
		}
              }); 
	}else{
alert("Please enter a code");
}
    });




	
$('.applycoupan').click(function(){
	code = $(this).data('code');
	$('#code').val(code);
	if($('#code').val() != ""){
        var val = $("#code").val();
        var total = $("#ttotal").val();
        var ship = 0;
            $.ajax({
                    type: "GET",
                    url:mainurl+"/carts/coupon/check",
                    data:{code:val, total:total, shipping_cost:ship},
                    success:function(data){
                        if(data == 0)
                        {
                        	toastr.error(langg.no_coupon);
                            $("#code").val("");
                        }
                        else if(data == 2)
                        {
                        	toastr.error(langg.already_coupon);
                            $("#code").val("");
                        }
                        else
                        {
                           // $("#check-coupon-form").toggle();
                            $(".discount-bar").removeClass('d-none');

							if(pos == 0){
								$('#total-cost').html('{{ $curr->sign }}'+data[0]);
								$('#discount').html('{{ $curr->sign }}'+data[2]);
							}
							else{
								$('#total-cost').html(data[0]+'{{ $curr->sign }}');
								$('#discount').html(data[2]+'{{ $curr->sign }}');
							}
								$('#grandtotal').val(data[0]);
								$('#tgrandtotal').val(data[0]);
								$('#coupon_code').val(data[1]);
								$('#coupon_discount').val(data[2]);
								$('.after_apply').show();
                            	$('#applied_coupan').text(data[1]);
								if(data[4] != 0){
								$('.dpercent').html('('+data[4]+')');
								}
								else{
								$('.dpercent').html('');									
								}


var ttotal = parseFloat($('#grandtotal').val()) + parseFloat(mship) + parseFloat(mpack);
ttotal = parseFloat(ttotal);
		if(ttotal % 1 != 0)
		{
			ttotal = ttotal.toFixed(2);
		}

			if(pos == 0){
				$('#final-cost').html('{{ $curr->sign }}'+ttotal)
			}
		else{
			$('#final-cost').html(ttotal+'{{ $curr->sign }}')
		}	

			toastr.success(langg.coupon_found);
			$("#code").val("");
		}
		}
              }); 
	}else{
alert("Please enter a code");
}
    });

	$('.remove-coupon').click(function(){
		$.ajax({url: "{{route('remove-coupon')}}", success: function(result){
			if(result.status){
				
				$('.after_apply').hide();
				$('#applied_coupan').text('');
				$('#discount').text('0.00');
				$('#total-cost').html(result.mainTotal);
				$('#grandtotal').val(result.mainTotalAmount);
				$('#tgrandtotal').val(result.mainTotalAmount);
				$('#coupon_code').val('');
				$('#coupon_discount').val(0);

				var ttotal = parseFloat($('#grandtotal').val()) + parseFloat(mship) + parseFloat(mpack);
				ttotal = parseFloat(ttotal);
						if(ttotal % 1 != 0)
						{
							ttotal = ttotal.toFixed(2);
						}

							if(pos == 0){
								$('#final-cost').html('{{ $curr->sign }}'+ttotal)
							}
						else{
							$('#final-cost').html(ttotal+'{{ $curr->sign }}')
						}	

							toastr.success("Coupon removed");
							$("#code").val("");
				}
		}});
	});

// Password Checking

        $("#open-pass").on( "change", function() {
            if(this.checked){
             $('.set-account-pass').removeClass('d-none');  
             $('.set-account-pass input').prop('required',true); 
             $('#personal-email').prop('required',true);
             $('#personal-name').prop('required',true);
            }
            else{
             $('.set-account-pass').addClass('d-none');   
             $('.set-account-pass input').prop('required',false); 
             $('#personal-email').prop('required',false);
             $('#personal-name').prop('required',false);

            }
        });

// Password Checking Ends


// Shipping Address Checking

		$("#ship-diff-address").on( "change", function() {
            if(this.checked){
             $('.ship-diff-addres-area').removeClass('d-none');  
             $('.ship-diff-addres-area input, .ship-diff-addres-area select').prop('required',true); 
            }
            else{
             $('.ship-diff-addres-area').addClass('d-none');  
             $('.ship-diff-addres-area input, .ship-diff-addres-area select').prop('required',false);  
            }
            
        });


// Shipping Address Checking Ends


</script>


<script type="text/javascript">

var ck = 0;

	$('.checkoutform').on('submit',function(e){
		if(ck == 0) {
			e.preventDefault();			
		$('.step_one').removeClass('active');
		$('.step_one').addClass('complete');
		$('.d_name').text($('#u_name').val());
		$('.d_phone').text($('#u_phone').val());
		$('.d_email').text($('#u_email').val());


		$('.step_two').removeClass('complete');
		$('.step_two').addClass('active');

	}else {
		$('#preloader').show();
	}
	$('#pills-step1-tab').addClass('active');
	});

	$('#step1-btn').on('click',function(){
		$('#pills-step1-tab').removeClass('active');
		$('#pills-step2-tab').removeClass('active');
		$('#pills-step3-tab').removeClass('active');
		$('#pills-step2-tab').addClass('disabled');
		$('#pills-step3-tab').addClass('disabled');

		$('#pills-step1-tab').click();

	});

// Step 2 btn DONE

	$('#step2-btn').on('click',function(){
		$('#pills-step3-tab').removeClass('active');
		$('#pills-step1-tab').removeClass('active');
		$('#pills-step2-tab').removeClass('active');
		$('#pills-step3-tab').addClass('disabled');
		$('#pills-step2-tab').click();
		$('#pills-step1-tab').addClass('active');

	});

	$('#step3-btn').on('click',function(){
	 	if($('a.payment:first').data('val') == 'paystack'){
			$('.checkoutform').prop('id','step1-form');
		}
		else {
			$('.checkoutform').prop('id','');
		}
		$('.step_two').removeClass('active');
		$('.step_two').addClass('complete');
		$('.editsecond').show();

		var shipping_user  = !$('input[name="shipping_name"]').val() ? $('input[name="name"]').val() : $('input[name="shipping_name"]').val();
		var shipping_location  = !$('input[name="shipping_address"]').val() ? $('input[name="address"]').val() : $('input[name="shipping_address"]').val();
		var shipping_phone = !$('input[name="shipping_phone"]').val() ? $('input[name="phone"]').val() : $('input[name="shipping_phone"]').val();
		var shipping_email= !$('input[name="shipping_email"]').val() ? $('input[name="email"]').val() : $('input[name="shipping_email"]').val();

		$('#shipping_user').html('<i class="fa fa-user"></i> '+shipping_user);
		$('#shipping_location').html('<i class="fa fa-map-marker"></i> '+shipping_location);
		$('#shipping_phone').html('<i class="fa fa-phone"></i> '+shipping_phone);
		$('#shipping_email').html('<i class="fa fa-envelope"></i> '+shipping_email);

		$('.step_four').removeClass('complete');
		$('.step_four').addClass('active');
	});

	$('#final-btn').on('click',function(){
		ck = 1;
	})


	$('.payment').on('click',function(){
		if($(this).data('val') == 'paystack'){
			$('.checkoutform').prop('id','step1-form');
		}
		else {
			$('.checkoutform').prop('id','');
		}
		$('.checkoutform').prop('action',$(this).data('form'));
		$('.payment').removeClass('active');
		$(this).addClass('active');
		$('.pay-area #v-pills-tabContent .tab-pane.fade').not($(this).attr('href')).html('');
		var show = $(this).data('show');
		if(show != 'no') {
			$('.pay-area').removeClass('d-none');
		}
		else {
			$('.pay-area').addClass('d-none');
		}
		$($(this).attr('href')).load($(this).data('href'));
	})


        $(document).on('submit','#step1-form',function(){
        	$('#preloader').hide();
            var val = $('#sub').val();
            var total = $('#grandtotal').val();
			total = Math.round(total);
                if(val == 0)
                {
                var handler = PaystackPop.setup({
                  key: '{{$gs->paystack_key}}',
                  email: $('input[name=email]').val(),
                  amount: total * 100,
                  currency: "{{$curr->name}}",
                  ref: ''+Math.floor((Math.random() * 1000000000) + 1),
                  callback: function(response){
                    $('#ref_id').val(response.reference);
                    $('#sub').val('1');
                    $('#final-btn').click();
                  },
                  onClose: function(){
                  	window.location.reload();
                  	
                  }
                });
                handler.openIframe();
                    return false;                    
                }
                else {
                	$('#preloader').show();
                    return true;   
                }
        });

$('.edit_step_block').click(function(){

	$('.step_block').removeClass('active');
	$('.step_block').addClass('complete');
	$(this).parent('li').parent('ul').parent('.edit_block').parent('.step_block').removeClass('complete');
	$(this).parent('li').parent('ul').parent('.edit_block').parent('.step_block').addClass('active');
});


$(document).on('click', '.deliver_this', function(){
	
	$('#address_id').val($(this).data('id'));
	$('#u_name').val($(this).data('name'));
	$('#u_phone').val($(this).data('phone'));
	$('#u_city').val($(this).data('city'));
	$('#u_state').val($(this).data('state'));
	$('#u_country').val($(this).data('country'));
	$('#u_zip').val($(this).data('zip'));
	$('#u_address').val($(this).data('address'));
});

$('.packing').click(function(){
	
	if ($(this).is(":checked")){
	
		if($(this).data('giftmsg') == 1){
			
			$('#gift-wrapped-message').val('');
			$('#gift-wrapped-message').show();
		}else{
			$('#gift-wrapped-message').val('');
			$('#gift-wrapped-message').hide();
		}
	}
});

$('#u_country').change(function(){
	country_id = $(this).find(':selected').data('id');
	
	$("#u_state").html('<option>Loading....</option>');
	$('#u_city').html('<option>Loading....</option>');
	$.ajax({url: "{{route('get-state','')}}/"+country_id, success: function(result){
		$("#u_state").html(result);
		if($('#u_state').val() != ""){
			$('#u_state').change();
		}
	}});

});

$('#u_state').change(function(){
	state_id = $(this).find(':selected').data('id');
	$('#u_city').html('<option>Loading....</option>');
	$.ajax({url: "{{route('get-city', '')}}/"+state_id, success: function(result){
		$("#u_city").html(result);
	}});
});

$('#shipping_country').change(function(){
	country_id = $(this).find(':selected').data('id');
	
	$("#shipping_state").html('<option>Loading....</option>');
	$('#shipping_city').html('<option>Loading....</option>');
	$.ajax({url: "{{route('get-state','')}}/"+country_id, success: function(result){
		$("#shipping_state").html(result);
	}});
});

$('#shipping_state').change(function(){
	state_id = $(this).find(':selected').data('id');
	$('#shipping_city').html('<option>Loading....</option>');
	$.ajax({url: "{{route('get-city', '')}}/"+state_id, success: function(result){
		$("#shipping_city").html(result);
	}});
});


$(document).ready(function(){
	if($('#u_country').val() != ""){
		$('#u_country').change();
	}
});

</script>





@endsection