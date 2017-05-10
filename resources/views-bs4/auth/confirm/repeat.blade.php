{{--
Attention!
There is no processing of error messages.
It is assumed that you are processing errors in a separate place in the frontend.
--}}

@extends('layouts.app')
{{--@section( 'title', trans( 'LEC.view.confirm.title' ) )--}}
@section( 'content' )
<div class="row">
	<div class="col"></div>
	<div class="col" style="min-width:320px;width:25%">
		<div class="card card-inverse card-primary">
			<div class="card-block">
				<h4 class="card-title text-center">{{ trans( 'LEC.view.confirm.title' ) }}</h4>
				<form name="confirm-email" method="POST" action="{{ route( 'confirm.repeat' ) }}">
					{{ csrf_field() }}
					<div class="form-group text-center">
						<label for="email">{{ trans( 'LEC.view.confirm.email' ) }}</label>
						<input type="text" name="email" class="form-control text-center" value="@if( auth()->check() ){{ auth()->user()->email }}@endif" placeholder="E-Mail"/>
					</div>
					<div class="form-group text-center">
						<button type="submit" role="button" class="btn bg-inverse text-white">{{ trans( 'LEC.submit' ) }}</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col"></div>
</div>
@endsection
