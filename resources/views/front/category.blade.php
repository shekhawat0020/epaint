@extends('layouts.front')

@section('styles')
<style>
.livecount, .price-range-block {
    margin-bottom: 30px;
    margin-top: 30px;
    text-align: center;
}
.price-range-field {
    width: 84px !important;
    background-color: none;
    border: 1px solid rgba(0, 0, 0, 0.15);
    color: black;
    height: 30px;
    text-align: center;
    font-size: 14px;
}
.categori-item-area .ajax-loader {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    z-index: 10;
    display: none;
    /* background-color: rgba(0,0,0,.2); */
}
</style>

@endsection
@section('content')
<section class="inner_page_wrapper">
		<div class="breadcrumb_section">
			<div class="container">
				<ul>
					<li><a href="index.html">Home</a></li>
					<li>Collaboration</li>
				</ul>
			</div>
		</div>
		
		<div class="product_wrapper collaboration_wrapper">
			<div class="container">
				<div class="heading">
					<h3>Paintings</h3>
					<div class="sortby_c">
            @include('includes.filter')
						
					</div>	
				</div>
				<div class="collaboration_inner">
					<div class="left_block">
          @include('includes.catalog')
        

						
					


           
					</div>
					<div class="right_block categori-item-area">
						<div class="row" id="ajaxContent">
                   @include('includes.product.filtered-products')            
            </div>
            <div id="ajaxLoader" class="ajax-loader" style="background: url({{asset('assets/images/'.$gs->loader)}}) no-repeat scroll center center rgba(0,0,0,.6);"></div>
            
					</div>
				</div>
			</div>
		</div>
	</section>
	
@endsection


@section('scripts')

<script>

  $(document).ready(function() {

    // when dynamic attribute changes
    $(".attribute-input, #sortby").on('change', function() {
      $("#ajaxLoader").show();
      filter();
    });

    // when price changed & clicked in search button
    $(".filter-btn").on('click', function(e) {
      e.preventDefault();
      $("#ajaxLoader").show();
      filter();
    });
  });

  function filter() {
    let filterlink = '';

    if ($("#prod_name").val() != '') {
      if (filterlink == '') {
        filterlink += '{{route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}' + '?search='+$("#prod_name").val();
      } else {
        filterlink += '&search='+$("#prod_name").val();
      }
    }

    $(".attribute-input").each(function() {
      if ($(this).is(':checked')) {
        if (filterlink == '') {
          filterlink += '{{route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}' + '?'+$(this).attr('name')+'='+$(this).val();
        } else {
          filterlink += '&'+$(this).attr('name')+'='+$(this).val();
        }
      }
    });

    if ($("#sortby").val() != '') {
      if (filterlink == '') {
        filterlink += '{{route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}' + '?'+$("#sortby").attr('name')+'='+$("#sortby").val();
      } else {
        filterlink += '&'+$("#sortby").attr('name')+'='+$("#sortby").val();
      }
    }

    if ($("#min_price").val() != '') {
      if (filterlink == '') {
        filterlink += '{{route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}' + '?'+$("#min_price").attr('name')+'='+$("#min_price").val();
      } else {
        filterlink += '&'+$("#min_price").attr('name')+'='+$("#min_price").val();
      }
    }

    if ($("#max_price").val() != '') {
      if (filterlink == '') {
        filterlink += '{{route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}' + '?'+$("#max_price").attr('name')+'='+$("#max_price").val();
      } else {
        filterlink += '&'+$("#max_price").attr('name')+'='+$("#max_price").val();
      }
    }

    // console.log(filterlink);
    console.log(encodeURI(filterlink));
    $("#ajaxContent").load(encodeURI(filterlink), function(data) {
      // add query string to pagination
      addToPagination();
      $("#ajaxLoader").fadeOut(1000);
    });
  }

  // append parameters to pagination links
  function addToPagination() {
    // add to attributes in pagination links
    $('ul.pagination li a').each(function() {
      let url = $(this).attr('href');
      let queryString = '?' + url.split('?')[1]; // "?page=1234...."

      let urlParams = new URLSearchParams(queryString);
      let page = urlParams.get('page'); // value of 'page' parameter

      let fullUrl = '{{route('front.category', [Request::route('category'),Request::route('subcategory'),Request::route('childcategory')])}}?page='+page+'&search='+'{{request()->input('search')}}';

      $(".attribute-input").each(function() {
        if ($(this).is(':checked')) {
          fullUrl += '&'+encodeURI($(this).attr('name'))+'='+encodeURI($(this).val());
        }
      });

      if ($("#sortby").val() != '') {
        fullUrl += '&sort='+encodeURI($("#sortby").val());
      }

      if ($("#min_price").val() != '') {
        fullUrl += '&min='+encodeURI($("#min_price").val());
      }

      if ($("#max_price").val() != '') {
        fullUrl += '&max='+encodeURI($("#max_price").val());
      }

      $(this).attr('href', fullUrl);
    });
  }

  $(document).on('click', '.categori-item-area .pagination li a', function (event) {
    event.preventDefault();
    
    if ($(this).attr('href') != '#' && $(this).attr('href')) {
      $('#preloader').show();
      $('.loading_list').remove();
      $('.paginglist').remove();
      $('#ajaxContent').append( $('<div class="row"></div>').load($(this).attr('href'), function (response, status, xhr) {
      
        if (status == "success") {
          $('#preloader').fadeOut();
          $("html,body").animate({
           // scrollTop: 0
          }, 1);

          addToPagination();
        }
      }));
    }
  });

</script>

<script type="text/javascript">

  $(function () {

    $("#slider-range").slider({
      range: true,
      orientation: "horizontal",
      min: 0,
      max: 10000000,
      values: [{{ isset($_GET['min']) ? $_GET['min'] : '0' }}, {{ isset($_GET['max']) ? $_GET['max'] : '10000000' }}],
      step: 5,

      slide: function (event, ui) {
        if (ui.values[0] == ui.values[1]) {
          return false;
        }

        $("#min_price").val(ui.values[0]);
        $("#max_price").val(ui.values[1]);
      }
    });

    $("#min_price").val($("#slider-range").slider("values", 0));
    $("#max_price").val($("#slider-range").slider("values", 1));

    $(document).on('scroll', function() {
       // if( $(this).scrollTop() >= $('.loading_list').position().top ){
          if($(window).scrollTop() >= $('#ajaxContent').offset().top + $('#ajaxContent').outerHeight() - window.innerHeight) {
          $('.loading_list').css('visibility','visible');
          setTimeout(function(){ 
          if($('.pagination li:last-child').hasClass('disabled')){
            $('.loading_list').html('<p>No More Products</p>');
          }else{
          $('.pagination li:last-child a').click();
          }
        }, 3000);
        }
    });

  });

  

</script>



@endsection