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




	@yield('styles')

</head>

<body>

@if($gs->is_loader == 1)
	<div class="preloader" id="preloader" style="background: url({{asset('assets/images/'.$gs->loader)}}) no-repeat scroll center center #FFF;"></div>
	@endif
<div class="xloader d-none" id="xloader" style="background: url({{asset('assets/front/images/xloading.gif')}}) no-repeat scroll center center #FFF;"></div>

<header class="inner_page_header">
		<div class="container">
			<div class="logo">
				<a href="{{ route('front.index') }}" class="white_logo"><img src="{{asset('assets/images/'.$gs->logo)}}" alt=""></a>
				<a href="{{ route('front.index') }}" class="dark_logo"><img src="{{asset('assets/images/'.$gs->logo)}}" alt=""></a>
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
					<li><a href="{{ route('front.index') }}">Home Story</a></li>
				@endif				
				<li class="dropdown">
					<a href="" class="dropdown-toggle" data-bs-toggle="dropdown">collaboration</a>
					<ul class="dropdown-menu">
					@foreach($categories as $category)
					<li><a class="dropdown-item" href="{{ route('front.category',$category->slug) }}">{{ $category->name }}</a></li>
					@endforeach
					</ul>
				</li>
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
							<i class="fa fa-heart-o"></i><span>{{ Auth::user()->wishlistCount() }}</span>
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
						<a href="{{ route('front.checkout') }}">
							<i class="fa fa-shopping-cart"></i><span>{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}</span>
							<b>Cart</b>
						</a>
					</li>
					<li class="req_call">
						<a href="tel:9087 654 321" class="mobile_phone"><i class="fa fa-phone"></i></a>
						<span>+91 9087 654 321</span>
						<a href="#request_modal" data-bs-toggle="modal" class="link">Request a call</a>
					</li>
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
					<h3>FOOTER LINKS</h3>
                    <ul class="footer_list">
                        <li><a href="{{ route('front.index') }}">Home</a></li>
                        @foreach(DB::table('pages')->where('footer','=',1)->get() as $data)
						<li><a href="{{ route('front.page',$data->slug) }}">{{ $data->title }}</a></li>
						@endforeach
                    </ul>
				</div>
				<div class="col-2">
					<h3>HELP</h3>
                    <ul class="footer_list">
						<li><a href="{{ route('front.index') }}">Home</a></li>
                        @foreach(DB::table('pages')->where('footer','=',1)->get() as $data)
						<li><a href="{{ route('front.page',$data->slug) }}">{{ $data->title }}</a></li>
						@endforeach
                    </ul>
				</div>
				<div class="col-2">
					<h3>HELP</h3>
                    <ul class="footer_list">
						<li><a href="{{ route('front.index') }}">Home</a></li>
                        @foreach(DB::table('pages')->where('footer','=',1)->get() as $data)
						<li><a href="{{ route('front.page',$data->slug) }}">{{ $data->title }}</a></li>
						@endforeach
                    </ul>
				</div>
				<div class="col-2">
					<div class="newsletter">
						<h4>RECEIVE EMAIL UPDATES</h4>
						<div class="form-group">
							<input type="email" class="form-control" placeholder="Your email address">
							<button>JOIN</button>
						</div>	
					</div>
					<ul class="social_list">
					@if($socialsetting->f_status == 1)
                        <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
					@endif
					@if($socialsetting->g_status == 1)
                        <li class="instagram"><a href="{{ $socialsetting->gplus }}"><i class="fa fa-instagram"></i></a></li>
					@endif
					@if($socialsetting->t_status == 1)
                        <li class="instagram"><a href="{{ $socialsetting->twitter }}"><i class="fa fa-instagram"></i></a></li>
					@endif
					@if($socialsetting->l_status == 1)
                        <li class="instagram"><a href="{{ $socialsetting->linkedin }}"><i class="fa fa-instagram"></i></a></li>
					@endif
					@if($socialsetting->d_status == 1)
                        <li class="instagram"><a href="{{ $socialsetting->dribble }}"><i class="fa fa-instagram"></i></a></li>
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
			<div class="modal-body">
				<h2>Hello!</h2>
				<p>Please enter your details</p>
				<form>
					<div class="form-group">
						<input type="email" class="form-control" placeholder="Email/Mobile number">
					</div>
					<div class="form-group">
						<input type="password" class="form-control" placeholder="Password">
					</div>
					<div class="form-group text-end">
						<a href="#" class="link">Forgot Password?</a>
					</div>
					<div class="form-group text-center">
						<input type="button" class="btn" value="Continue">
					</div>
				</form>
				<h3>Or login with</h3>
				<ul class="social_login">
					<li><a href="#"><i class="fa fa-facebook-f"></i>Facebook</a></li>
					<li><a href="#"><i class="fa fa-google"></i>Google</a></li>
				</ul>
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
			<div class="modal-body">
				<h2>Hello!</h2>
				<p>Please add your address information</p>
				<form>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Name*">
					</div>
					<div class="form-group">
						<input type="email" class="form-control" placeholder="Email/Mobile number">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Mobile">
						<a href="#" class="otp">Send OTP</a>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Enter OTP*">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Flat / House no. / Floor / Building**">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Colony / Street / Locality**">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Pincode*">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="City*">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="State*">
					</div>
					<div class="form-group">
						<div class="styled_select">
							<select class="form-control">
								<option selected>Country</option>
								<option>India</option>
							</select>
						</div>
					</div>
					<div class="form-group text-center">
						<input type="button" class="btn" value="Ship to this address">
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
				<form>
					<div class="form-group">
						<input type="email" class="form-control" placeholder="Name">
					</div>
					<div class="form-group">
						<input type="email" class="form-control" placeholder="Mobile number">
					</div>
					<div class="form-group">
						<input type="email" class="form-control" placeholder="City">
					</div>
					<div class="form-group text-center">
						<input type="button" class="btn" value="Continue">
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
						<img src="{{asset('assets/front/images/popup-img.webp')}}" alt="">
					</div>
					<div class="copy_block">
						<h3>{{$gs->popup_title}} <span>{{$gs->popup_text}}</span></h3>
						<form action="{{route('front.subscribe')}}" id="subscribeform" method="POST">
							<div class="form-group">
							{{csrf_field()}}
								<input type="email" name="email" class="form-control" placeholder="Enter Your Email..." required>
								<button id="sub-btn" type="button" value="Subscribe" class="btn">Subscribe</button>
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
<script type="text/javascript" src="{{asset('assets/front/js/custom.js')}}"></script>
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
