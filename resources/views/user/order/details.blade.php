@extends('layouts.front')
@section('styles')
<style>
.process-steps-area {
    margin-bottom: 0px;
    display: block;
}
.process-steps {
    margin: 0;
    padding: 0;
    list-style: none;
    display: block;
}
.process-steps li {
    width: 25%;
    float: left;
    text-align: center;
    position: relative;
}
.process-steps li.done:after, .process-steps li.active:after, .process-steps li.active .icon {
    background: #0f78f2;
}
.process-steps li .title {
    font-weight: 600;
    font-size: 13px;
    color: #777;
    margin-top: 8px;
}
.process-steps li .icon {
    height: 30px;
    width: 30px;
    margin: auto;
    background: #efefef;
    border-radius: 50%;
    line-height: 30px;
    font-size: 14px;
    font-weight: 700;
    color: #000000;
    position: relative;
}
.process-steps li.done:after, .process-steps li.active:after, .process-steps li.active .icon {
    color: #fff;
    background: #ff5500;
}

.process-steps li:after {
    position: absolute;
    content: "";
    height: 3px;
    width: calc(100% - 30px);
    background: #efefef;
    top: 14px;
    z-index: 0;
    right: calc(50% + 15px);
}
.process-steps li:first-child::after {
    display: none;
}
.process-steps li.done:after, .process-steps li.active:after, .process-steps li.active .icon {
    background: #0f78f2;
}
.process-steps li.done:after, .process-steps li.active:after, .process-steps li.active .icon {
    color: #fff;
    background: #ff5500;
}
.badge-success {
    color: #fff;
    background-color: #28a745;
}
.badge-danger{
    color: #fff;
    background-color: #a72828;
}
</style>

@endsection
@section('content')

