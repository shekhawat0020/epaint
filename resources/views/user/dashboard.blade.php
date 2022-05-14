@extends('layouts.front')
@section('content')


<section class="inner_page_wrapper">
		<div class="shoppingcart_section profile_section">
			<div class="container">
				<div class="ma_wrap">
					<div class="inner">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item" role="presentation">
								<button class="nav-link active" data-bs-toggle="tab" data-bs-target="#home" type="button">Account Information</button>
							</li>
							<!--<li class="nav-item" role="presentation">
								<button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile" type="button">Change Password</button>
							</li>-->
							<li class="nav-item" role="presentation">
								<button class="nav-link" data-bs-toggle="tab" data-bs-target="#contact" type="button">My Order</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" data-bs-toggle="tab" data-bs-target="#address" type="button">Address Book</button>
							</li>
						</ul>
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="home">
								<div class="ma_inner">
									<h2>Account Information</h2>
									<ul class="ma_list">
										<li><span>Name</span> {{ $user->name }}</li>
										<li><span>Email</span> {{ $user->email }}</li>
                    @if($user->phone != null)
										<li><span>Mobile</span> {{ $user->phone }}</li>
                    @endif
                    @if($user->address != null)
										<li><span>Address</span> {{ $user->address }}</li>
                    @endif
									</ul>
									<a data-bs-toggle="modal" href="#ma_edit" class="btn">Edit Information</a>
								</div>
							</div>
							<!--<div class="tab-pane fade" id="profile">
								<div class="ma_inner">
									<h2>Change Password</h2>
									<div class="row">
										<div class="col-6">
											<form>
												<div class="form-group">
													<input type="password" class="form-control" placeholder="New Password*">
												</div>
												<div class="form-group">
													<input type="password" class="form-control" placeholder="Confirm New Password*">
												</div>
												<div class="form-group">
													<input type="submit" class="btn" value="Chnage Password">
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>-->
							<div class="tab-pane fade" id="contact">
								<div class="ma_inner">
									<h2>My Order</h2>
									<div class="table-responsive">
										<table class="table table-striped table-bordered">
											<thead>
												<tr>
													<th>Order ID</th>
													<th>Date </th>
													<th>Total</th>
                          <th>Order Status</th>
													<th>&nbsp;</th>
												</tr>
											</thead>
											<tbody>
                      @foreach($orders as $order)
												<tr>
													<td>{{$order->order_number}}</td>
													<td>{{date('d M Y',strtotime($order->created_at))}}</td>
													<td>{{$order->currency_sign}}{{ round($order->pay_amount * $order->currency_value , 2) }}</td>
													<td>
                          <div class="order-status {{ $order->status }}">
																	{{ucwords($order->status)}}
															</div>
                          </td>
													<td><a href="{{route('user-order',$order->id)}}" class="btn"><i class="fa fa-eye"></i> View</a></td>
												</tr>
                      @endforeach
												
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="address">
								<div class="ma_inner">
									<h2>Address Book</h2>
									<div class="row delvery_address" id="delvery_address_box">
										
									</div>	
										<div class="col-12">
											<a href="#address_popup" data-bs-toggle="modal" class="btn">Add Another Address</a>
										</div>
									
								</div>	
							</div>
						</div>
					</div>	
				</div>
    		</div>
		</div>
	</section>



<!--- Start profile edit  Pop  -->

<div class="modal fade login_modal" id="ma_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			<div class="modal-body">
				<h2>Edit Account Information!</h2>
				<p>Please enter your details</p>
				<form  id="userform" action="{{route('user-profile-update')}}" method="POST"
                                            enctype="multipart/form-data">
					{{csrf_field()}}
						@include('includes.admin.form-both') 
					<div class="form-group">
					<input name="name" type="text" class="form-control"
                                                        placeholder="{{ $langg->lang264 }}" required=""
                                                        value="{{ $user->name }}">
					</div>
					<div class="form-group">
					<input name="email" type="email" class="form-control"
                                                        placeholder="{{ $langg->lang265 }}" required=""
                                                        value="{{ $user->email }}" disabled>
					</div>
					<div class="form-group">
					<input name="phone" type="text" class="form-control"
                                                        placeholder="{{ $langg->lang266 }}" required=""
                                                        value="{{ $user->phone }}">
					</div>
					<div class="form-group">
					<input name="city" type="text" class="form-control"
                                                        placeholder="{{ $langg->lang268 }}" value="{{ $user->city }}">
					</div>
					<div class="form-group">
					<select class="form-control" name="country">
                                                        <option value="">{{ $langg->lang157 }}</option>
                                                        @foreach (DB::table('countries')->get() as $data)
                                                            <option value="{{ $data->country_name }}" {{ $user->country == $data->country_name ? 'selected' : '' }}>
                                                                {{ $data->country_name }}
                                                            </option>		
                                                         @endforeach
                                                    </select>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="State" name="state"  value="{{ $user->state }}"  required="">
					</div>

					<div class="form-group">
						 <input name="zip" type="text" class="form-control"
                                                                placeholder="{{ $langg->lang269 }}" value="{{ $user->zip }}">
					</div>
					<div class="form-group">
					<textarea class="form-control" name="address" required=""
                                                        placeholder="{{ $langg->lang270 }}">{{ $user->address }}</textarea>
					</div>
					
					<div class="form-group text-center">
						<input type="submit" class="btn submit-btn" value="Update">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<!--- End profile edit  Pop  -->
<!--- Start Address Pop  -->

<div class="modal fade login_modal" id="address_popup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			<div class="modal-body">
				<h2>Edit Account Information!</h2>
				<p>Please enter your details</p>
				<form  id="userAddressform" action="{{route('user-add-address')}}" method="POST"
                                            enctype="multipart/form-data">
					{{csrf_field()}}
						@include('includes.admin.form-both') 
					<div class="form-group">
					<input name="name" type="text" class="form-control"
                                                        placeholder="{{ $langg->lang264 }}" required=""
                                                        >
					</div>
					
					<div class="form-group">
					<input name="phone" type="text" class="form-control"
                                                        placeholder="{{ $langg->lang266 }}" required=""
                                                        >
					</div>
					<div class="form-group">
					<input name="city" type="text" class="form-control"
                                                        placeholder="{{ $langg->lang268 }}">
					</div>
					<div class="form-group">
					<select class="form-control" name="country">
                                                        <option value="">{{ $langg->lang157 }}</option>
                                                        @foreach (DB::table('countries')->get() as $data)
                                                            <option value="{{ $data->country_name }}" {{ $user->country == $data->country_name ? 'selected' : '' }}>
                                                                {{ $data->country_name }}
                                                            </option>		
                                                         @endforeach
                                                    </select>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="State" name="state"   required="">
					</div>

					<div class="form-group">
						 <input name="zip" type="text" class="form-control"
                                                                placeholder="{{ $langg->lang269 }}">
					</div>
					<div class="form-group">
					<textarea class="form-control" name="address" required=""
                                                        placeholder="{{ $langg->lang270 }}"></textarea>
					</div>
					
					<div class="form-group text-center">
						<input type="submit" class="btn submit-btn" value="Update">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- End address pop -->



@endsection


@section('scripts')

<script>

//user delivery address load
function loadaddress(){

$('#delvery_address_box').load("{{route('user-get-address')}}", function (response, status, xhr) {
         if (status == "success") {
           $('#preloader').hide();
           
       }
  });
}
loadaddress();
</script>

@endsection