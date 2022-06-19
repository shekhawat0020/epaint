@extends('layouts.front')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('assets/front/css/magiczoomplus.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/front/css/slick.css')}}">
<style>
 .color-list li .box {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: inline-block;
    position: relative;
    cursor: pointer;
    /* font-size: 10px; */
}
.custom-control {
    position: relative;
    display: block;
    min-height: 1.5rem;
    padding-left: 1.5rem;
}
.custom-control input {
  float: left;
    margin-right: 8px;
}
.custom-control-label {
    position: relative;
    margin-bottom: 0;
    vertical-align: top;
    
}
.norating{
  color:#888 !important;
}
.color-list li.active .box::after {
    opacity: 1;
}
.color-list li .box::after {
    position: absolute;
    content: "\f00c";
    font-family: FontAwesome;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    color: #FFF;
    font-size: 17px;
    opacity: 0;
}

</style>
@endsection
@section('content')

@php
      $attrPrice = 0;

      if($productt->user_id != 0){
        $attrPrice = $productt->price + $gs->fixed_commission + ($productt->price/100) * $gs->percentage_commission ;
        }

    if(!empty($productt->size) && !empty($productt->size_price)){
          $attrPrice += $productt->size_price[0];
      }

      if(!empty($productt->attributes)){
        $attrArr = json_decode($productt->attributes, true);
      }
@endphp


@if (!empty($attrArr))
  @foreach ($attrArr as $attrKey => $attrVal)
    @if (array_key_exists("details_status",$attrVal) && $attrVal['details_status'] == 1)
      @foreach ($attrVal['values'] as $optionKey => $optionVal)
        @if ($loop->first)
          @if (!empty($attrVal['prices'][$optionKey]))
            @php
                $attrPrice = $attrPrice + $attrVal['prices'][$optionKey] * $curr->value;
            @endphp
          @endif
        @endif
      @endforeach
    @endif
    @endforeach
@endif

@php
  $withSelectedAtrributePrice = $attrPrice+$productt->price;
  $withSelectedAtrributePrice = round(($withSelectedAtrributePrice) * $curr->value,2);

@endphp


<section class="inner_page_wrapper">
		<div class="breadcrumb_section">
			<div class="container">
				<ul>
					<li><a href="{{route('front.index')}}">Home</a></li>
					<li><a href="{{route('front.category',$productt->category->slug)}}">{{$productt->category->name}}</a></li>
					<li>{{ $productt->name }}</li>
				</ul>
			</div>
		</div>
		<div class="pd_wrapper">
			<div class="container">
				<div class="row">
					<div class="col-6">
            {{-- <div id="product__slider">
							<div class="product__slider-thmb">
                @foreach($productt->galleries as $gal)
								<div class="slide">
                  <span>
                    <img src="{{asset('assets/images/galleries/'.$gal->photo)}}" alt="{{asset('assets/images/galleries/'.$gal->photo)}}" class="img-responsive">
                  </span>
                </div>
                @endforeach
							</div>
							<div class="product__slider-main">
							  @foreach($productt->galleries as $gal)
								<div class="slide">
                  <span>
                    <img src="{{asset('assets/images/galleries/'.$gal->photo)}}" alt="{{asset('assets/images/galleries/'.$gal->photo)}}" class="img-responsive">
                  </span>
                </div>
                @endforeach
							</div>
							
						</div> --}}
						<div class="product_zoom">
							<div class="app-figure slick-slider" id="zoom-fig">
                  <a id="Zoom-1" class="MagicZoom" title="" href="{{filter_var($productt->photo, FILTER_VALIDATE_URL) ?$productt->photo:asset('assets/images/products/'.$productt->photo)}}">
                      <img style="width: 100%;" src="{{filter_var($productt->photo, FILTER_VALIDATE_URL) ?$productt->photo:asset('assets/images/products/'.$productt->photo)}}" alt=""/>
                  </a>
                  <div class="selectors slick-list">
                    <ul>
                      <li>
                        <a data-zoom-id="Zoom-1" href="{{filter_var($productt->photo, FILTER_VALIDATE_URL) ?$productt->photo:asset('assets/images/products/'.$productt->photo)}}" data-image="{{filter_var($productt->photo, FILTER_VALIDATE_URL) ?$productt->photo:asset('assets/images/products/'.$productt->photo)}}">
                          <img width="80" srcset="{{filter_var($productt->photo, FILTER_VALIDATE_URL) ?$productt->photo:asset('assets/images/products/'.$productt->photo)}}" src="{{filter_var($productt->photo, FILTER_VALIDATE_URL) ?$productt->photo:asset('assets/images/products/'.$productt->photo)}}" alt="">
                        </a>
                      </li>
                      @foreach($productt->galleries as $gal)
                      <li>
                        <a data-zoom-id="Zoom-1" href="{{asset('assets/images/galleries/'.$gal->photo)}}" data-image="{{asset('assets/images/galleries/'.$gal->photo)}}">
                          <img width="80" srcset="{{asset('assets/images/galleries/'.$gal->photo)}}" src="{{asset('assets/images/galleries/'.$gal->photo)}}" alt="">
                        </a>
                      </li>
                      @endforeach
                    
                    </ul>
                  </div>
    						</div>
						</div>
           
					</div>
					<div class="col-6">
						<div class="product_details">
							<h3>{{ $productt->name }}</h3>
              @if($productt->type == 'Physical')
						  @if($productt->emptyStock())
                <p class="product-outstook">
                  <i class="icofont-close-circled"></i>
                  {{ $langg->lang78 }}
                </p>						  
						  @endif
              @endif

							<p class="price">Price: <span id="sizeprice">{{ $attrPrice != 0 ?  $gs->currency_format == 0 ? $curr->sign.$withSelectedAtrributePrice : $withSelectedAtrributePrice.$curr->sign :$productt->showPrice() }}</span>
                      <small><del>{{ $productt->showPreviousPrice() }}</del></small></p>
							<h4>Overview</h4>
							<div class="copy_block">
              {!! $productt->details !!}
							</div>
						


					

              @if($productt->product_type != "affiliate")
              <div class="number_wrap d-block count {{ $productt->type == 'Physical' ? '' : 'd-none' }}">
								<div class="number qty">
									<span class="minus qtminus"><i class="fa fa-minus"></i></span>
									<input class="qttotal" type="text" value="1"/>
									<span class="plus qtplus"><i class="fa fa-plus"></i></span>
								</div>
							</div>
                @endif


            



           
							<div class="color_div">
              @if(!empty($productt->color))
								<div class="color">
									<p>Color</p>
									<ul class="nav nav-tabs color-list" id="colorTab">
                     @php
                      $is_first = true;
                      @endphp
                      @foreach($productt->color as $key => $data1)
                      <li class="nav-item {{ $is_first ? 'active' : '' }}">
                      <span class="box" data-color="{{ $productt->color[$key] }}" style="background-color: {{ $productt->color[$key] }}">
                        
                    </span>
                      </li>
										  @php
                      $is_first = false;
                      @endphp
                      @endforeach
									</ul>
								</div>
              @endif

              @if(!empty($productt->size))
								<div class="size product-size">
									<p>Size</p>
									<ul class="nav nav-tabs siz-list" id="sizeTab">
                  @php
                      $is_first = true;
                      @endphp
                      @foreach($productt->size as $key => $data1)
                      <li class="nav-item {{ $is_first ? 'active' : '' }}">
											<button class="nav-link  {{ $is_first ? 'active' : '' }}" id="m-tab" data-bs-toggle="tab" data-bs-target="#m" type="button">{{ $data1 }}</button>
                      <input type="hidden" class="size" value="{{ $data1 }}">
                          <input type="hidden" class="size_qty" value="{{ $productt->size_qty[$key] }}">
                          <input type="hidden" class="size_key" value="{{$key}}">
                          <input type="hidden" class="size_price"
                            value="{{ round($productt->size_price[$key] * $curr->value,2) }}">
                    </li>
                    @php
                      $is_first = false;
                      @endphp
                      @endforeach
									
									</ul>
								</div>
							</div>
              @endif

              @if(!empty($productt->size))

                  <input type="hidden" id="stock" value="{{ $productt->size_qty[0] }}">
              @else
                  @php
                  $stck = (string)$productt->stock;
                  @endphp
                  @if($stck != null)
                  <input type="hidden" id="stock" value="{{ $stck }}">
                  @elseif($productt->type != 'Physical')
                  <input type="hidden" id="stock" value="0">
                  @else
                  <input type="hidden" id="stock" value="">
                  @endif

              @endif
              <input type="hidden" id="product_price" value="{{ round($productt->vendorPrice() * $curr->value,2) }}">

              <input type="hidden" id="product_id" value="{{ $productt->id }}">
              <input type="hidden" id="curr_pos" value="{{ $gs->currency_format }}">
              <input type="hidden" id="curr_sign" value="{{ $curr->sign }}">



              <div class="info-meta-3">
                    <ul class="meta-list">
                      

                      @if (!empty($productt->attributes))
                        @php
                          $attrArr = json_decode($productt->attributes, true);
                        @endphp
                      @endif
                      @if (!empty($attrArr))
                        <div class="product-attributes my-4">
                          <div class="row">
                          @foreach ($attrArr as $attrKey => $attrVal)
                            @if (array_key_exists("details_status",$attrVal) && $attrVal['details_status'] == 1)

                          <div class="col-lg-12">
                              <div class="form-group mb-2">
                                <strong for="" class="text-capitalize">{{ str_replace("_", " ", $attrKey) }} :</strong>
                                <div class="">
                                @foreach ($attrVal['values'] as $optionKey => $optionVal)
                                @if ($loop->first)
                                  @if (!empty($attrVal['prices'][$optionKey]))
                                    @php
                                        $attrPrice = $attrPrice + $attrVal['prices'][$optionKey] * $curr->value;
                                    @endphp
                                  @endif
                                @endif
                                  <div class="custom-control custom-radio">
                                    <input type="hidden" class="keys" value="">
                                    <input type="hidden" class="values" value="">
                                    <input type="radio" id="{{$attrKey}}{{ $optionKey }}" name="{{ $attrKey }}" class="custom-control-input product-attr"  data-key="{{ $attrKey }}" data-price = "{{ $attrVal['prices'][$optionKey] * $curr->value }}" value="{{ $optionVal }}" {{ $loop->first ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="{{$attrKey}}{{ $optionKey }}">{{ $optionVal }}
                                 
                                    @if (!empty($attrVal['prices'][$optionKey]))
                                      +
                                      {{$curr->sign}} {{$attrVal['prices'][$optionKey] * $curr->value}}
                                    @endif
                                    </label>
                                  </div>
                                @endforeach
                                </div>
                              </div>
                          </div>
                            @endif
                          @endforeach
                          </div>
                        </div>
                      @endif
                      @php
                          
                      @endphp
                      </ul>
                  </div>


                      {{-- Buttons --}}
                    <ul class="btn_list">
                      @if($productt->product_type == "affiliate")

                      <li class="addtocart">
                        <a href="{{ route('affiliate.product', $productt->slug) }}" target="_blank"> {{ $langg->lang251 }}</a>
                      </li>
                      @else
                      @if($productt->emptyStock())
                      <li class="addtocart">
                        <a href="javascript:;" class="cart-out-of-stock">
                          <i class="icofont-close-circled"></i>
                          {{ $langg->lang78 }}</a>
                      </li>
                      @else
                      <li class="addtocart">
                        <a href="javascript:;" id="addcrt">{{ $langg->lang90 }}</a>
                      </li>

                      <li class="addtocart">
                        <a id="qaddcrt" href="javascript:;">
                          {{ $langg->lang251 }}
                        </a>
                      </li>
                      @endif

                      @endif

                      @if(Auth::guard('web')->check())
                      <li class="favorite">
                        <a href="javascript:;" class="add-to-wish"
                          data-href="{{ route('user-wishlist-add',$productt->id) }}">Add TO Wishlist</a>
                      </li>
                      @endif
                    
                   </ul> 
                 


							<ul class="share_list a2a_kit a2a_kit_size_32 a2a_default_style">
								<li>Share:</li>
								<li><a class="facebook a2a_button_facebook" ><i class="fa fa-facebook"></i></a></li>
								<li><a class="pinterest a2a_button_whatsapp" ><i class="fa fa-instagram"></i></a></li>
								<li><a class="pinterest a2a_button_whatsapp" ><i class="fa fa-whatsapp"></i></a></li>
								<li><a class="pinterest a2a_button_pinterest" ><i class="fa fa-pinterest-p"></i></a></li>
							</ul>
              <script async src="https://static.addtoany.com/menu/page.js"></script>
							<div class="link">
								<a href="#" >Shipping & Returns</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


    
		<div class="review_section">
        	<div class="container">
           		<div class="heading">
           			<h3>Reviews for product</h3>
           		</div>
                <div class="row">
                	<div class="col-3">
                    	<div class="overall_rating">
                        	<h4>Overall rating</h4>
                            <div class="total-rating">
                            	<span>{{App\Models\Rating::rating($productt->id)}}</span>
                              @for($i = 1; $i <= 5 ; $i++)
                                @if($i <= App\Models\Rating::rating($productt->id))
                                <i class="fa fa-star"></i>
                                @else
                                <i class="fa fa-star norating"></i>
                                @endif
                              @endfor
                               
                            </div>
                            <h6>Based on {{ count($productt->ratings) }} review</h6>
                            <ul>
                         
                            </ul>
                        </div>
                    </div>
                    <div class="col-9">
                    	<div class="write_review">
                      @if(Auth::guard('web')->check())
                            <div class="rating">
                              <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                            </div>
                           	<form  id="reviewform" action="{{route('front.review.submit')}}"
                              data-href="{{ route('front.reviews',$productt->id) }}" method="POST">
                              @include('includes.admin.form-both')
                              {{ csrf_field() }}
                              <input type="hidden" id="rating" name="rating" value="5">
                              <input type="hidden" name="user_id" value="{{Auth::guard('web')->user()->id}}">
                              <input type="hidden" name="product_id" value="{{$productt->id}}">
                              <div class="form-group">
                                <textarea name="review" class="form-control" placeholder="Write a review" required=""></textarea>
                              </div>
								                <input type="submit" value="Submit review" class="btn submit-btn">
                            </form>
                      @else

                      <div class="text-center">
                          <a  href="#login" data-bs-toggle="modal" class="btn more_review">Login To Review</a>
                    </div>

                      @endif
                        </div>
                    </div>
                </div>
                <h4>showing {{ count($productt->ratings) }} reviews</h4>
                @if(count($productt->ratings) > 0)
                @foreach($productt->ratings as $review)
                <div class="detailed_review">
                	<div class="review-user">
                    	<div class="img-block">
                        	<img src="{{ $review->user->photo ? asset('assets/images/users/'.$review->user->photo):asset('assets/images/noimage.png') }}" alt="">
                        </div>
                        <h5>{{ $review->user->name }}</h5>
                    </div>
                    <div class="review-text">
                    	<div class="rating">
                              @for($i = 1; $i <= 5 ; $i++)
                                @if($i <= $review->rating)
                                <i class="fa fa-star"></i>
                                @else
                                <i class="fa fa-star norating"></i>
                                @endif
                              @endfor
                        </div>
                        <h5><span>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$review->review_date)->diffForHumans() }}</span></h5>
                        <p> {{$review->review}}</p>
                        <div class="report-block">
                        	<div class="float-left">
                            	<p>Was this review helpful to you?</p>
                                <a href="#">Yes</a>
                                <a href="#">No</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <p>{{ $langg->lang97 }}</p>
                @endif


                
                
               {{--<div class="text-center">
                	<a href="#" class="btn more_review">View more reviews</a>
                </div>--}} 
            </div>
        </div>
		<div class="product_sliders">
			<div class="container">
				<div class="heading">
					<h3>Similar Products</h3>
				</div>
				<div class="owl-carousel product_carousel">
					<div class="item">
						<a href="#" class="img_block">
							<img src="images/product01.webp" alt="">
						</a>
						<a href="#" class="title">Medallion Green Cotton Bedspread</a>
						<p class="proce">₹19,900.00</p>
					</div>
					<div class="item">
						<a href="#" class="img_block">
							<img src="images/product02.webp" alt="">
						</a>
						<a href="#" class="title">Medallion Green Cotton Bedspread</a>
						<p class="proce">₹19,900.00</p>
					</div>
					<div class="item">
						<a href="#" class="img_block">
							<img src="images/product03.webp" alt="">
						</a>
						<a href="#" class="title">Medallion Green Cotton Bedspread</a>
						<p class="proce">₹19,900.00</p>
					</div>
					<div class="item">
						<a href="#" class="img_block">
							<img src="images/product04.webp" alt="">
						</a>
						<a href="#" class="title">Medallion Green Cotton Bedspread</a>
						<p class="proce">₹19,900.00</p>
					</div>
					<div class="item">
						<a href="#" class="img_block">
							<img src="images/product05.webp" alt="">
						</a>
						<a href="#" class="title">Medallion Green Cotton Bedspread</a>
						<p class="proce">₹19,900.00</p>
					</div>
					<div class="item">
						<a href="#" class="img_block">
							<img src="images/product06.webp" alt="">
						</a>
						<a href="#" class="title">Medallion Green Cotton Bedspread</a>
						<p class="proce">₹19,900.00</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	
  <span class="a2a_kit a2a_kit_size_32 ">
	<a href="#" class="whatsapp_icon a2a_button_whatsapp"><i class="fa fa-whatsapp"></i></a>
    </span>
