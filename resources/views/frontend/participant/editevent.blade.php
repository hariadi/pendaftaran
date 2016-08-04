@extends('frontend.layouts.master')

@section('content')
<div class="row">
	<div class="col-md-12">
		<h1>Kemaskini Peserta <small>{{ $participant->name }}</small></h1>

		<hr>
	</div>
	{!! Form::model($participant, ['route' => ['participant.update', $participant->id], 'class' => 'form-horizontal', 'method' => 'PATCH']) !!}
	<div class="col-md-9">

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
					'placeholder' => 'No. Kad Pengenalan Peserta'
				]) !!}
			</div>
		</div>

		<!-- form-group -->
		<div class="form-group has-feedback">
			{!! Form::label('phone', 'Telefon', ['class' => 'col-sm-2 control-label']) !!}
			<div class="col-sm-6">
				{!! Form::text('phone', null, [
					'class' => 'form-control',
					'placeholder' => 'No. Telefon Pejabat / Bimbit'
				]) !!}
				<span class="glyphicon glyphicon-phone form-control-feedback" aria-hidden="true"></span>
			</div>
		</div>

		<!-- form-group -->
		<div class="form-group has-feedback">
			{!! Form::label('email', 'E-Mel', ['class' => 'col-sm-2 control-label']) !!}
			<div class="col-sm-6">
				{!! Form::text('email', null, [
					'class' => 'form-control',
					'placeholder' => 'Alamat emel yang sah'
				]) !!}
				<span class="glyphicon glyphicon-envelope form-control-feedback" aria-hidden="true"></span>
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

		<h2 class="page-header">{{ $event->name }}</h2>
		<p>Kehadiran</p>
		<?php $key = 0; ?>
		@foreach ($attends as $date => $attendance)
			<!-- form-group -->
			<div class="form-group">
				{!! Form::label('attend' . $key, $date, ['class' => 'col-sm-2 control-label']) !!}
				<div class="col-sm-4">
					{!! Form::text('attend[]',
						($attendance ? $attendance->created_at->toDateTimeString() : null), [
						'id' => 'attend' . $key,
						'class' => 'form-control'
					]) !!}
				</div>
			</div>
			<?php $key++; ?>
		@endforeach

	</div>

	<div class="col-md-3">
		<button type="submit" class="btn btn-primary btn-lg btn-block">Simpan</button>
		<a class="btn btn-info btn-lg btn-block" href="{{ route('event.show', $event->id) }}" role="button">Kembali</a>
	</div>

	{!! Form::close() !!}
</div>
@endsection

@section('after-styles-end')
	{!! Html::style('plugins/select2/css/select2.min.css') !!}
	{!! Html::style('plugins/datetimepicker/bootstrap-datetimepicker.min.css') !!}
@stop

@section('after-scripts-end')

	{!! Html::script('plugins/select2/js/select2.min.js') !!}
	{!! Html::script('plugins/datetimepicker/moment.min.js') !!}
	{!! Html::script('plugins/datetimepicker/bootstrap-datetimepicker.min.js') !!}

	<script>
		$(function () {
			$("#agency_id").select2({
				placeholder: 'Pilih atau Tambah Agensi',
				tags: true,
				createTag: function(params) {
					return {
						id: 'new:' + params.term,
						text: params.term + ' (baru)'
					};
				}
			});

			<?php
			$ids = [];
			for($i = 0, $size = count($attends); $i < $size; ++$i) {
				$ids[] = '#attend' . $i;
			}
			?>

			$('{{ implode(', ', $ids) }}').datetimepicker({
				format: 'YYYY-MM-DD HH:mm:ss',
			});

			$('.btn-date').click(function() {
				$(this).parent().parent().find('input').focus();
			});
		});
	</script>
@stop
