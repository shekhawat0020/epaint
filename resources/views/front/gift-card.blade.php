@extends('layouts.front')
@section('content')


<section class="inner_page_wrapper">
		<div class="breadcrumb_section">
			<div class="container">
				<ul>
					<li><a href="{{ route('front.index') }}">Home</a></li>
					<li> Giftcards</li>
				</ul>
			</div>
		</div>
		<form id="gift-card-form" action="{{route('front.gift-card-add-cart')}}">
	
		{{csrf_field()}}
       
							
		<!-- start section 1 -->
		<div class="gc_wrapper" id="gift-step-1">
			<div class="container">
				<div class="heading">
					<h3>Gifting With E-cards</h3>
				</div>
				<div class="copy">
					<p>For this season, we’re celebrating a splendorous forest with our theme Van Vaibhav, and have three enchanting E-Gift Card designs to personalize and gift your loved ones.</p>
					<p>Select a design and denomination from below, fill in the required information and add it to the cart.</p>
					<p>After you check out, your E-Gift Card will automatically be emailed to the recipient, and ready for them to use.</p>
				</div>
				<h4>1. PICK A DESIGN</h4>
				<ul class="gift_list">
					<li>
						<label for="g1"><img src="{{asset('assets/front/images/giftcard.webp')}}" alt=""></label>
						<input type="radio" id="g1" name="card_type" checked value="Happy Bday Card">
					</li>
					<li>
						<label for="g2"><img src="{{asset('assets/front/images/giftcard.webp')}}" alt=""></label>
						<input type="radio" id="g2" name="card_type" value="Wedding Card">
					</li>
					<li>
						<label for="g3"><img src="{{asset('assets/front/images/giftcard.webp')}}" alt=""></label>
						<input type="radio" id="g3" name="card_type" value="Gift Card">
					</li>
				</ul>
				<div class="btn_wrap">
					<a href="javascript::void(0)" data-show="2"  class="btn gift-next-step">Choose Value</a>
				</div>
				<div class="down_arrow">
					<i class="fa fa-angle-down"></i>
				</div>
				
			</div>
		</div>

	<!-- end section 1 -->
	<!-- start section 2 -->

		<div class="gc_wrapper" id="gift-step-2" style="display:none">
			<div class="container">
				<div class="inner_wrap">
					<div class="down_arrow">
						<i class="fa fa-angle-up"></i>
					</div>
					<div class="back">
						<a href="javascript::void(0)" data-show="1"  class="gift-next-step">Back to Design</a>
					</div>
					<h4>2. CHOOSE A SHIPPING DESTINATION & VALUE</h4>
					<div class="country_select">
						<div class="styled_select">
							<select class="form-control" name="shipping_country">
								<option>Algeria</option>
								<option>Afghanistan</option>
								<option>Barbados</option>
								<option>Anguilla</option>
								<option>Bermuda</option>
								<option>Botswana</option>
								<option selected.>India</option>
							</select>
						</div>
						<p>Please note: Gift cards can only be redeemed in the currency they are bought in, so please choose the country based on your recipient's address</p>
					</div>	
					<ul class="nav nav-tabs" id="myTab">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" type="button">₹ 500</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" type="button">₹ 100</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" type="button">₹ 50</button>
                        </li>
                    </ul>
					<div class="choose_value">
						<p>(or choose your own value)</p>
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Enter value" name="gift_amount">
							<i class="fa fa-rupee"></i>
						</div>	
					</div>
					<div class="btn_wrap">
					<a href="javascript::void(0)" data-show="3"  class="btn gift-next-step">proceed to filling details</a>
					</div>
					<div class="down_arrow">
						<i class="fa fa-angle-down"></i>
					</div>
				</div>
				
			</div>
		</div>
	
	<!-- end section 2 -->
	<!-- start section 3 -->
	<div class="gc_wrapper" id="gift-step-3" style="display:none">
			<div class="container">
				
				<div class="inner_wrap">
					<div class="down_arrow">
						<i class="fa fa-angle-up"></i>
					</div>
					<div class="back">
					<a href="javascript::void(0)" data-show="2"  class="gift-next-step">Back to Value</a>
					</div>
					
					<div class="sender_form">
						<h4>3. FILL IN THE DETAILS</h4>
						<div class="form-group">
							<input type="text" placeholder="Name*" class="form-control" name="recipiant_name">
						</div>
						<div class="form-group">
							<input type="email" placeholder="Recipiant's Email*" class="form-control" name="recipiant_email">
						</div>
						<div class="form-group">
							<input type="email" placeholder="Confirm Recipiant's Email*" class="form-control" name="confirm_recipiant_email">
						</div>
						<div class="form-group">
							<textarea placeholder="Message" class="form-control" name="recipiant_message"></textarea>
						</div>
						<div class="form-group">
							<input type="text" placeholder="Sender's Name*" class="form-control" name="sender_name">
						</div>
						<div class="btn_wrap">
						<a href="javascript::void(0)" data-show="4"  class="btn gift-next-step">preview card</a>
						</div>
					</div>
					
					<div class="down_arrow">
						<i class="fa fa-angle-down"></i>
					</div>
				</div>
				
				
			</div>
		</div>
	<!-- end section 3 -->
	<!-- start section 4 -->
	<div class="gc_wrapper"  id="gift-step-4" style="display:none">
			<div class="container">
				
				
				<div class="inner_wrap">
					<div class="last_card">
						<div class="down_arrow">
							<i class="fa fa-angle-up"></i>
						</div>
						<div class="back">
						<a href="javascript::void(0)" data-show="3"  class="gift-next-step">Back to Details</a>
						</div>

						<div class="img_block">
							<img src="{{asset('assets/front/images/giftcard.webp')}}" alt="">
						</div>
						<ul class="msg_list">
							<li><span>Recipient Email:</span> sa@gmail.com</li>
							<li>Dear sa</li>
							<li>You have received a Good Earth eGift card <br>worth <strong>₹5000</strong> from sa</li>
							<li><span>Their message:</span> SA</li>
						</ul>
						<div class="coupon_block">
							<span>xxx xxx</span>
							<p>Apply this coupon code during checkout</p>
						</div>
						<div class="tnc_block">
							<h6>Please Note:</h6>
							<ul class="list-1">
								<li>All our gift cards are valid for a period of 11 months from date of purchase.</li>
							</ul>
							<div class="tnc">
								<input type="checkbox" id="tnc" name="term">
								<label for="tnc">I agree to the <a href="#">Terms and Conditions</a>. To know more how we keep your data safe, refer to our <a href="#">Privacy Policy</a></label>
							</div>
						</div>
						
						<div class="btn_wrap">
							<button type="submit" class="btn submit-btn">Add to bag</button>
						</div>
						<div class="down_arrow">
							<i class="fa fa-angle-down"></i>
						</div>
						@include('includes.admin.form-both') 
					</div>	
				</div>
				
			</div>
		</div>
		<!-- end section 4 -->
   
	
	
	
	
</form>
</section>



@endsection

@section('scripts')
<script>
$('.gift-next-step').click(function(){
	id = $(this).data('show');
	$('.gc_wrapper').hide();
	$('#gift-step-'+id).show();

});

$('#gift-card-form').submit(function(e){

	e.preventDefault();
    $('button.submit-btn').prop('disabled',true);
	$.ajax({
           method:"POST",
           url:$(this).prop('action'),
           data:new FormData(this),
           contentType: false,
           cache: false,
           processData: false,
           success:function(data)
           {
              if ((data.errors)) {
              $('.alert-success').hide();
              $('.alert-danger').show();
              $('.alert-danger ul').html('');
                for(var error in data.errors)
                {
                  $('.alert-danger ul').append('<li>'+ data.errors[error] +'</li>')
                }
              
              }
              else
              {
                $('.alert-danger').hide();
                $('.alert-success').show();
                $('.alert-success p').html(data);
               

              }
              
              $('button.submit-btn').prop('disabled',false);
           }

          });

});

</script>

@endsection