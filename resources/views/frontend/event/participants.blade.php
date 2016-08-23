@extends('frontend.layouts.master')

@section('content')

<?php $counter = old('participants') ? count(old('participants'))+1 : 2; ?>

<div class="row">
    <div class="col-md-12">
        <h1>Tambah Peserta</h1>
        <p class="lead text-muted"><span>{{ $event->name }}</span>
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
    {!! Form::hidden('multiple', true) !!}
    <div class="col-md-9">

        <div class="form-group required {{ $errors->has('agency_id') ? 'has-error has-feedback' : '' }}">
            {!! Form::label('agency_id', 'Agensi', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-md-10">
            {!! Form::selectAgency('agency_id', old('agency_id'), ['class' => 'form-control input-lg']) !!}
            </div>
        </div>

        <hr>
        @for ($i = 1; $i < $counter; $i++)
        <div id="entry{{ $i }}" class="clonedInput">

            <h2 id="reference" name="reference" class="heading-reference">Peserta #{{ $i }}</h2>
            <!-- form-group -->
            <div class="form-group {{ $errors->has('participants.' . $i . '.name') ? 'has-error has-feedback' : '' }}">
                {!! Form::label('name', 'Nama Peserta', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('participants[' . $i . '][name]', old('name'), [
                        'id' => 'name',
                        'class' => 'form-control',
                        'placeholder' => 'Nama penuh peserta'
                    ]) !!}
                </div>
            </div>

            <!-- form-group -->
            <div class="form-group {{ $errors->has('participants.' . $i . '.ic') ? 'has-error has-feedback' : '' }}">
                {!! Form::label('ic', 'No. KP', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('participants[' . $i . '][ic]', null, [
                        'id' => 'ic',
                        'class' => 'form-control',
                        'placeholder' => 'No. Kad Pengenalan Peserta'
                    ]) !!}
                </div>
            </div>

            <!-- form-group -->
            <div class="form-group {{ $errors->has('participants.' . $i . '.phone') ? 'has-error' : '' }} has-feedback">
                {!! Form::label('phone', 'Telefon', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-6">
	                    {!! Form::text('participants[' . $i . '][phone]', null, [
	                        'id' => 'phone',
	                        'class' => 'form-control',
	                        'placeholder' => 'No. Telefon Pejabat / Bimbit'
	                    ]) !!}
	                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                </div>
            </div>

            <!-- form-group -->
            <div class="form-group {{ $errors->has('participants.' . $i . '.email') ? 'has-error' : '' }} has-feedback">
                {!! Form::label('email', 'E-Mel', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('participants[' . $i . '][email]', null, [
                        'id' => 'email',
                        'class' => 'form-control',
                        'placeholder' => 'Alamat emel yang sah'
                    ]) !!}
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
            </div>

            <!-- form-group -->
            <div class="form-group {{ $errors->has('participants.' . $i . '.job_title') ? 'has-error has-feedback' : '' }}">
                {!! Form::label('job_title', 'Jawatan', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-8">
                    {!! Form::text('participants[' . $i . '][job_title]', null, [
                        'id' => 'job_title',
                        'class' => 'form-control',
                        'placeholder' => 'Jawatan peserta. Contoh: Penolong Pengarah'
                    ]) !!}
                </div>
            </div>

            <!-- form-group -->
            <div class="form-group {{ $errors->has('participants.' . $i . '.grade') ? 'has-error has-feedback' : '' }}">
                {!! Form::label('grade', 'Gred', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::text('participants[' . $i . '][grade]', null, [
                        'id' => 'grade',
                        'class' => 'form-control',
                        'placeholder' => 'Gred jawatan. Contoh: N17'
                    ]) !!}
                </div>
            </div>

        <hr>

        </div><!-- end #entry{{ $i }} -->
        @endfor
            <!-- form-group -->
            <div class="form-group">

                <div class="col-sm-offset-2 col-sm-10 ">
                    <button type="button" id="btnAdd" class="btn btn-primary btn-sm clone"><i class="fa fa-user-plus"></i> Tambah Peserta</button>
                    <button type="button" id="btnDel" class="btn btn-danger btn-sm remove"><i class="fa fa-user-times"></i> Buang Peserta Di atas</button>
                </div>
            </div>

    </div>

    <div class="col-md-3">
        <button type="submit" class="btn btn-primary btn-lg btn-block">Simpan</button>
        <a class="btn btn-warning btn-lg btn-block" href="{{ route('event.show', $event->id) }}" role="button">Batal</a>
    </div>

    {!! Form::close() !!}
</div>
@endsection

@section('after-styles-end')
	{!! Html::style('plugins/select2/css/select2.min.css') !!}
	{!! Html::style('plugins/select2/css/select2-bootstrap.min.css') !!}
@stop

@section('after-scripts-end')

	{!! Html::script('plugins/select2/js/select2.min.js') !!}

    <script>
        $(function () {
            $('#btnAdd').on('click', function () {
                var num = $('.clonedInput').length, // Checks to see how many "duplicatable" input fields we currently have
                newNum  = new Number(num + 1), // The numeric ID of the new input field being added, increasing by 1 each time
                newElem = $('#entry' + num).clone().attr('id', 'entry' + newNum).fadeIn('slow'); // create the new element via clone(), and manipulate it's ID using newNum value

                newElem.find('.heading-reference').attr('id', 'ID' + newNum + '_reference').attr('name', 'ID' + newNum + '_reference').html('Peserta #' + newNum);


                $('label', newElem).each(function () {
                    var old = $(this).attr('for');
                    $(this).attr('for', old + '_' + newNum);
                });

                $('input', newElem).each(function () {
                    var old = $(this).attr('id');
                    $(this).attr('id', old + '_' + newNum);
                    this.name = this.name.replace(/\[(\d+)\]/,function(str,p1){return '[' + (parseInt(p1,10)+1) + ']'});
                    this.value = '';
                });

                $('#entry' + num).after(newElem);
                $('#name' + newNum ).focus();
                $('#btnDel').attr('disabled', false);

                if (newNum == 10) {
                    $('#btnAdd').attr('disabled', true).prop('value', "Maaf, hanya 10 peserta untuk satu borang.");
                }

            });

            $('#btnDel').on('click', function () {
                var num = $('.clonedInput').length;


                //if ($('#name' + num).val().length > 0) {
                    if (confirm("Data anda akan dihapus. Anda pasti?")) {
                        // how many "duplicatable" input fields we currently have
                        $('#entry' + num).slideUp('slow', function () {
                            $(this).remove();
                            // if only one element remains, disable the "remove" button
                                if (num -1 === 1)
                            $('#btnDel').attr('disabled', true);
                            // enable the "add" button
                            $('#btnAdd').attr('disabled', false).prop('value', "add section");
                        });
                    }
                //}

                return false; // Removes the last section you added
            });

            // Enable the "add" button
            $('#btnAdd').attr('disabled', false);
            // Disable the "remove" button
            $('#btnDel').attr('disabled', ($('.clonedInput').length > 1) ? false : true);

            $("#agency_id").select2({
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
