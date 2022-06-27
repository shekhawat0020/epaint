<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
@if(isset($page->meta_tag) && isset($page->meta_description))
        <meta name="keywords" content="{{ $page->meta_tag }}">
        <meta name="description" content="{{ $page->meta_description }}">
		<title>{{$gs->title}}</title>
    @elseif(isset($blog->meta_tag) && isset($blog->meta_description))
        <meta name="keywords" content="{{ $blog->meta_tag }}">
        <meta name="description" content="{{ $blog->meta_description }}">
		<title>{{$gs->title}}</title>
    @elseif(isset($productt))
		<meta name="keywords" content="{{ !empty($productt->meta_tag) ? implode(',', $productt->meta_tag ): '' }}">
		<meta name="description" content="{{ $productt->meta_description != null ? $productt->meta_description : strip_tags($productt->description) }}">
	    <meta property="og:title" content="{{$productt->name}}" />
	    <meta property="og:description" content="{{ $productt->meta_description != null ? $productt->meta_description : strip_tags($productt->description) }}" />
	    <meta property="og:image" content="{{asset('assets/images/thumbnails/'.$productt->thumbnail)}}" />
	    <meta name="author" content="GeniusOcean">
    	<title>{{substr($productt->name, 0,11)."-"}}{{$gs->title}}</title>
    @else
	    <meta name="keywords" content="{{ $seo->meta_keys }}">
	    <meta name="author" content="GeniusOcean">
		<title>{{$gs->title}}</title>
    @endif
<link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/'.$gs->favicon)}}" />

<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">	
<link rel="stylesheet" type="text/css" href="{{asset('assets/front/css/owl.carousel.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/front/css/bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/front/css/style.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/front/css/responsive.css')}}">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


<link rel="stylesheet" type="text/css" href="{{asset('assets/front/jquery-ui/jquery-ui.min.css')}}">
<style>
.close {
    float: right;
    font-size: 1.5rem;
    font-weight: 700;
    line-height: 1;
    color: #000;
    text-shadow: 0 1px 0 #fff;
    opacity: .5;
}
button.close {
    padding: 0;
    background-color: transparent;
    border: 0;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}
.close:not(:disabled):not(.disabled):focus, .close:not(:disabled):not(.disabled):hover {
    opacity: .75;
}
.close:hover {
    color: #000;
    text-decoration: none;
}
.pinterest a{
	background: #c40d11;
}
.sub-content.open, .child-content.open {
    margin-left: 16px;
}


</style>
	@yield('styles')

</head>

<body>

@if($gs->is_loader == 1)
	<div class="preloader" id="preloader" style="background: url({{asset('assets/images/'.$gs->loader)}}) no-repeat scroll center center #FFF;"></div>
	@endif
<div class="xloader d-none" id="xloader" style="background: url({{asset('assets/front/images/xloading.gif')}}) no-repeat scroll center center #FFF;"></div>

