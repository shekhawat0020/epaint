@extends('layouts.front')

@section('content')
<section class="inner_page_wrapper">
		<div class="breadcrumb_section">
			<div class="container">
				<ul>
				<li>
					<a href="{{ route('front.index') }}">
						{{ $langg->lang17 }}
					</a>
				</li>
				<li>
					<a href="{{ route('user-wishlists') }}">
						{{ $langg->lang168 }}
					</a>
				</li>
				</ul>
			</div>
		</div>
		<div class="shoppingcart_section wishlist_section">
			<div class="container">
           		<div class="heading">
					<h3>Wishlist ({{count($wishlists)}})</h3>
				</div>
				<ul class="wishlist2">
				@if(count($wishlists))
				@foreach($wishlists as $wishlist)
					<li>
						<div class="inner">
							<div class="product_img">
								<img src="{{ $wishlist->product->photo ? asset('assets/images/products/'.$wishlist->product->photo):asset('assets/images/noimage.png') }}" alt="">
							</div>
							<div class="copy_block">
								<a href="{{ route('front.product', $wishlist->product->slug) }}" class="title">{{ $wishlist->product->name }}</a>
								<p class="rating"><span>{{App\Models\Rating::ratings($wishlist->product->id)}}*</span> ({{ count($wishlist->product->ratings) }})</p>
								<p class="price">{{ $wishlist->product->showPrice() }}<small><del>{{ $wishlist->product->showPreviousPrice() }}</del></small></p>
							</div>
							<a href="javascript::void(0)" class="del remove wishlist-remove"  data-href="{{ route('user-wishlist-remove',$wishlist->id) }}"><i class="fa fa-trash-o"></i></a>
						</div>	
					</li>
					@endforeach
					@else

					<li class="page-center">
						<h4 class="text-center">{{ $langg->lang60 }}</h4>
					</li>

					@endif
					
				</ul>
    		</div>
		</div>
	</section>
	



@endsection

@section('scripts')

<script type="text/javascript">
        $("#sortby").on('change',function () {
        var sort = $("#sortby").val();
        window.location = "{{url('/user/wishlists')}}?sort="+sort;
    	});
</script>

@endsection
