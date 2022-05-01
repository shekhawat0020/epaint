@extends('layouts.front')
@section('content')


<section class="inner_page_wrapper">
		<div class="breadcrumb_section">
			<div class="container">
				<ul>
					<li><a href="{{ route('front.index') }}">Home</a></li>
					<li> {{ $page->title }}</li>
				</ul>
			</div>
		</div>

    {!! $page->details !!}

    </section>



@endsection