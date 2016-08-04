@extends($print ? 'backend.layouts.print' : 'backend.layouts.master')

@section ('title', trans('labels.backend.report.management'))

@section('page-header')
    <h1>
        Laporan Peserta Tidak Hadir
        @if (!$print)
		<small class="hidden-print">
			<a href="{{ route('admin.report.event', ['id' => $event->id, 'action' => 'print']) }}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-print"></i> Cetak</a>
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
		@foreach ($event->getDateRanges() as $date)
			<h3>{{ $date->formatLocalized('%d %b %Y') }} ({{ $date->formatLocalized('%A') }})</h3>
			<div class="table-responsive">
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th class="hidden-xs vert-align">#</th>
							<th class="vert-align">Nama</th>
							<th class="vert-align"><abbr title="No. Kad Pengenalan">No. KP</abbr></th>
							<th class="hidden-xs vert-align">Agensi</th>
							<th class="hidden-xs vert-align">E-Mel</th>
							<th class="hidden-xs vert-align">No. Telefon</th>
						</tr>
					</thead>
					<tbody>

						@if (!count($event->participants))
						<tr>
							<td colspan="7" class="text-center">
							<p>Tiada maklumat peserta.</p></td>
						</tr>
						@endif

						@foreach ($event->participants as $key => $participant)
						<?php $key++ ?>
						<?php $filter = $attend ? $participant->isAttend($date) : !$participant->isAttend($date); ?>
						@if ($filter)
						<tr>
							<th scope="row" class="hidden-xs">{{ $key }}</th>
							<td><a href="{{ route('admin.participant.edit', $participant->id) }}">{{ $participant->name }}</a></td>
							<td class="hidden-xs">{{ $participant->ic }}</td>
							<td class="hidden-xs"><abbr title="{{ $participant->agency->name }}">{{ $participant->agency->short }}</abbr></td>
							<td class="hidden-xs">{{ $participant->email }}</td>
							<td class="hidden-xs">{{ $participant->phone }}</td>
						</tr>
						@endif

						@endforeach

					</tbody>
				</table>
			</div>
		@endforeach

		</div>
	</div>
@stop

@section('after-styles-end')
	{!! Html::style('plugins/toastr/toastr.min.css') !!}
@stop

@section('after-scripts-end')
    {!! Html::script('plugins/toastr/toastr.min.js') !!}

    <script>
    	$(function () {
    		toastr.options = {
		        "closeButton": true,
		        "debug": false,
		        "positionClass": "toast-top-right",
		        "onclick": null,
		        "showDuration": "300",
		        "hideDuration": "1000",
		        "timeOut": "2000",
		        "extendedTimeOut": "1000",
		        "showEasing": "swing",
		        "hideEasing": "linear",
		        "showMethod": "fadeIn",
		        "hideMethod": "fadeOut"
		    }


		    $('#helper-modal').load('/smp/help/keys', function () {
				$(this).modal('show');
			});

            $('.btn-attend').on('click', function(e) {
            	var that = this;

            	$.post('{{ route("participant.event.attend") }}', {
					event_id: $(this).data('event-id'),
	                participant_id: $(this).data('participant-id'),
	                attend_at: $(this).data('attend-at'),
	            }, function(data) {

	                if (data.result) {

	                    if (data.action == 'delete') {
	                    	toastr.warning(data.status, data.subject);
	                    	$(that).toggleClass('btn-success btn-warning');
	                    	$(that).find('i').toggleClass('fa-check fa-close');

	                    } else if (data.action == 'add') {
	                    	toastr.success(data.status, data.subject);
	                    	$(that).toggleClass('btn-warning btn-success');
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
