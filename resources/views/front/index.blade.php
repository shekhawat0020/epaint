
@extends('layouts.front')
@section('content')	

@if($ps->slider == 1)
@if(count($sliders))
	<section class="banner_section">
		<div id="home-banner" class="carousel carousel-dark carousel-fade slide" data-bs-ride="carousel">
			<div class="carousel-indicators">
			@foreach($sliders as $key => $data)	
				<button class="@if($key==0)active @endif" type="button" data-bs-target="#home-banner" data-bs-slide-to="{{$key}}" aria-current="true" aria-label="Slide {{$key}}">
				{{$data->title_text}}<span>{{$data->subtitle_text}}</span>
				</button>
			@endforeach		
			</div>
			<div class="carousel-inner">
			@foreach($sliders as $key => $data)
				<div class="carousel-item @if($key==0)active @endif">
					<picture>
						<source srcset="{{asset('assets/images/sliders/'.$data->photo)}}" media="(min-width:1023px)">
						<source srcset="{{asset('assets/images/sliders/'.$data->photo)}}" media="(min-width:320px)">
						<img src="{{asset('assets/images/sliders/'.$data->photo)}}" alt="">
					</picture>
				</div>
			@endforeach	
			</div>
		</div>
		
		<div id="myDots" class="owl-dots"></div>
		<div class="banner_caption">
			<div class="container">
				<h3>LIMITED COLLECTIONS</h3>
				<h1>Curated selections of exquisite <br>items from our store</h1>
			</div>
		</div>
	</section>
@endif	
@endif	

@if($ps->featured_category == 1)
	<section class="products_section">
		<div class="container">
			<div class="row">
			@foreach($categories->where('is_featured','=',1)->take(5) as $ckey => $cat)
				@if($ckey == 0)
				<div class="col-6">
					<div class="product_wrap">
						<img src="{{asset('assets/images/categories/'.$cat->image) }}" alt="">
						<div class="overlay">
							<h3><a href="{{ route('front.category',$cat->slug) }}">{{ $cat->name }}</a></h3>
							<ul class="list_normal list_2column">
							@foreach($cat->subs()->whereStatus(1)->take(5)->get() as $subcat)
								<li><a href="{{ route('front.subcat',['slug1' => $cat->slug, 'slug2' => $subcat->slug]) }}">{{ $subcat->name }}</a></li>
							@endforeach
							</ul>
						</div>
					</div>
				</div>
				@endif
				@if($ckey > 0 && $ckey <= 3)
				<div class="col-3">
					<div class="product_wrap">
						<img src="{{asset('assets/images/categories/'.$cat->image) }}" alt="">
						<div class="overlay">
							<h3><a href="{{ route('front.category',$cat->slug) }}">{{ $cat->name }}<span>{{ count($cat->products) }} products</span></a></h3>
						</div>
					</div>
				</div>
				@endif
				
				@if($ckey == 4)
				<div class="col-3">
					<div class="product_wrap black">
						<img src="{{asset('assets/front/images/home-4.webp')}}" alt="">
						<div class="overlay">
							<h6>BROWSE MORE:</h6>
							<ul class="list_normal">
							@foreach($categories->where('is_featured','=',1)->skip(5)->take(5) as $cat1)
								<li><a href="{{ route('front.category',$cat1->slug) }}">{{ $cat1->name }}</a></li>
							@endforeach
							</ul>
						</div>
					</div>
				</div>
				

				<div class="col-6">
					<div class="product_wrap">
						<img src="{{asset('assets/images/categories/'.$cat->image) }}" alt="">
						<div class="overlay">
							<h3><a href="{{ route('front.category',$cat->slug) }}">{{ $cat->name }}<span>{{ count($cat->products) }} products</span></a></h3>
						</div>
					</div>
				</div>
			@endif
			@endforeach

			</div>
		</div>
	</section>