<header class="@if(!Route::is('front.index') ) inner_page_header @endif">
		<div class="container">
			<div class="logo">
			@if(Route::is('front.index') )
				<a href="{{ route('front.index') }}"><img src="{{asset('assets/images/'.$gs->logo)}}" alt=""></a>
			@else
				<a href="{{ route('front.index') }}" class="white_logo"><img src="{{asset('assets/images/'.$gs->logo)}}" alt=""></a>
				<a href="{{ route('front.index') }}" class="dark_logo"><img src="{{asset('assets/images/'.$gs->logo)}}" alt=""></a>
			@endif	
			</div>
			<span class="toggle">
                <button type="button" class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </span>
			<div class="navigation">
				<a class="close_nav"><i class="fa fa-close"></i></a>
				<ul class="nav_list">
				@if($gs->is_home == 1)
					<li><a href="{{ route('front.index') }}">Home</a></li>
				@endif	
				@foreach($categories->take(3) as $category)
				<li class="{{count($category->subs) > 0 ? 'dropdown':''}}">
				@if(count($category->subs) > 0)
					<a href="{{ route('front.category',$category->slug) }}" class="dropdown-toggle" data-bs-toggle="dropdown">{{ $category->name }}</a>
					<ul class="dropdown-menu">
					@foreach($category->subs()->whereStatus(1)->get() as $subcat)
					<li>
						<a class="dropdown-item" href="{{ route('front.subcat',['slug1' => $category->slug, 'slug2' => $subcat->slug]) }}">{{ $subcat->name }}</a>
						@if(count($subcat->childs) > 0)
						<span class="menuOPen-btn"></span>
						<ul class="submenu-megamenu">
							@foreach($subcat->childs()->whereStatus(1)->get() as $childcat)
							<li>
								<a href="{{ route('front.childcat',['slug1' => $category->slug, 'slug2' => $subcat->slug, 'slug3' => $childcat->slug]) }}">{{$childcat->name}}</a>
							</li>
							@endforeach
						</ul>
						@endif

					</li>
					@endforeach
					</ul>
				@else
				<a href="{{ route('front.category',$category->slug) }}">{{ $category->name }}</a>
				@endif
				</li>
				@endforeach



				
				@if (DB::table('pagesettings')->find(1)->review_blog==1)
				<li class="active" ><a  href="{{ route('front.blog') }}">{{ $langg->lang18 }}</a></li>
				@endif
				@if($gs->is_faq == 1)
				<li><a href="{{ route('front.faq') }}">{{ $langg->lang19 }}</a></li>
				@endif
				@foreach(DB::table('pages')->where('header','=',1)->get() as $data)
					<li><a href="{{ route('front.page',$data->slug) }}">{{ $data->title }}</a></li>
				@endforeach
				@if($gs->is_contact == 1)
				<li><a href="{{ route('front.contact') }}">{{ $langg->lang20 }}</a></li>
				@endif
				</ul>
			</div>
			<div class="right_nav">
				<ul>
					<li>
						<a href="#search_modal" data-bs-toggle="modal">
							<i class="fa fa-search"></i>
							<b>Search</b>
						</a>
					</li>
					<li>
					@if(!Auth::guard('web')->check())
						<a href="#login" data-bs-toggle="modal">
							<i class="fa fa-user-o"></i>
							<b>Sign IN</b>
						</a>
					@else
					<a href="{{ route('user-dashboard') }}">
							<i class="fa fa-user-o"></i>
							<b>Profile</b>
						</a>
					@endif
					</li>
					<li>
					@if(Auth::guard('web')->check())
						<a href="{{ route('user-wishlists') }}" class="wist">
							<i class="fa fa-heart-o"></i><span id="wishlist-count">{{ Auth::user()->wishlistCount() }}</span>
							<b>Wishlist</b>
						</a>
					@else
					<a href="#login" data-bs-toggle="modal">
							<i class="fa fa-heart-o"></i>
							<b>Wishlist</b>
						</a>
					@endif
					</li>
					<li>
						<a href="{{ route('front.cart') }}">
							<i class="fa fa-shopping-cart"></i><span id="cart-count">{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}</span>
							<b>Cart</b>
						</a>
					</li>
					<li class="req_call">
						<a href="tel:9950995035" class="mobile_phone"><i class="fa fa-phone"></i></a>
						<span>+91 9950995035</span>
						<a href="#request_modal" data-bs-toggle="modal" class="link">Request a call</a>
					</li>
					@if($gs->is_currency == 1)
									<li>
										<div class="currency-selector">
								<span>{{ Session::has('currency') ?   DB::table('currencies')->where('id','=',Session::get('currency'))->first()->sign   : DB::table('currencies')->where('is_default','=',1)->first()->sign }}</span>
										<select name="currency" class="currency selectors nice">
										@foreach(DB::table('currencies')->get() as $currency)
											<option value="{{route('front.currency',$currency->id)}}" {{ Session::has('currency') ? ( Session::get('currency') == $currency->id ? 'selected' : '' ) : ( $currency->is_default == 1 ? 'selected' : '') }} >{{$currency->name}}</option>
										@endforeach
										</select>
										</div>
									</li>
									@endif
				</ul>
			</div>
		</div>
	</header>

@yield('content')

