{{-- register --}}
@extends('../layout/master')

@section('title')
    Register page
@endsection

@section('content')

<h1>Register Page</h1>


<form action="/auth/register" method="post">
	
	{{csrf_field()}}

	<div class="form-group">
		<label for="email">Email :</label>
		<input type="email" name="email" class="form-control" placeholder="example @ example.com">
	</div>

	<div class="form-group">
		<label for="name">name :</label>
		<input type="text" name="name" class="form-control" placeholder="Your First Name">
	</div>

	<div class="form-group">
		<label for="password">Password :</label>
		<input type="password" name="password" class="form-control" placeholder="*******">
	</div>

	<div class="form-group">
		<label for="password_confirmation">Password Confirmation :</label>
		<input type="password" name="password_confirmation" class="form-control" placeholder="*******">
	</div>

	<input type="submit" class="btn btn-primary" value="Submit" >
</form>
@endsection