@endif	
	
	

	<section class="collection_section1">
		<div class="container">
			<div class="row">
				<div class="col-9">
					<div class="row">
						<div class="col-12">
							<div class="collection_wrap">
								<div class="owl-carousel collection_carousel">
									<div class="item">
										<img src="{{asset('assets/front/images/collection-big.webp')}}" alt="">
									</div>
									<div class="item">
										<img src="{{asset('assets/front/images/collection-big02.webp')}}" alt="">
									</div>
									<div class="item">
										<img src="{{asset('assets/front/images/collection-big03.webp')}}" alt="">
									</div>
								</div>
							</div>	
						</div>
					</div>
				</div>
				<div class="col-3">
					<div class="sidebar_item">
						<div class="make_me_sticky">
							<div class="inner">
								<div class="copy_block">
									<h3>LEXINGTON0 <br>COLLECTION</h3>
									<p>We’ve gone to great lengths to bring you some fabulous furniture ranges to create your perfect bedroom.</p>
									<a href="#" class="btn">Discover More</a>
								</div>	
							</div>
						</div>
					</div>
				</div>
				<div class="col-12">
                    <ul class="line_icon">
                        <li>
                            <div class="icon">
                                <img src="{{asset('assets/front/images/New_icons-1.webp')}}" alt="">
                            </div>
                            <p>Hancrafted with Love</p>
                        </li>
                        <li>
                            <div class="icon">
                                <img src="{{asset('assets/front/images/New_icons-2.webp')}}" alt="">
                            </div>
                            <p>Celebrating Indian Heritage</p>
                        </li>
                        <li>
                            <div class="icon">
                                <img src="{{asset('assets/front/images/New_icons-3.webp')}}" alt="">
                            </div>
                            <p>Pocket Friendly</p>
                        </li>
                        <li>
                            <div class="icon">
                                <img src="{{asset('assets/front/images/New_icons-4.webp')}}" alt="">
                            </div>
                            <p>Pure Quality, Pure Satisfaction</p>
                        </li>
                    </ul>
                </div>
			</div>
		</div>
	</section>
	
	<section class="collection_section2">
		<div class="owl-carousel collection_carousel2">
			<div class="item">
				<img src="{{asset('assets/front/images/calypso-collection01.webp')}}" alt="">
			</div>
			<div class="item">
				<img src="{{asset('assets/front/images/calypso-collection02.webp')}}" alt="">
			</div>
			<div class="item">
				<img src="{{asset('assets/front/images/calypso-collection01.webp')}}" alt="">
			</div>
			<div class="item">
				<img src="{{asset('assets/front/images/calypso-collection02.webp')}}" alt="">
			</div>
		</div>
	@if($ps->best == 1)
		<div class="container">
			<div class="row">
				<div class="col-12 mt-5">
                    <div class="heading">
                        <h2>Best Selling Products</h2>
                    </div>
					<div class="owl-carousel rp_carousel">
					@foreach($best_products as $prod)
						<a href="{{ route('front.product', $prod->slug) }}" class="item">
							<div class="img_block">
								<img src="{{ $prod->thumbnail ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" alt="">
							</div>
							<h3>{{ $prod->showName() }}</h3>
						</a>
					@endforeach
					</div>
                </div>
			</div>
		</div>
	@endif

	@if($ps->featured == 1)
		<div class="container">
			<div class="row">
				<div class="col-12 mt-5">
                    <div class="heading">
                        <h2>Featured Product</h2>
                    </div>
					<div class="owl-carousel rp_carousel">
					@foreach($feature_products as $prod)
						<a href="{{ route('front.product', $prod->slug) }}" class="item">
							<div class="img_block">
								<img src="{{ $prod->thumbnail ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" alt="">
							</div>
							<h3>{{ $prod->showName() }}</h3>
						</a>
					@endforeach
					</div>
                </div>
			</div>
		</div>
	@endif
	</section>
	
	<section class="bts_section">
		<div class="container">
			<div class="row">
                <div class="col-12">
                    <div class="heading mt-5">
                        <h2>Our Social Posts</h2>
                    </div>
                </div>
				@foreach (App\Models\Blog::orderBy('created_at', 'desc')->limit(4)->get() as $blog)
                <div class="col-3">
                    <a href="{{ route('front.blogshow',$blog->id) }}" class="social_post">
                        <img src="{{ asset('assets/images/blogs/'.$blog->photo) }}" alt="">
                        <i class="fa">{{mb_strlen($blog->title,'utf-8') > 45 ? mb_substr($blog->title,0,45,'utf-8')." .." : $blog->title}}</i>
                    </a>
                </div>
				@endforeach
			</div>
		</div>
	</section>
	
@endsection	


	
