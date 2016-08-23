@extends('backend.layouts.master')

@section ('title', trans('labels.backend.participant.management') . ' | ' . trans('labels.backend.participant.create'))

@section('page-header')
    <h1>
    	{{ $participant->name }}
        <small>{{ trans('labels.backend.participant.edit') }}</small>
        <a href="{{ route('admin.participant.show', $participant->id) }}" class="btn btn-primary btn-sm">Sejarah Kehadiran</a>
    </h1>
@endsection

@section('content')
	{!! Form::model($participant, [
		'route' => ['admin.participant.update', $participant->id],
		'class' => 'form-horizontal',
		'method' => 'patch',
	]) !!}

	<div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.participant.create') }}</h3>
        </div><!-- /.box-header -->

        <div class="box-body">
			<div class="row">
				<div class="col-md-12">

					<div class="form-group required">
						{!! Form::label('agency_id', 'Agensi', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
						{!! Form::selectAgency('agency_id', null, ['class' => 'form-control']) !!}
						</div>
					</div>

					<hr>

					<!-- form-group -->
			    	<div class="form-group">
						{!! Form::label('name', 'Nama Peserta', ['class' => 'col-sm-2 control-label']) !!}
						<div class="col-sm-10">
							{!! Form::text('name', null, [
								'class' => 'form-control',
								'aria-label' => 'Nama penuh peserta',
								'placeholder' => 'Nama penuh peserta'
							]) !!}
						</div>
					</div>

					<!-- form-group -->
			    	<div class="form-group">
						{!! Form::label('ic', 'No. KP', ['class' => 'col-sm-2 control-label']) !!}
						<div class="col-sm-10">
							{!! Form::text('ic', null, [
								'class' => 'form-control',
								'aria-label' => 'No. Kad Pengenalan Peserta',
								'placeholder' => 'No. Kad Pengenalan Peserta'
							]) !!}
						</div>
					</div>

					<!-- form-group -->
			    	<div class="form-group">
						{!! Form::label('phone', 'Telefon', ['class' => 'col-sm-2 control-label']) !!}
						<div class="col-sm-6">
							<div class="input-group">
								{!! Form::text('phone', null, [
									'class' => 'form-control',
									'aria-label' => 'No. Telefon Pejabat / Bimbit',
									'placeholder' => 'No. Telefon Pejabat / Bimbit'
								]) !!}
								<span class="input-group-addon"><i class="fa fa-phone"></i></span>
							</div>

						</div>
					</div>

					<!-- form-group -->
			    	<div class="form-group has-feedback">
						{!! Form::label('email', 'E-Mel', ['class' => 'col-sm-2 control-label']) !!}
						<div class="col-sm-6">
							<div class="input-group">
								{!! Form::text('email', null, [
									'class' => 'form-control',
									'aria-label' => 'Alamat emel yang sah',
									'placeholder' => 'Alamat emel yang sah'
								]) !!}
								<span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
							</div>
						</div>
					</div>

					<!-- form-group -->
			    	<div class="form-group">
						{!! Form::label('job_title', 'Jawatan', ['class' => 'col-sm-2 control-label']) !!}
						<div class="col-sm-8">
							{!! Form::text('job_title', null, [
								'class' => 'form-control',
								'placeholder' => 'Jawatan peserta. Contoh: Penolong Pengarah'
							]) !!}
						</div>
					</div>

					<!-- form-group -->
			    	<div class="form-group">
						{!! Form::label('grade', 'Gred', ['class' => 'col-sm-2 control-label']) !!}
						<div class="col-sm-4">
							{!! Form::text('grade', null, [
								'class' => 'form-control',
								'placeholder' => 'Gred jawatan. Contoh: N17'
							]) !!}
						</div>
					</div>

				</div><!-- /.col-md-7 -->


			</div>
		</div>
	</div>

	<div class="box box-success">
            <div class="box-body">
                <div class="pull-left">
                    <a href="{{ route('admin.participant.index') }}" class="btn btn-danger btn-lg">{{ trans('buttons.general.cancel') }}</a>
                </div>

                <div class="pull-right">
                    <input type="submit" class="btn btn-success btn-lg" value="{{ trans('buttons.general.crud.update') }}" />
                </div>
                <div class="clearfix"></div>
            </div><!-- /.box-body -->
        </div><!--box-->
	{!! Form::close() !!}

	<div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Tambah peserta ke dalam program terkini</h3>
        </div><!-- /.box-header -->

        <div class="box-body">
			<div class="row">
				<div class="col-md-12">

					<table class="table table-striped table-bordered table-hover" id="participants">
                    <thead>
                    <tr>
                        <th>{{ trans('labels.backend.event.id') }}</th>
                        <th>{{ trans('labels.backend.event.title') }}</th>
                        <th>{{ trans('labels.backend.event.start') }}</th>
                        <th>{{ trans('labels.backend.event.end') }}</th>
                        <th>{{ trans('labels.backend.event.participants') }}</th>
                        <th>{{ trans('labels.backend.event.days') }}</th>
                        <th>{{ trans('labels.general.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                            <tr>
                                <td>{!! $event->id !!}</td>
                                <td><a href="{{ route('admin.report.event', $event->id) }}">{!! $event->name !!}</a></td>
                                <td>{!! $event->start_at->diffForHumans() !!}</td>
                                <td>{!! $event->end_at->diffForHumans() !!}</td>
                                <td>
                                    @if ($event->participants->count() > 0)
                                    	{!! $event->participants->count() !!}
                                    @else
                                        {{ trans('labels.general.none') }}
                                    @endif
                                </td>
                                <td>{!! $event->getTotalDay() !!}</td>
                                <td>
                                	<button class="btn {{ $participant->isAttendees($event->id) ? 'btn-success' : 'btn-warning' }} btn-sm btn-attendees btn-block" data-event-id="{{ $event->id }}" data-participant-id="{{  $participant->id }}"><i class="fa fa-{{ $participant->isAttendees($event->id) ? 'check' : 'close' }}"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

				</div>
			</div>
		</div>

	</div>
@endsection

@section('after-styles-end')
	{!! Html::style('plugins/toastr/toastr.min.css') !!}
	{!! Html::style('plugins/datetimepicker/bootstrap-datetimepicker.min.css') !!}
@stop

@section('after-scripts-end')
	{!! Html::script('plugins/toastr/toastr.min.js') !!}
    {!! Html::script('plugins/datetimepicker/moment.min.js') !!}
    {!! Html::script('plugins/datetimepicker/bootstrap-datetimepicker.min.js') !!}

    <script>
    	$(function () {
            $('#start_at, #end_at').datetimepicker({
            	format: 'YYYY-MM-DD HH:mm:ss',
            });

			$('.btn-date').click(function() {
				$(this).parent().parent().find('input').focus();
			});

			$('#participants').on('click', '.btn-attendees', function(e) {
				var that = this;

				$.post('{{ route("participant.event.add") }}', {
					event_id: $(this).data('event-id'),
					participant_id: $(this).data('participant-id'),
				}, function(data) {

					if (data.result) {
						if (data.action == 'add') {

							toastr.success(data.status, data.subject);
							$(that).toggleClass('btn-warning btn-success');
							$(that).find('i').toggleClass('fa-check fa-close');

						} else if (data.action == 'delete') {

							toastr.warning(data.status, data.subject);
							$(that).toggleClass('btn-success btn-warning');
							$(that).find('i').toggleClass('fa-close fa-check');

						}

					} else {
						toastr.error(data.status, data.subject);
					}

				}, 'json');

			});
        });
    </script>
@stop
