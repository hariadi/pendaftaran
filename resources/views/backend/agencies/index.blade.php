@extends('backend.layouts.master')

@section('page-header')
	<h1>
		{{ trans('labels.backend.agency.title') }}
		<a href="{{ route('admin.agencies.create') }}" class="btn btn-primary"><i class="fa fa-calendar-plus-o"></i> Tambah Agensi</a>
	</h1>
@endsection

@section('content')
	<div class="box box-success">
		<div class="box-header with-border">
			<h3 class="box-title">{{ trans('strings.backend.dashboard.welcome') }} {!! access()->user()->name !!}!</h3>
			<div class="box-tools pull-right">
				<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			</div><!-- /.box tools -->
		</div><!-- /.box-header -->
		<div class="box-body">

			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover">
					<thead>
					<tr>
						<th>{{ trans('labels.backend.agency.id') }}</th>
						<th>{{ trans('labels.backend.agency.name') }}</th>
						<th>{{ trans('labels.backend.agency.short') }}</th>
						<th>{{ trans('labels.general.actions') }}</th>
					</tr>
					</thead>
					<tbody>
						@foreach ($agencies as $agency)
							<tr>
								<td>{!! $agency->id !!}</td>
								<td><a href="{{ route('admin.agencies.edit', $agency->id) }}">{!! $agency->name !!}</a></td>
								<td>{!! $agency->short !!}</td>
								<td>{!! $agency->action_buttons !!}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>

		</div><!-- /.box-body -->
	</div><!--box box-success-->
@endsection