@endsection


@section('scripts')
<script type="text/javascript" src="{{asset('assets/front/js/magiczoomplus.js')}}"></script>	
<script type="text/javascript" src="{{asset('assets/front/js/slick.min.js')}}"></script>	

<script type="text/javascript">

  $(document).on("submit", "#emailreply1", function () {
    var token = $(this).find('input[name=_token]').val();
    var subject = $(this).find('input[name=subject]').val();
    var message = $(this).find('textarea[name=message]').val();
    var $type  = $(this).find('input[name=type]').val();
    $('#subj1').prop('disabled', true);
    $('#msg1').prop('disabled', true);
    $('#emlsub').prop('disabled', true);
    $.ajax({
      type: 'post',
      url: "{{URL::to('/user/admin/user/send/message')}}",
      data: {
        '_token': token,
        'subject': subject,
        'message': message,
        'type'   : $type
      },
      success: function (data) {
        $('#subj1').prop('disabled', false);
        $('#msg1').prop('disabled', false);
        $('#subj1').val('');
        $('#msg1').val('');
        $('#emlsub').prop('disabled', false);
        if(data == 0)
          toastr.error("Oops Something Goes Wrong !!");
        else
          toastr.success("Message Sent !!");
        $('.close').click();
      }

    });
    return false;
  });

