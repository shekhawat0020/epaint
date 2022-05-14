
@foreach($address as $add)
<div class="col-6">
	<div class="address_block">
		<div class="add_inner">
			<p>{{$add->name}}</p>
			<p>{{$add->address}}, {{$add->city}} , {{$add->state}}, {{$add->country}}, {{$add->zip}}   </p>
			<div class="float-left">
				<p>{{$add->phone}} </p>
			</div>
			<ul class="edit_list">
				<li><a class="editaddresslink" data-zip="{{$add->zip}}" data-id="{{$add->id}}" data-name="{{$add->name}}" data-phone="{{$add->phone}}"  data-address="{{$add->address}}" data-city="{{$add->city}}" data-country="{{$add->country}}" data-state="{{$add->state}}" data-bs-toggle="modal" href="#address_edit_popup"><i class="fa fa-edit"></i></a></li>
				<li><a href="{{route('user-delete-address', $add->id)}}" class="delete_link"><i class="fa fa-trash-o"></i></a></li>
			</ul>
		</div>
	</div>
</div>
@endforeach