<footer>
		<div class="container">
			<div class="row">
				<div class="col-2">
					<div class="footer_logo">
                        <img src="{{asset('assets/images/'.$gs->footer_logo)}}" alt="">
                    </div>
					<ul class="add_list">
                        <li>
                            <i class="fa fa-map-marker"></i>
                            {!! $gs->footer !!}
                        </li>
                    </ul>
				</div>
				<div class="col-2">
					<h3>ABOUT</h3>
                    <ul class="footer_list">
                        @foreach(DB::table('pages')->where('footer_menu','=','ABOUT')->get() as $data)
						<li><a href="@if($data->redirect_url != null) {{$data->redirect_url}} @else{{ route('front.page',$data->slug) }} @endif">{{ $data->title }}</a></li>
						@endforeach
                    </ul>
				</div>
				<div class="col-2">
					<h3>HELP</h3>
                    <ul class="footer_list">
                        @foreach(DB::table('pages')->where('footer_menu','=','HELP')->get() as $data)
						<li><a href="@if($data->redirect_url != null) {{$data->redirect_url}} @else{{ route('front.page',$data->slug) }} @endif">{{ $data->title }}</a></li>
						@endforeach
                    </ul>
				</div>
				<div class="col-2">
					<h3>Contact</h3>
                    <ul class="footer_list">
                    	<li class="footer-contact"><a href="tel:9950995035">
                            <i class="fa fa-phone"></i>
                            9950995035</a>
                        </li>
                        <li class="footer-contact"><a href="tel:9950503035">
                            <i class="fa fa-phone"></i>
                            9950503035</a>
                        </li>
                        @foreach(DB::table('pages')->where('footer_menu','=','Contact')->get() as $data)

						<li><a href="@if($data->redirect_url != null) {{$data->redirect_url}} @else{{ route('front.page',$data->slug) }} @endif">{{ $data->title }}</a></li>
						@endforeach
                    </ul>
				</div>
				<div class="col-2">
					<div class="newsletter">
						<h4>RECEIVE EMAIL UPDATES</h4>
						<form action="{{route('front.subscribe')}}" id="subscribeform2" method="POST">
						<div class="form-group">
						{{csrf_field()}}
							<input type="email" name="email" class="form-control" placeholder="Your email address">
							<button id="sub-btn2" type="submit">JOIN</button>
						</div>	
						</form>
					</div>
					<ul class="social_list">
					@if($socialsetting->f_status == 1)
                        <li class="facebook"><a href="{{ $socialsetting->facebook }}"><i class="fa fa-facebook-f"></i></a></li>
					@endif
					@if($socialsetting->g_status == 1)
                        <li class="instagram"><a href="{{ $socialsetting->gplus }}"><i class="fa fa-instagram"></i></a></li>
					@endif
					@if($socialsetting->t_status == 1)
                        <li class="twitter"><a href="{{ $socialsetting->twitter }}"><i class="fa fa-twitter"></i></a></li>
					@endif
					@if($socialsetting->l_status == 1)
                        <li class="linkedin"><a href="{{ $socialsetting->linkedin }}"><i class="fa fa-linkedin"></i></a></li>
					@endif
					@if($socialsetting->d_status == 1)
                        <li class="pinterest"><a href="{{ $socialsetting->dribble }}"><i class="fa fa-pinterest"></i></a></li>
					@endif
                    </ul>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="footer_bottom">
						<p>{!! $gs->copyright !!}</p>
						<ul class="secure_list">
							<li>Secure payments</li>
							<li><img src="{{asset('assets/front/images/visa-pay-logo.svg')}}" alt=""></li>
							<li><img src="{{asset('assets/front/images/american-express-logo.svg')}}" alt=""></li>
							<li><img src="{{asset('assets/front/images/applepay.svg')}}" alt=""></li>
							<li><img src="{{asset('assets/front/images/paypal-logo.svg')}}" alt=""></li>
							<li><img src="{{asset('assets/front/images/gpay-logo-1.svg')}}" alt=""></li>
							<li><img src="{{asset('assets/front/images/master-card-logo.svg')}}" alt=""></li>
						</ul>
					</div>	
				</div>
			</div>
		</div>
	</footer>
	



<div class="modal fade login_modal" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			<div class="modal-body signin-form">
				<h2>Hello!</h2>
				<p>Please enter your details</p>
				@include('includes.admin.form-login')
				<form class="mloginform" action="{{ route('user.login.submit') }}" method="POST">
				{{ csrf_field() }}	
				<div class="form-group">
						<input type="email" name="email" class="form-control" placeholder="Email/Mobile number" required="">
					</div>
					<div class="form-group">
						<input type="password" name="password" class="form-control Password" placeholder="Password">
					</div>
					<div class="form-group text-end">
						<a href="{{ route('user-forgot') }}" class="link">Forgot Password?</a>
					</div>
					<div class="form-group text-center">
					<input type="hidden" name="modal" value="1">
                  	<input class="mauthdata" type="hidden" value="{{ $langg->lang177 }}">
						<input type="submit" class="btn" value="Continue">
					</div>
				</form>
				@if(App\Models\Socialsetting::find(1)->f_check == 1 || App\Models\Socialsetting::find(1)->g_check ==
                  1)
				<h3>Or login with</h3>
				<ul class="social_login">
					@if(App\Models\Socialsetting::find(1)->f_check == 1)
					<li><a href="{{ route('social-provider','facebook') }}"><i class="fa fa-facebook-f"></i>Facebook</a></li>
					@endif
					@if(App\Models\Socialsetting::find(1)->g_check == 1)
					<li><a href="{{ route('social-provider','google') }}"><i class="fa fa-google"></i>Google</a></li>
					@endif
				</ul>
				@endif
				<div class="text-center">
					<a href="#register" class="link" data-bs-toggle="modal" data-bs-dismiss="modal">New user? Sign up here!</a>
				</div>
			</div>
		</div>
	</div>