<section class="inner_page_wrapper">
		<div class="breadcrumb_section">
			<div class="container">
				<ul>
					<li><a href="index.html">Home</a></li>
					<li><a href="my-profile.html">My Profile</a></li>
					<li>Order Detail</li>
				</ul>
			</div>
		</div>
		<div class="shoppingcart_section wishlist_section">
			<div class="container">
                <div class="process-steps-area">
                    @include('includes.order-process')

                </div>
               
           		<div class="heading">
                  
					<h3>Order Details</h3>
				</div>
                
				<p class="copy_text">Ordered on {{date('d-M-Y',strtotime($order->created_at))}} <span>|</span> Order# {{$order->order_number}} [{{$order->status}}] </p>
				<div class="shipping_detail row">
					<div class="col-4">
					@if($order->dp == 1)
                        <h4>Billing Address</h4>
                        <p>
                            {{ $langg->lang288 }} {{$order->customer_name}}<br>
                            {{ $langg->lang289 }} {{$order->customer_email}}<br>
                            {{ $langg->lang290 }} {{$order->customer_phone}}<br>
                            {{ $langg->lang291 }} {{$order->customer_address}}<br>
                            {{$order->customer_city}}-{{$order->customer_zip}}
                        </p>
                    
                    @else
                        @if($order->shipping == "shipto")
                        <h4>Shipping Address</h4>
                    <p> {{ $langg->lang288 }} {{$order->shipping_name == null ? $order->customer_name : $order->shipping_name}}<br>
                        {{ $langg->lang289 }} {{$order->shipping_email == null ? $order->customer_email : $order->shipping_email}}<br>
                        {{ $langg->lang290 }} {{$order->shipping_phone == null ? $order->customer_phone : $order->shipping_phone}}<br>
                        {{ $langg->lang291 }} {{$order->shipping_address == null ? $order->customer_address : $order->shipping_address}}<br>
                        {{$order->shipping_city == null ? $order->customer_city : $order->shipping_city}}-{{$order->shipping_zip == null ? $order->customer_zip : $order->shipping_zip}}
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
                            {{$order->customer_city}}-{{$order->customer_zip}}
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
                            <li>Payment Status:
                                {!! $order->payment_status == 'Pending' ? "<span class='badge badge-danger'>". $langg->lang799 ."</span>":"<span class='badge badge-success'>". $langg->lang800 ."</span>" !!}
                            </li>
							<li>Item(s) Subtotal: <span>{{$order->currency_sign}} {{$cart->totalPrice}}</span></li>
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
                @foreach($cart->items as $product)
                @php $product['item'] =  ($product['item']->type == 'Gift Card')?(array)$product['item']:$product['item']; @endphp
				<div class="delivery_detail">
					<h4>Delivered 28-Nov-2021 </h4>
					<a href="#" class="img_block">
						<img src="{{ isset($product['item']['photo']) ? asset('assets/images/products/'.$product['item']['photo']):asset('assets/images/noimage.png') }}" alt="">
					</a>
					<div class="copy_block">
						@if($product['item']['user_id'] != 0)
                            @php
                            $user = App\Models\User::find($product['item']['user_id']);
                            @endphp
                            @if(isset($user))
                            <a class="title" target="_blank"
                                href="{{ route('front.product', $product['item']['slug']) }}">{{mb_strlen($product['item']['name'],'utf-8') > 30 ? mb_substr($product['item']['name'],0,30,'utf-8').'...' : $product['item']['name']}}</a>
                            @else
                            <a class="title" target="_blank"
                                href="{{ route('front.product', $product['item']['slug']) }}">{{mb_strlen($product['item']['name'],'utf-8') > 30 ? mb_substr($product['item']['name'],0,30,'utf-8').'...' : $product['item']['name']}}</a>
                            @endif
                        @else

                        <a class="title" target="_blank" class="d-block"
                            href="{{ route('front.product', $product['item']['slug']) }}">{{mb_strlen($product['item']['name'],'utf-8') > 30 ? mb_substr($product['item']['name'],0,30,'utf-8').'...' : $product['item']['name']}}</a>

                        @endif

                        @if($product['item']['type'] != 'Physical')
                        @if($order->payment_status == 'Completed')
                            @if($product['item']['file'] != null)
                            <a href="{{ route('user-order-download',['slug' => $order->order_number , 'id' => $product['item']['id']]) }}"
                                class="btn btn-sm btn-primary mt-1">
                                <i class="fa fa-download"></i> {{ $langg->lang316 }}
                            </a>
                            @else
                            <a target="_blank" href="{{ $product['item']['link'] }}"
                                class="btn btn-sm btn-primary mt-1">
                                <i class="fa fa-download"></i> {{ $langg->lang316 }}
                            </a>
                            @endif
                            @if($product['license'] != '')
                            <a href="javascript:;" data-toggle="modal" data-target="#confirm-delete"
                                class="btn btn-sm btn-info product-btn mt-1" id="license"><i
                                    class="fa fa-eye"></i> {{ $langg->lang317 }}</a>
                            @endif
                        @endif
                        @endif


						<p>Return window closed on 09-Dec-2021</p>
                        <p>{{ $langg->lang311 }} : {{$product['qty']}} </p>
                        @if(!empty($product['size']))
                        <p>{{ $langg->lang312 }}: {{ $product['item']['measure'] }}{{str_replace('-',' ',$product['size'])}} </p>
                        @endif
                        @if(!empty($product['color']))
                        
                        <p>{{ $langg->lang313 }}:  <span id="color-bar" style="border: 10px solid {{$product['color'] == "" ? "white" : '#'.$product['color']}};"></span></p>
                        
                        @endif

                        @if(!empty($product['keys']))

                        @foreach( array_combine(explode(',', $product['keys']), explode(',', $product['values']))  as $key => $value)

                            <p>{{ ucwords(str_replace('_', ' ', $key))  }} :  {{ $value }} </p>
                        @endforeach

                        @endif
						<p class="price">Unit Price : {{$order->currency_sign}}{{round($product['item_price'] * $order->currency_value,2)}}</p>
						<p class="price">ToTal Price : {{$order->currency_sign}}{{round($product['price'] * $order->currency_value,2)}}</p>
						<a href="{{ route('front.product', $product['item']['slug']) }}" class="btn"><i class="fa fa-repeat"></i> Buy it again</a>
					</div>
					<ul>
						<li><a href="#">Leave seller feedback</a></li>
						<li><a href="#">Archive order</a></li>
					</ul>
				</div>
                @endforeach



    		</div>
		</div>
	</section>
	


@endsection


@section('scripts')

<script type="text/javascript">
    $('#example').dataTable({
        "ordering": false,
        'paging': false,
        'lengthChange': false,
        'searching': false,
        'ordering': false,
        'info': false,
        'autoWidth': false,
        'responsive': true
    });
</script>
<script>
    $(document).on("click", "#tid", function (e) {
        $(this).hide();
        $("#tc").show();
        $("#tin").show();
        $("#tbtn").show();
    });
    $(document).on("click", "#tc", function (e) {
        $(this).hide();
        $("#tid").show();
        $("#tin").hide();
        $("#tbtn").hide();
    });
    $(document).on("submit", "#tform", function (e) {
        var oid = $("#oid").val();
        var tin = $("#tin").val();
        $.ajax({
            type: "GET",
            url: "{{URL::to('user/json/trans')}}",
            data: {
                id: oid,
                tin: tin
            },
            success: function (data) {
                $("#ttn").html(data);
                $("#tin").val("");
                $("#tid").show();
                $("#tin").hide();
                $("#tbtn").hide();
                $("#tc").hide();
            }
        });
        return false;
    });
</script>
<script type="text/javascript">
    $(document).on('click', '#license', function (e) {
        var id = $(this).parent().find('input[type=hidden]').val();
        $('#key').html(id);
    });
</script>
@endsection