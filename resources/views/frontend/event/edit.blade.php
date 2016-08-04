@extends('frontend.layouts.auth')

@section ('title', trans('labels.backend.event.management') . ' | ' . trans('labels.backend.event.create'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.event.management') }}
        <small>{{ trans('labels.backend.event.create') }}</small>
    </h1>
@endsection

@section('content')
	{!! Form::model($event, [
		'route' => ['event.update', $event->id],
		'class' => 'form-horizontal',
		'method' => 'patch',
		'files' => true,
	]) !!}

	<div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.event.create') }}</h3>
        </div><!-- /.box-header -->

        <div class="box-body">
			<div class="row">
			@include('frontend.event.includes.form')
			</div>
		</div>
	</div>

	<div class="box box-success">
        <div class="box-body">
            <div class="pull-left">
                <a href="{{ route('event.show', $event->id) }}" class="btn btn-danger btn-lg">{{ trans('buttons.general.cancel') }}</a>
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
	{!! Html::style('plugins/datetimepicker/bootstrap-datetimepicker.min.css') !!}
	{!! Html::style('plugins/select2/css/select2.min.css') !!}
@stop

@section('after-scripts-end')
    {!! Html::script('plugins/datetimepicker/moment.min.js') !!}
    {!! Html::script('plugins/datetimepicker/bootstrap-datetimepicker.min.js') !!}
    {!! Html::script('plugins/select2/js/select2.min.js') !!}

    <script>
    	$(function () {
            $('#start_at, #end_at').datetimepicker({
            	format: 'YYYY-MM-DD HH:mm:ss',
            });

			$('.btn-date').click(function() {
				$(this).parent().parent().find('input').focus();
			});

			$("#categories").select2({
				placeholder: 'Pilih Kategori',
				tags: true,
				createTag: function(params) {
					return undefined;
				}
            });
        });
    </script>
@stop
