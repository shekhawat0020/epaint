@extends('layouts.front')
@section('content')

<section class="inner_page_wrapper">
		<div class="breadcrumb_section">
			<div class="container">
				<ul>
        @if(isset($bcat))
                
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
                  <a href="{{ route('front.blogcategory',$bcat->slug) }}">
                    {{ $bcat->name }}
                  </a>
                </li>
  
            @elseif(isset($slug))
  
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
                  <a href="{{ route('front.blogtags',$slug) }}">
                    {{ $langg->lang35 }}: {{ $slug }}
                  </a>
                </li>
  
            @elseif(isset($search))
                  
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
                  <a href="Javascript:;">
                    {{ $langg->lang36 }}
                  </a>
                </li>
                <li>
                  <a href="Javascript:;">
                    {{ $search }}
                  </a>
                </li>
  
            @elseif(isset($date))
                  
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
                  <a href="Javascript:;">
                    {{ $langg->lang37 }}: {{ date('F Y',strtotime($date)) }}
                  </a>
                </li>
  
            @else
                  
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
            @endif
				</ul>
			</div>
		</div>
		
		<div class="blog_wrapper">
			<div class="container">
				<div class="heading">
					<h2>Blogs</h2>
				</div>
				<div class="row">
					
        @foreach($blogs as $blogg)
        <div class="col-3">
						<div class="collection_wrap">
                            <a href="{{route('front.blogshow',$blogg->id)}}" class="img_block">
                                <img src="{{ $blogg->photo ? asset('assets/images/blogs/'.$blogg->photo):asset('assets/images/noimage.png') }}" alt="">
                            </a>
                            <div class="copy_block">
                                <p class="date">{{date('M d, Y', strtotime($blogg->created_at))}}</p>
                                <a href="{{route('front.blogshow',$blogg->id)}}" class="title">{{mb_strlen($blogg->title,'utf-8') > 50 ? mb_substr($blogg->title,0,50,'utf-8')."...":$blogg->title}}</a>
                                <p> {{substr(strip_tags($blogg->details),0,120)}}</p>
                            </div>
                        </div>
					</div>
				@endforeach
					
				</div>
        <div class="page-center">
          {!! $blogs->links() !!}               
        </div>
			</div>
		</div>
	</section>





@endsection


@section('scripts')

<script type="text/javascript">
  

    // Pagination Starts

    $(document).on('click', '.pagination li', function (event) {
      event.preventDefault();
      if ($(this).find('a').attr('href') != '#' && $(this).find('a').attr('href')) {
        $('#preloader').show();
        $('#ajaxContent').load($(this).find('a').attr('href'), function (response, status, xhr) {
          if (status == "success") {
            $("html,body").animate({
              scrollTop: 0
            }, 1);
            $('#preloader').fadeOut();


          }

        });
      }
    });

    // Pagination Ends

</script>


@endsection