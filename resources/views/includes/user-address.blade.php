
@foreach($address as $add)
<div class="col-6">
	<div class="address_block">
		<div class="add_inner">
			<p>{{$add->name}}</p>
			<p>{{$add->address}}, {{$add->city}} , {{$add->state}}, {{$add->country}}  </p>
			<div class="float-left">
				<p>{{$add->phone}} </p>
			</div>
			<ul class="edit_list">
				<li><a href="#"><i class="fa fa-edit"></i></a></li>
				<li><a href="#"><i class="fa fa-trash-o"></i></a></li>
			</ul>
		</div>
	</div>
</div>
@endforeach