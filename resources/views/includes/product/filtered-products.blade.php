@if (count($prods) > 0)
	@foreach ($prods as $key => $prod)
		<div class="col-4">
			<div class="product_block">
				<div class="img_block">
					<img src="{{ $prod->thumbnail ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" alt="">
					@if(Auth::guard('web')->check())
					<a href="javascript::void(0)" data-href="{{ route('user-wishlist-add',$prod->id) }}"  class="wishlist add-to-wish"><i class="fa fa-heart"></i></a>
					@endif

					@if($prod->product_type == "affiliate")
					<a href="javascript::void(0)" class="cart_btn add-to-cart-btn affilate-btn"><i class="fa fa-shopping-cart"></i>{{ $langg->lang251 }}</a>
					@else

						@if($prod->emptyStock())
						<a href="javascript::void(0)" data-href="{{ route('product.cart.add',$prod->id) }}" class="cart_btn add-to-cart add-to-cart-btn"><i class="fa fa-shopping-cart"></i>{{ $langg->lang56 }}</a>
						@else
						<a href="javascript::void(0)" data-href="{{ route('product.cart.quickadd',$prod->id) }}" class="cart_btn add-to-cart-quick add-to-cart-btn"><i class="fa fa-shopping-cart"></i>Add to Cart</a>
						@endif

					@endif



				</div>	
				<a href="{{ route('front.product', $prod->slug) }}" class="title">palem cotton ivory multi quilted bespread</a>
				<p class="price">{{ $prod->setCurrency() }} <del><small>{{ $prod->showPreviousPrice() }}</small></del></p>
			</div>
		</div>
	@endforeach		
@else
	<div class="col-lg-12">
	<div class="page-center">
	<h4 class="text-center">No Product found</h4>
	</div>
	</div>
@endif