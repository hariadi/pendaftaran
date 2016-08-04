@extends('backend.layouts.master')

@section ('title', trans('labels.backend.event.management') . ' | ' . trans('labels.backend.event.create'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.event.management') }}
        <small>{{ trans('labels.backend.event.create') }}</small>
    </h1>
@endsection

@section('content')
	{!! Form::open(['route' => 'admin.event.store', 'class' => 'form-horizontal', 'files' => true]) !!}

	<div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.event.create') }}</h3>
        </div><!-- /.box-header -->

        <div class="box-body">
			<div class="row">
					<div class="col-md-7">

						<!-- form-group -->
						<div class="form-group {{ $errors->has('name') ? 'has-error has-feedback' : '' }}">
						{!! Form::label('name', 'Nama Aktiviti', ['class' => 'col-sm-2 control-label']) !!}
							<div class="col-sm-10">
								{!! Form::text('name', null, [
									'class' => 'form-control',
									'placeholder' => 'Nama aktiviti, pendek dan jelas'
								]) !!}
							</div>
						</div>

						<!-- form-group -->
						<div class="form-group {{ $errors->has('location') ? 'has-error has-feedback' : '' }}">
						{!! Form::label('location', 'Lokasi / Tempat', ['class' => 'col-sm-2 control-label']) !!}
							<div class="col-sm-10">
								{!! Form::textarea('location', null, [
									'rows' => 3,
									'class' => 'form-control',
									'placeholder' => 'Alamat atau nama dewan / bangunan'
								]) !!}
							</div>
						</div>

						<!-- form-group -->
						<?php $start = \Carbon\Carbon::createFromTime(8); ?>
						<div class="form-group {{ $errors->has('start_at') ? 'has-error has-feedback' : '' }}">
						{!! Form::label('start_at', 'Mula', ['class' => 'col-sm-2 control-label']) !!}
							<div class="col-sm-4">

								<div class="input-group">
									{!! Form::text('start_at', null, [
										'class' => 'form-control',
										'placeholder' => $start->toDateTimeString()
									]) !!}

									<div class="input-group-btn">
						            	<button class="btn btn-primary btn-date" type="button"><i class="fa fa-calendar"></i></button>
						            </div>
								</div>
							</div>
						</div>

						<!-- form-group -->
						<div class="form-group {{ $errors->has('end_at') ? 'has-error has-feedback' : '' }}">
						{!! Form::label('end_at', 'Tamat', ['class' => 'col-sm-2 control-label']) !!}
							<div class="col-sm-4">
								<div class="input-group">
									{!! Form::text('end_at', null, [
										'class' => 'form-control',
										'placeholder' => $start->addHours(8)->toDateTimeString()
									]) !!}

									<div class="input-group-btn">
						            	<button class="btn btn-primary btn-date" type="button"><i class="fa fa-calendar"></i></button>
						            </div>
								</div>
							</div>
						</div>

						<!-- form-group -->
						<div class="form-group">
						{!! Form::label('photo', 'Gambar', ['class' => 'col-sm-2 control-label']) !!}
							<div class="col-sm-10">
								{!! Form::file('photo', null, [
									'class' => 'form-control',
								]) !!}
							</div>
						</div>

						<!-- form-group -->
						<div class="form-group">
						{!! Form::label('description', 'Keterangan', ['class' => 'col-sm-2 control-label']) !!}
							<div class="col-sm-10">
								{!! Form::textarea('description', null, [
									'rows' => 5,
									'class' => 'form-control',
									'placeholder' => 'Keterangan berkenaan aktiviti ini'
								]) !!}
							</div>
						</div>


					</div><!-- /.col-md-7 -->

					<div class="col-md-5">

						<div class="form-group">
						{!! Form::label('options.attendant', 'Kehadiran', ['class' => 'col-sm-2 control-label']) !!}
							<div class="col-sm-10">
								<div class="checkbox">
									<label>
										{!! Form::checkbox('options[attendant]', 1, true, ['id' => 'options.attendant']) !!}  Ambil kedatangan peserta mengikut hari
									</label>
									<p class="help-block">Kedatangan akan diambil secara atas talian setiap hari sepanjang tempoh berlangsungnya aktiviti.</p>
								</div>
							</div>
						</div>


						<!-- form-group -->
						<div class="form-group">
						{!! Form::label('options.share', 'Share', ['class' => 'col-sm-2 control-label']) !!}
							<div class="col-sm-10">

								<div class="checkbox">
									<label>
										{!! Form::checkbox('options[share][facebook]', 1, true) !!}  Facebook
									</label>
								</div>
								<div class="checkbox">
									<label>
										{!! Form::checkbox('options[share][twitter]', 1, true) !!}  Twitter
									</label>
								</div>
								<div class="checkbox">
									<label>
										{!! Form::checkbox('options[share][gplus]', 1, true) !!}  Google Plus
									</label>
								</div>
								<p class="help-block">Membolehkan pengguna membuat perkongsian sosial melalui butang yang disediakan.</p>
							</div>
						</div>

						<button type="submit" class="btn btn-primary btn-lg btn-block">Simpan</button>
						<a class="btn btn-warning btn-lg btn-block" href="{{ route('admin.event.index') }}" role="button">Batal</a>
					</div>
			</div>
		</div>
	</div>
	{!! Form::close() !!}
@endsection

@section('after-styles-end')
	{!! Html::style('plugins/datetimepicker/bootstrap-datetimepicker.min.css') !!}
@stop

@section('after-scripts-end')
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
        });
    </script>
@stop
