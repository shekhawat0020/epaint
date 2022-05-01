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
									<a data-toggle="modal" data-target="#ma_edit" class="btn">Edit Information</a>
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
									<div class="row delvery_address">
										<div class="col-6">
											<div class="address_block">
												<div class="add_inner">
													<p>XYZ Kumar</p>
													<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
													<div class="float-left">
														<p>1023456789</p>
													</div>
													<ul class="edit_list">
														<li><a href="#"><i class="fa fa-edit"></i></a></li>
														<li><a href="#"><i class="fa fa-trash-o"></i></a></li>
													</ul>
												</div>
											</div>
										</div>
										<div class="col-6">
											<div class="address_block">
												<div class="add_inner">
													<p>XYZ Kumar</p>
													<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
													<div class="float-left">
														<p>1023456789</p>
													</div>
													<ul class="edit_list">
														<li><a href="#"><i class="fa fa-edit"></i></a></li>
														<li><a href="#"><i class="fa fa-trash-o"></i></a></li>
													</ul>
												</div>
											</div>
										</div>
										<div class="col-12">
											<a href="#address_popup" data-toggle="modal" class="btn">Add Another Address</a>
										</div>
									</div>
								</div>	
							</div>
						</div>
					</div>	
				</div>
    		</div>
		</div>
	</section>
	



@endsection