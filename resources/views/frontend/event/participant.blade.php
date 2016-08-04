@extends('frontend.layouts.master')

@section('content')
<div class="row">
	<div class="col-md-12">
		<h1>Tambah Peserta</h1>
    	<p class="lead"><span>{{ $event->name }}</span> -
	    	<small>
	    		<span class="text-primary">
	    			{{ $event->start_at->formatLocalized('%d %b %Y %r') }}
	    		</span>
	    		hingga
	    		<span class="text-primary">
	    			{{ $event->end_at->formatLocalized('%d %b %Y %r') }}
	    		</span>
	    	</small>
    	</p>

    	<hr>
	</div>
	{!! Form::open(['class' => 'form-horizontal']) !!}
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

	</div>

	<div class="col-md-3">
		<button type="submit" class="btn btn-primary btn-lg btn-block">Simpan</button>
		<a class="btn btn-info btn-lg btn-block" href="{{ route('event.show', $event->id) }}" role="button">Kembali</a>
	</div>

	{!! Form::close() !!}
</div>
@endsection

@section('after-styles-end')
	{!! Html::style('js/vendor/select2/css/select2.min.css') !!}
@stop

@section('after-scripts-end')

	{!! Html::script('js/vendor/select2/js/select2.min.js') !!}

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
        });
    </script>
@stop
