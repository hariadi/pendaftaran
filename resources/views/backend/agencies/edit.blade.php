@extends('backend.layouts.master')

@section ('title', trans('labels.backend.agency.management') . ' | ' . trans('labels.backend.agency.create'))

@section('page-header')
	<h1>
		{{ trans('labels.backend.agency.management') }}
		<small>{{ trans('labels.backend.agency.create') }}</small>
	</h1>
@endsection

@section('content')
	{!! Form::model($agency, [
		'route' => ['admin.agencies.update', $agency->id],
		'class' => 'form-horizontal',
		'method' => 'patch',
	]) !!}

	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">{{ trans('labels.backend.agency.create') }}</h3>
		</div><!-- /.box-header -->

		<div class="box-body">
			<div class="row">
					<div class="col-md-12">

					@include('backend.agencies.form')

					</div><!-- /.col-md-7 -->
			</div>
		</div>
	</div>

	<div class="box box-success">
        <div class="box-body">
            <div class="pull-left">
                <a href="{{ route('admin.agencies.index') }}" class="btn btn-danger btn-lg">{{ trans('buttons.general.cancel') }}</a>
            </div>

            <div class="pull-right">
                <input type="submit" class="btn btn-success btn-lg" value="{{ trans('buttons.general.crud.update') }}" />
            </div>
            <div class="clearfix"></div>
        </div><!-- /.box-body -->
    </div><!--box-->
	{!! Form::close() !!}
@endsection

@section('after-styles-end')
	{!! Html::style('plugins/select2/css/select2.min.css') !!}
	{!! Html::style('plugins/select2/css/select2-bootstrap.min.css') !!}
@stop

@section('after-scripts-end')
	{!! Html::script('plugins/select2/js/select2.min.js') !!}

	<script>
		$(function () {
			$("#parent_id").select2({
            	theme: 'bootstrap',
				placeholder: 'Pilih atau Tambah Agensi',
				tags: true,
				createTag: function(params) {
					return {
						id: 'new:' + params.term,
						text: params.term + ' (baru)'
					};
				}
            }).focus(function () { $(this).select2('open'); });
		});
	</script>
@stop
