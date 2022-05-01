@extends('layouts.front')

@section('content')

<section class="inner_page_wrapper">
		<div class="breadcrumb_section">
			<div class="container">
				<ul>
					<li><a href="{{ route('front.index') }}">Home</a></li>
					<li>  {{ $langg->lang190 }}</li>
				</ul>
			</div>
		</div>




<div class="login-signup forgot-password">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="login-area">
                    <div class="header-area forgot-passwor-area">
                        <h4 class="title">{{ $langg->lang191 }} </h4>
                        <p class="text">{{ $langg->lang192 }} </p>
                    </div>
                    <div class="login-form">
                        @include('includes.admin.form-login')
                        <form id="forgotform" action="{{route('user-forgot-submit')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="email" name="email" class="User Name form-control" placeholder="{{ $langg->lang193 }}"
                                    required="">
                            </div>
                            <div class="to-login-page">
                                <a href="{{ route('user.login') }}">
                                    {{ $langg->lang194 }}
                                </a>
                            </div>
                            <input class="authdata" type="hidden" value="{{ $langg->lang195 }}">
                            <button type="submit" class="submit-btn btn">{{ $langg->lang196 }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection