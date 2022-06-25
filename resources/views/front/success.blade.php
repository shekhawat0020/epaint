@extends('layouts.front')




@section('content')
@if(!empty($tempcart))
<section class="inner_page_wrapper">
		<div class="breadcrumb_section">
			<div class="container">
				<ul>
					<li><a href="{{ route('front.index') }}">Home</a></li>
					<li>Order Success</li>
				</ul>
			</div>
		</div>
		<div class="shoppingcart_section wishlist_section">
			<div class="container">
           		<div class="heading">
                    @if($order->payment_status =="Completed")
					<h3>THANK YOU FOR YOUR PURCHASE.</h3>
                    @else
					<h3>Payment Status are still pending</h3>
                    @endif

                    <p class="text">
                        {{ $langg->order_text }}
                    </p>
                    <a href="{{ route('front.index') }}" class="link">{{ $langg->lang170 }}</a>
                    
				</div>
           
				<p class="copy_text">Ordered on {{date('d-M-Y',strtotime($order->created_at))}}<span>|</span> Order# {{$order->order_number}} </p>
				@include('includes.form-success')
                <div class="shipping_detail row">
					<div class="col-4">
					@if($order->dp == 1)
                        <h4>Billing Address</h4>
                        <p>
                            {{ $langg->lang288 }} {{$order->customer_name}}<br>
                            {{ $langg->lang289 }} {{$order->customer_email}}<br>
                            {{ $langg->lang290 }} {{$order->customer_phone}}<br>
                            {{ $langg->lang291 }} {{$order->customer_address}}<br>
                            {{$order->customer_city}}, {{$order->customer_state}},  {{$order->customer_country}}-{{$order->customer_zip}}
                        </p>
                    
                    @else
                        @if($order->shipping == "shipto")
                        <h4>Shipping Address</h4>
                    <p> {{ $langg->lang288 }} {{$order->shipping_name == null ? $order->customer_name : $order->shipping_name}}<br>
                        {{ $langg->lang289 }} {{$order->shipping_email == null ? $order->customer_email : $order->shipping_email}}<br>
                        {{ $langg->lang290 }} {{$order->shipping_phone == null ? $order->customer_phone : $order->shipping_phone}}<br>
                        {{ $langg->lang291 }} {{$order->shipping_address == null ? $order->customer_address : $order->shipping_address}}<br>
                        {{$order->shipping_city == null ? $order->customer_city : $order->shipping_city}}, 
                        {{$order->shipping_state == null ? $order->customer_state : $order->shipping_state}}, 
                        {{$order->shipping_country == null ? $order->customer_country : $order->shipping_country}}, 
                        {{$order->shipping_zip == null ? $order->customer_zip : $order->shipping_zip}}
                        </p>
                        
                         @else
                         <h4>PickUp Location</h4>
                           <p>
                               {{$order->shipping}} {{ $langg->lang304 }} {{$order->pickup_location}}<br>
                            </p>
                        @endif

                        <h4>Billing Address</h4>
                        <p>
                            {{ $langg->lang288 }} {{$order->customer_name}}<br>
                            {{ $langg->lang289 }} {{$order->customer_email}}<br>
                            {{ $langg->lang290 }} {{$order->customer_phone}}<br>
                            {{ $langg->lang291 }} {{$order->customer_address}}<br>
                            {{$order->customer_city}},
                            {{$order->customer_state}},
                            {{$order->customer_country}},
                            {{$order->customer_zip}}
                        </p>

                    @endif
						
					</div>
					<div class="col-4">
						<h4>Payment Method</h4>
						<p>{{$order->method}}</p>
                        @if($order->method != "Cash On Delivery")
                            @if($order->method=="Stripe")
                            <p>{{$order->method}} {{ $langg->lang295 }} {{$order->charge_id}}</p>
                            @endif
                            @if($order->method=="Paypal")
                            <p id="ttn">{{$order->method}} {{ $langg->lang296 }} {{ isset($_GET['tx']) ? $_GET['tx'] : '' }}</p>
                            @else
                            <p id="ttn">{{$order->method}} {{ $langg->lang296 }} {{$order->txnid}}</p>
                            @endif

                        @endif
					</div>
					<div class="col-4">
						<h4>Order Summary</h4>
						<ul>
							<li>Item(s) Subtotal: <span>{{$order->currency_sign}} {{$tempcart->totalPrice}}</span></li>
                            @if($order->coupon_discount)
							<li>Coupon: ({{$order->coupon_code}}) <span>-{{$order->currency_sign}} {{$order->coupon_discount}}</span></li>
                            @endif
                            @if($order->shipping_cost != 0)
                                @php 
                                $price = round(($order->shipping_cost / $order->currency_value),2);
                                @endphp
                                @if(DB::table('shippings')->where('price','=',$price)->count() > 0)
                                <li>
                                {{ DB::table('shippings')->where('price','=',$price)->first()->title }}: <span>{{$order->currency_sign}}{{ round($order->shipping_cost, 2) }}</span>
                                </li>
                                @endif
                            @endif

                            @if($order->packing_cost != 0)

                                @php 
                                $pprice = round(($order->packing_cost / $order->currency_value),2);
                                @endphp


                                @if(DB::table('packages')->where('price','=',$pprice)->count() > 0)
                                <li>
                            {{ DB::table('packages')->where('price','=',$pprice)->first()->title }}: <span>{{$order->currency_sign}}{{ round($order->packing_cost, 2) }}</span>
                            </li>
                                @endif
                            @endif
							<li>Paid Amount: <span>{{$order->currency_sign}}{{ round($order->pay_amount * $order->currency_value , 2) }}</span></li>
						</ul>
					</div>
				</div>
                <br/>
                <table  class="table">
                                <h4 class="text-center">{{ $langg->lang308 }}</h4>
                                <thead>
                                <tr>

                                    <th width="60%">{{ $langg->lang310 }}</th>
                                    <th width="20%">{{ $langg->lang539 }}</th>
                                    <th width="10%">{{ $langg->lang314 }}</th>
                                    <th width="10%">{{ $langg->lang315 }}</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($tempcart->items as $product)
                                    <tr>

                                            <td>{{ $product['item']['name'] }}</td>
                                            <td>
                                                <b>{{ $langg->lang311 }}</b>: {{$product['qty']}} <br>
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

                                                  </td>
                                            <td>{{$order->currency_sign}}{{round($product['item_price'] * $order->currency_value,2)}}</td>
                                            <td>{{$order->currency_sign}}{{round($product['price'] * $order->currency_value,2)}}</td>

                                    </tr>
                                @endforeach



                                </tbody>
                            </table>

    		</div>
		</div>
	</section>
	

@endif






@endsection