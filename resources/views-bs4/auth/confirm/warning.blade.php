@extends('layouts.app')
{{--@section( 'title', trans( 'LEC.view.warning.title' ) )--}}
@section( 'content' )
<div class="row">
	<div class="col"></div>
	<div class="col" style="min-width:320px;width:25%">
		<div class="card card-inverse card-primary">
			<div class="card-block">
				<h4 class="card-title text-center">{{ trans( 'LEC.view.warning.title' ) }}</h4>
				<p class="text-center">{!! trans( 'LEC.view.warning.message' ) !!}</p>
				<p class="text-center"><a href="{{ route( 'confirm.repeat' ) }}" class="btn bg-inverse text-white">{{ trans( 'LEC.view.warning.goto-resend' ) }}</a></p>
			</div>
		</div>
	</div>
	<div class="col"></div>
</div>
@endsection