</div>	
<div class="modal fade login_modal" id="register" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
			<div class="modal-body signup-form">
				<h2>Hello!</h2>
				<p>Please add your address information</p>
				@include('includes.admin.form-login')
                <form class="mregisterform" action="{{route('user-register-submit')}}" method="POST">
                  {{ csrf_field() }}
					<div class="form-group">
						<input type="text" class="User Name form-control" name="name" placeholder="Name*" required="">
					</div>
					<div class="form-group">
						<input type="email" class="User Name form-control" name="email" placeholder="Email" required="">
					</div>
					<div class="form-group">
						<input type="text" class="User Name form-control" name="phone" placeholder="Mobile" required="">
					</div>
					
					<div class="form-group">
						<input type="text" class="User Name form-control" name="address" placeholder="Address" required="">
					</div>
					<div class="form-group">
					<input type="password" class="Password form-control" name="password" placeholder="{{ $langg->lang186 }}"
                      required="">
					</div>
					<div class="form-group">
					<input type="password" class="Password form-control" name="password_confirmation"
                      placeholder="{{ $langg->lang187 }}" required="">
					</div>
					@if($gs->is_capcha == 1)

					<ul class="captcha-area">
						<li>
						<p><img class="codeimg1" src="{{asset("assets/images/capcha_code.png")}}" alt=""> <i
							class="fas fa-sync-alt pointer refresh_code "></i></p>
						</li>
					</ul>

					<div class="form-input">
						<input type="text" class="Password" name="codes" placeholder="{{ $langg->lang51 }}" required="">
						<i class="icofont-refresh"></i>
					</div>

					@endif

                  <input class="mprocessdata" type="hidden" value="{{ $langg->lang188 }}">
					
					<div class="form-group text-center">
						<input type="submit" class="btn" value="Ship to this address">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade login_modal" id="request_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			<div class="modal-body">
				<h2>Hello!</h2>
				<p>Please enter your details</p>
				<form id="contactform" action="{{route('front.requestcall.submit')}}" method="POST">
					{{csrf_field()}}
						@include('includes.admin.form-both') 
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Name" name="name"  required="">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Mobile number" name="phone"  required="">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="City" name="city"  required="">
					</div>
					<div class="form-group text-center">
						<input type="submit" class="btn" value="Continue">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade search_popup" id="search_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			<div class="modal-body">
				<p>what are you looking for?</p>
				<form id="searchForm" class="search-form" action="{{ route('front.category') }}" method="GET">
					<div class="form-group">
						<input type="text" id="prod_name" name="search" class="form-control" placeholder="Search..." value="{{ request()->input('search') }}" autocomplete="off">
						<button><i class="fa fa-search"></i></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>



@if($gs->is_popup== 1)
@if(isset($visited))
<div class="modal fade lp_modal" id="home_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
			<div class="modal-body">
				<div class="lp_wrapper">
					<div class="img_block">
						<img src="{{asset('assets/images/'.$gs->popup_background)}}" alt="">
					</div>
					<div class="copy_block">
						<h3>{{$gs->popup_title}} <span>{{$gs->popup_text}}</span></h3>
						<form action="{{route('front.subscribe')}}" id="subscribeform" method="POST">
							<div class="form-group">
							{{csrf_field()}}
								<input type="email" name="email" class="form-control" placeholder="Enter Your Email..." required>
								<button id="sub-btn" type="submit" value="Subscribe" class="btn">Subscribe</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	
@endif
@endif
	

<script type="text/javascript">
  var mainurl = "{{url('/')}}";
  var gs      = {!! json_encode(\App\Models\Generalsetting::first()->makeHidden(['stripe_key', 'stripe_secret', 'smtp_pass', 'instamojo_key', 'instamojo_token', 'paystack_key', 'paystack_email', 'paypal_business', 'paytm_merchant', 'paytm_secret', 'paytm_website', 'paytm_industry', 'paytm_mode', 'molly_key', 'razorpay_key', 'razorpay_secret'])) !!};
  var langg    = {!! json_encode($langg) !!};
</script>

<script type="text/javascript" src="{{asset('assets/front/js/jquery.min.js')}}"></script>	
<script type="text/javascript" src="{{asset('assets/front/js/bootstrap.bundle.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/js/owl.carousel.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/js/toastr.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/js/custom.js')}}"></script>

<script src="{{asset('assets/front/jquery-ui/jquery-ui.min.js')}}"></script>
<script>
	  $(window).on('load',function(){ 
		  setTimeout(function () { 
			  $('#home_modal').modal('show'); 
		  }, 100); 
		  $('body').trigger('click'); 
	  }); 
</script>	

    {!! $seo->google_analytics !!}

	@if($gs->is_talkto == 1)
		<!--Start of Tawk.to Script-->
		{!! $gs->talkto !!}
		<!--End of Tawk.to Script-->
	@endif

	@yield('scripts')

</body>

</html>