</script>


<script type="text/javascript">

  $(document).on("submit", "#emailreply", function () {
    var token = $(this).find('input[name=_token]').val();
    var subject = $(this).find('input[name=subject]').val();
    var message = $(this).find('textarea[name=message]').val();
    var email = $(this).find('input[name=email]').val();
    var name = $(this).find('input[name=name]').val();
    var user_id = $(this).find('input[name=user_id]').val();
    var vendor_id = $(this).find('input[name=vendor_id]').val();
    $('#subj').prop('disabled', true);
    $('#msg').prop('disabled', true);
    $('#emlsub').prop('disabled', true);
    $.ajax({
      type: 'post',
      url: "{{URL::to('/vendor/contact')}}",
      data: {
        '_token': token,
        'subject': subject,
        'message': message,
        'email': email,
        'name': name,
        'user_id': user_id,
        'vendor_id': vendor_id
      },
      success: function () {
        $('#subj').prop('disabled', false);
        $('#msg').prop('disabled', false);
        $('#subj').val('');
        $('#msg').val('');
        $('#emlsub').prop('disabled', false);
        toastr.success("{{ $langg->message_sent }}");
        $('.ti-close').click();
      }
    });
    return false;
  });

  $('.product__slider-main').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    infinite: false,
    asNavFor: '.product__slider-thmb'
  });
  $('.product__slider-thmb').slick({
    slidesToShow: 6,
    slidesToScroll: 1,
    asNavFor: '.product__slider-main',
    vertical: true,
    arrows: true,
    infinite: false,
    verticalSwiping: true,
    focusOnSelect: true,
    responsive: [
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 6,
        slidesToScroll: 1,
        }
      },
      {
        breakpoint: 991,
        settings: {
          slidesToShow: 6,
        slidesToScroll: 1,
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 5,
          slidesToScroll: 1,
      verticalSwiping: false,
        focusOnSelect: false,
        vertical: false,
        }
      },
    {
        breakpoint: 576,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 1,
      verticalSwiping: false,
        focusOnSelect: false,
        vertical: false,
        }
      },
    {
        breakpoint: 480,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
      verticalSwiping: false,
        focusOnSelect: false,
        vertical: false,
        }
      }
    ]
  });

  var mzOptions = {};
  mzOptions = {
      onZoomReady: function () {

          console.log('onReady', arguments[0]);
      },
      onUpdate: function () {
          console.log('onUpdated', arguments[0], arguments[1], arguments[2]);
      },
      onZoomIn: function () {
          $("#Zoom-1 figure").find('div[id^="crMz"]').html('');
          $("#Zoom-1 figure").find('span[id^="crMz"]').html('');
          console.log('onZoomIn', arguments[0]);
      },
      onZoomOut: function () {
          console.log('onZoomOut', arguments[0]);
      },
      onExpandOpen: function () {
          console.log('onExpandOpen', arguments[0]);
      },
      onExpandClose: function () {
          console.log('onExpandClosed', arguments[0]);
      }
  };

</script>

@endsection