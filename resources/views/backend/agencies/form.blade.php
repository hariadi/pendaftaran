<!-- form-group -->
<div class="form-group {{ $errors->has('name') ? 'has-error has-feedback' : '' }}">
{!! Form::label('name', 'Nama Agensi', ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::text('name', null, [
			'class' => 'form-control',
			'placeholder' => 'Nama agensi, pendek dan jelas'
		]) !!}
	</div>
</div>

<!-- form-group -->
<div class="form-group {{ $errors->has('short') ? 'has-error has-feedback' : '' }}">
{!! Form::label('short', 'Singkatan', ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::text('short', null, [
			'class' => 'form-control',
			'placeholder' => 'Singkatan nama agensi'
		]) !!}
	</div>
</div>

<!-- form-group -->
<div class="form-group required {{ $errors->has('parent_id') ? 'has-error has-feedback' : '' }}">
	{!! Form::label('parent_id', 'Agensi', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-10">
	{!! Form::selectAgency('parent_id', old('parent_id'), ['class' => 'form-control input-lg']) !!}
	</div>
</div>
