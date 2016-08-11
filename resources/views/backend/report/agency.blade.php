@extends($print ? 'backend.layouts.print' : 'backend.layouts.master')

@section ('title', trans('labels.backend.report.management'))

@section('page-header')
    <h1>
        Laporan Peserta Tidak Hadir
        @if (!$print)
		<small class="hidden-print">
			<a href="{{ route('admin.report.agencies', ['event' => $event->id, 'action' => 'print', 'attend' => request('attend')]) }}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-print"></i> Cetak</a>
		</small>
		@endif
    </h1>
@endsection

@section('cssClass', 'invoice')

@section('content')

	<!-- title row -->
	<div class="row">
		<div class="col-xs-12">
			<h2 class="page-header">
				<i class="fa fa-calendar-check-o"></i> {{ $event->name }}
				<small class="pull-right">{{ \Carbon\Carbon::now()->formatLocalized('%d %B %Y') }}</small>
			</h2>

		</div>
		<!-- /.col -->
	</div>

	<!-- info row -->
    <div class="row invoice-info">

		<div class="col-sm-8 invoice-col">
			<p><i class="fa fa-calendar list-r-5"></i> {{ $event->start_at->formatLocalized('%d %b %Y %r') }} hingga {{ $event->end_at->formatLocalized('%d %b %Y %r') }}</p>
			<p><i class="fa fa-map-marker list-r-5"></i> {{ $event->location }}</p>
		</div>
		<!-- /.col -->

		<div class="col-sm-4 invoice-col">
				<p>Jumlah Peserta: <span class="badge">{{ $event->participants->count() }}</span></p>
				<p>Jumlah Agensi: <span class="badge">{{ $event->participants->groupBy('agency_id')->count() }}</span></p>
        </div>
        <!-- /.col -->
    </div>

	<div class="row">
		<div class="col-md-12">

		@foreach ($agencies as $date => $attendess)
			<h3>{{ $date }}</h3>

			<div class="table-responsive">
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th class="hidden-xs vert-align">#</th>
							<th class="vert-align">Agensi</th>
							<th class="hidden-xs vert-align">Singkatan</th>
						</tr>
					</thead>
					<tbody>

						@if (!count($attendess))
						<tr>
							<td colspan="3" class="text-center">
							<p>Tiada maklumat agensi.</p></td>
						</tr>
						@endif

						@foreach ($attendess as $key => $agency)
						<?php $key++ ?>
						<tr>
							<th scope="row" class="hidden-xs">{{ $key }}</th>
							<td>{{ $agency->name }}</td>
							<td class="hidden-xs">{{ $agency->short }}</td>
						</tr>

						@endforeach

					</tbody>
				</table>
			</div>
		@endforeach


		</div>
	</div>
@stop
