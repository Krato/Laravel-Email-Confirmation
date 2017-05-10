{{--
Attention!
There is no processing of error messages.
It is assumed that you are processing errors in a separate place in the frontend.
--}}

@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans( 'LEC.view.confirm.title' ) }}</div>
				<div class="panel-body">
					<form name="confirm-email" class="form-horizontal" method="POST" action="{{ route( 'confirm.repeat' ) }}">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="email" class="col-md-4 control-label">{{ trans( 'LEC.view.confirm.email' ) }}</label>
							<div class="col-md-6">
								<input type="text" name="email" class="form-control" value="@if( auth()->check() ){{ auth()->user()->email }}@endif" placeholder="E-Mail"/>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-8 col-md-offset-4">
								<button type="submit" role="button" class="btn btn-primary">{{ trans( 'LEC.submit' ) }}</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
