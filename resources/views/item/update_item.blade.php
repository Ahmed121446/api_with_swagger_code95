@extends('../layout/master')

@section('title')
   Profile
@endsection

@section('content')

<h1>Profile Page</h1>


<form action="update-item" method="put">
	{{csrf_field()}}
	<div class="form-group">
		<label for="itemname">Item Name : </label>
		<input type="text" name="itemname" class="form-control" id="itemname">
	</div>
	<input type="submit" class="btn btn-primary" value="Update">
</form>


@endsection