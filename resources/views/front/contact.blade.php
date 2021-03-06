@extends('layouts.front')
@section('styles')
<link rel="stylesheet" href="{{asset('assets/front/css/chosen.css')}}">
@endsection
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
                        <a href="{{ route('front.contact') }}">
                        Contact US
                        
                        </a>
                    </li>
				</ul>
			</div>
		</div>
		<div class="shoppingcart_section join_section">
			<div class="banner">
                <picture>
                    <source srcset="{{asset('assets/front/images/reseller-banner.webp')}}" media="(min-width:1023px)">
                    <source srcset="{{asset('assets/front/images/reseller-banner.webp')}}" media="(min-width:320px)">
                    <img src="{{asset('assets/front/images/reseller-banner.webp')}}" alt="">
                </picture>
            </div>
			<div class="container">
				
				<div class="row">
					<div class="col-6">
						<div id="output"></div>
						
						<div class="bulk">
							<div class="heading">
                            {!! $ps->contact_title !!}
                           
                               
							</div>
                            {!! $ps->contact_text !!}
                            <form id="contactform" action="{{route('front.contact.submit')}}" method="POST">
                                {{csrf_field()}}
                                    @include('includes.admin.form-both') 
							

							<div class="form-group">
								<input type="text" class="form-control" placeholder="Name" name="name" required="">
							</div>
                            <div class="form-group">
								<input type="email" class="form-control" placeholder="Email" name="email" required="">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Contact No." name="phone" required="">
							</div>
							<div class="form-group">
								<textarea class="form-control" placeholder="Comments" name="text" required=""></textarea>
							</div>
							
                            <input type="hidden" name="to" value="{{ $ps->contact_email }}">
							<div class="form-group">
								<input type="submit" class="btn" value="Submit">
							</div>
                            </form>
						</div>
					</div>
				</div>
    		</div>
		</div>
	</section>
	



@endsection

@section('scripts')
<script type="text/javascript" src="{{asset('assets/front/js/chosen.jquery.js')}}"></script>
<script id="rendered-js" >
document.getElementById('output').innerHTML = location.search;
$(".chosen-select").chosen();
//# sourceURL=pen.js
    </script>
@endsection