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
            <a href="{{ route('front.event') }}">
             Events
            </a>
          </li>
				</ul>
			</div>
		</div>
		<div class="event_section">
			<div class="banner">
				<picture>
                    <source srcset="{{asset('assets/front/images/event.webp')}}" media="(min-width:1023px)">
                    <source srcset="{{asset('assets/front/images/event-mobile.webp')}}" media="(min-width:320px)">
                    <img src="{{asset('assets/front/images/event.webp')}}" alt="">
                </picture>
            </div>

			<div class="container">
				<ul>
          @foreach($events as $KEY => $event)
					<li>
						<a href="#event_modal{{$KEY}}" data-bs-toggle="modal"><img src="{{ $event->photo ? asset('assets/images/blogs/'.$event->photo):asset('assets/images/noimage.png') }}" alt=""></a>
					</li>
          @endforeach
				</ul>
    		</div>
		</div>
	</section>
  @foreach($events as $KEY => $event)
  <div class="modal fade event_popup" id="event_modal{{$KEY}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			<div class="modal-body">
				<h3>{{$event->event_name}}</h3>
				<ul>
                    <li><span>Date:</span> {{date('M d Y', strtotime($event->event_date))}}</li>
                    <li><span>Time:</span> {{date('H:i a', strtotime($event->event_time))}}</li>
                    <li><span>City:</span> {{$event->city}}</li>
                    <li><span>Venue:</span>  {{$event->venue}}</li>
                    <li><span>Exhibition Name:</span>  {{$event->exhibition_name}}</li>
                    <li><span>Stall Number:</span>  {{$event->stall_number}}</li>
                </ul>
			</div>
		</div>
	</div>
</div>	
@endforeach

@endsection