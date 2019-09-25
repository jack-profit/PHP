@extends('layouts.main')
@section('content')
<div class="row">
	<div class="col-md-r col-md-offset-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Welcome To Register</h3>
			</div>
			<div class="panel-body">
			<form action='{{URL::action("UserController@postCreate")}}' method='post' accept-charset='utf-8'>
				<ul>
					@foreach($errors->all() as $error)
					<li>{{$error}}</li><br>
					@endforeach
				</ul>
				<input type='hidden' name='_token' value='<?php echo csrf_token(); ?>'>
				<fieldset>
					<div class="form-group"><input type='text' name='username' class='form-control' placeholder='username' /></div>
					<div class="form-group"><input type='text' name='email' class='form-control' placeholder='email' /></div>
					<div class="form-group"><input type='text' name='password' class='form-control' placeholder='password' /></div>
					<div class="form-group"><input type='text' name='password_confirmation' class='form-control' placeholder='confirm password' /></div>
					<button class="btn btn-large btn-success btn-block" type='submit' name='register'>Register</button>
				</fieldset>
			</form>
			</div>
		</div>
	</div>
</div>
@endsection