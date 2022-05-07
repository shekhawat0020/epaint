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
              <a href="{{ route('front.blog') }}">
                {{ $langg->lang18 }}
              </a>
            </li>
            <li>
              <a href="{{ route('front.blogshow',$blog->id) }}">
              {{ $blog->title }}
              </a>
            </li>
				</ul>
			</div>
		</div>
		
		<div class="blog_wrapper">
			<div class="container">
				<div class="heading">
					<h3>   {{ $blog->title }}</h3>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="blog_detail">
                            <p class="date"> {{ date('M d, Y',strtotime($blog->created_at)) }}</p>
							<div class="img_block">
								<img src="{{ asset('assets/images/blogs/'.$blog->photo) }}" alt="">
							</div>

              {!! $blog->details !!}
            
            </div>
						<ul class="share_list">
                            <li>Share:</li>
                            <li><a class="facebook a2a_button_facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-whatsapp"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                        </ul>
                        <script async src="https://static.addtoany.com/menu/page.js"></script>
					</div>
				</div>
			</div>
		</div>
	</section>
	




@endsection
