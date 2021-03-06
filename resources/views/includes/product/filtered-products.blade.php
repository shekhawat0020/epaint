@if (count($prods) > 0)
	@foreach ($prods as $key => $prod)
		<div class="col-4">
			<div class="product_block">
				<div class="img_block">
				<a href="{{ route('front.product', $prod->slug) }}"><img src="{{ $prod->thumbnail ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" alt=""></a>
					@if(Auth::guard('web')->check())
					<a href="javascript::void(0)" data-href="{{ route('user-wishlist-add',$prod->id) }}"  class="wishlist add-to-wish"><i class="fa fa-heart"></i></a>
					@endif

					@if($prod->product_type == "affiliate")
					<a href="javascript::void(0)" class="cart_btn add-to-cart-btn affilate-btn"><i class="fa fa-shopping-cart"></i>{{ $langg->lang251 }}</a>
					@else

					<a href="javascript::void(0)" data-href="{{ route('product.cart.add',$prod->id) }}" class="cart_btn add-to-cart add-to-cart-btn"><i class="fa fa-shopping-cart"></i>Add to Cart</a>

					@endif



				</div>	
				<a href="{{ route('front.product', $prod->slug) }}" class="title">{{ $prod->name }}</a>
				<p class="price">{{ $prod->setCurrency() }} <del><small>{{ $prod->showPreviousPrice() }}</small></del></p>
			</div>
		</div>
	@endforeach	
	<div class="col-12 loading_list"  style="visibility: hidden;">
		<ul>
			<li class="spinner-grow text-primary" role="status">
				<span class="visually-hidden"></span>
			</li>
			<li class="spinner-grow text-secondary" role="status">
				<span class="visually-hidden"></span>
			</li>
			<li class="spinner-grow text-success" role="status">
				<span class="visually-hidden"></span>
			</li>
			<li class="spinner-grow text-danger" role="status">
				<span class="visually-hidden"></span>
			</li>
			<li class="spinner-grow text-warning" role="status">
				<span class="visually-hidden"></span>
			</li>
		</ul>
		<p>Loading...</p>
	</div>
	<div class="col-lg-12 paginglist" style="visibility: hidden;">
		<div class="page-center mt-5">
			{!! $prods->appends(['search' => request()->input('search')])->links() !!}
		</div>
	</div>	
@else
	<div class="col-lg-12">
	<div class="page-center">
	<h4 class="text-center">No Product found</h4>
	</div>
	</div>
@endif