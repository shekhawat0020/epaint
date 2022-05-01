@extends('layouts.front')

@section('content')



<section class="inner_page_wrapper">
		<div class="breadcrumb_section">
			<div class="container">
				<ul>
					<li><a href="{{ route('front.index') }}">Home</a></li>
					<li> Login</li>
				</ul>
			</div>
		</div>

   
<div class="card" id="login">
	<div class="modal-dialog">
		<div class="card-content">
			<div class="card-body signin-form">
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
  
  
  </section>




@endsection