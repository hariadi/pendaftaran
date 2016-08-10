@extends('backend.layouts.master')

@section ('title', trans('labels.backend.event.management') . ' | ' . $event->name)

@section('page-header')
    <h1>
        {{ trans('labels.backend.event.management') }}
        <small>{{ $event->name }}</small>
    </h1>
@endsection

@section('content')

<div class="row">

	<div class="col-xs-12">

		<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Maklumat Program <small>Pautan Daftar: <kbd>{{ url('e') . '/' . $event->token }}</kbd></small></h3>

        <div class="box-tools pull-right">
			<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		</div><!-- /.box-tools -->

        </div><!-- /.box-header -->
        <div class="box-body">

				<strong><i class="fa fa-clock-o margin-r-5"></i> Tarikh</strong>

				<p class="text-muted">
				{{ $event->start_at->formatLocalized('%d %b %Y %r') }} hingga {{ $event->end_at->formatLocalized('%d %b %Y %r') }}
				</p>

				<hr>

				<strong><i class="fa fa-map-marker margin-r-5"></i> Lokasi</strong>

				<p class="text-muted">
				{{ $event->location }}
				</p>

				<hr>

				<strong><i class="fa fa-info-circle margin-r-5"></i> Keterangan</strong>

				<p class="text-muted">
				{{ $event->description }}
				</p>

				<hr>

				<strong><i class="fa fa-user-secret margin-r-5"></i> Pegawai Penyelaras</strong>

				<p class="text-muted">
				{{ $event->user->name }} ({{ $event->user->email }}) {{ $event->user->phone }}
				</p>

        </div><!-- /.box-body -->
      </div><!-- /.box -->

		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Senarai Peserta</h3>
				<div class="pull-right">

					<a href="{{ route('event.show', $event->id) }}" class="btn btn-default"><i class="fa fa-globe"></i> Papar Kehadiran</a>

					<a href="{{ route('admin.report.event', $event->id) }}" class="btn btn-info"><i class="fa fa-bar-chart-o"></i> Papar Laporan</a>

					<a href="{{ route('admin.event.show', $event->id) }}" class="btn btn-success"><i class="fa fa-search"></i> Papar Semua Peserta</a>

					<a href="{{ route('event.add.participants', $event->id) }}" class="btn btn-primary"><i class="fa fa-user-plus"></i> Tambah Peserta</a>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
              <table id="participants" class="table table-bordered table-striped">
                <thead>
					<tr>
						<th rowspan="2" class="hidden-xs vert-align">#</th>
						<th rowspan="2" class="hidden-xs vert-align">Hapus</th>
						<th rowspan="2" class="vert-align">Nama</th>
						<th rowspan="2" class="vert-align"><abbr title="No. Kad Pengenalan">No. KP</abbr></th>
						<th rowspan="2" class="hidden-xs vert-align">Agensi</th>
						<th rowspan="2" class="hidden-xs vert-align">E-Mel</th>
						<th rowspan="2" class="hidden-xs vert-align">No. Telefon</th>
						<th colspan="{{ count($event->getDateRanges()) }}" class="text-center">Kehadiran</th>
					</tr>
					<tr>
						@foreach ($event->getDateRanges() as $date)
						<th class="text-center">{{ $date->formatLocalized('%d %b %Y') }}</th>
						@endforeach
					</tr>
				</thead>
                <tbody>

					@if (!count($event->participants))
					<tr>
						<td colspan="{{ 7 + count($event->getDateRanges()) }}" class="text-center">
						<p>Tiada maklumat peserta. <a href="{{ route('event.add.participants', $event->id) }}" class="btn btn-xs btn-success" data-toggle="tooltip" title="{{ trans('buttons.backend.event.addparticipants') }}"><i class="fa fa-user-plus"></i> Tambah Peserta?</a></p></td>
					</tr>
					@endif

					@foreach ($event->participants as $key => $participant)
					<?php $key++ ?>

					<tr>
						<th scope="row" class="hidden-xs">{{ $key }}</th>
						<th scope="row" class="hidden-xs">
							<a href="{{ route('admin.event.destroyParticipant', ['event' => $event->id, 'participant' => $participant->id]) }}" role="button" data-method="delete"
							data-trans-button-cancel="{{ trans('buttons.general.cancel') }}"
							data-trans-button-confirm="{{ trans('buttons.general.crud.delete') }}"
							data-trans-title="{{ trans('strings.backend.general.are_you_sure') }}"
							class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="{{ trans('buttons.general.crud.delete') }}"></i></a>
						</th>
						<td><a href="{{ route('admin.participant.edit', $participant->id) }}">{{ $participant->name }}</a></td>
						<td class="hidden-xs">{{ $participant->ic }}</td>
						<td class="hidden-xs"><abbr title="{{ $participant->agency->name }}">{{ $participant->agency->short }}</abbr></td>
						<td class="hidden-xs">{{ $participant->email }}</td>
						<td class="hidden-xs">{{ $participant->phone }}</td>
						@foreach ($event->getDateRanges() as $date)
						<td class="text-center">

			    			<button class="btn {{ $participant->isAttend($date) ? 'btn-success' : 'btn-warning' }} btn-sm btn-attend btn-block" data-event-id="{{ $event->id }}" data-participant-id="{{  $participant->id }}" data-attend-at="{{ $date->toDateTimeString() }}"><i class="fa fa-{{ $participant->isAttend($date) ? 'check' : 'close' }}"></i></button>

						</td>
						@endforeach
					</tr>
					@endforeach

				</tbody>
              </table>
            </div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>

</div>
@endsection

@section('after-styles-end')
	{!! Html::style('plugins/toastr/toastr.min.css') !!}
	{!! Html::style('plugins/datatables/dataTables.bootstrap.css') !!}
@stop


@section('after-scripts-end')
	{!! Html::script('plugins/toastr/toastr.min.js') !!}
	<!-- DataTables -->
	{!! Html::script('plugins/datatables/jquery.dataTables.min.js') !!}
	{!! Html::script('plugins/datatables/dataTables.bootstrap.min.js') !!}


	<script>
		$(function () {

			$('#participants').DataTable({
				language: {
				    sEmptyTable:      "Tiada data",
				    sInfo:            "Paparan dari _START_ hingga _END_ dari _TOTAL_ rekod",
				    sInfoEmpty:       "Paparan 0 hingga 0 dari 0 rekod",
				    sInfoFiltered:    "(Ditapis dari jumlah _MAX_ rekod)",
				    sInfoPostFix:     "",
				    sInfoThousands:   ",",
				    sLengthMenu:      "Papar _MENU_ rekod",
				    sLoadingRecords:  "Diproses...",
				    sProcessing:      "Sedang diproses...",
				    sSearch:          "Carian:",
				   sZeroRecords:      "Tiada padanan rekod yang dijumpai.",
				   oPaginate: {
				       sFirst:        "Pertama",
				       sPrevious:     "Sebelum",
				       sNext:         "Seterus",
				       sLast:         "Akhir"
				   },
				   oAria: {
				       sSortAscending:  ": diaktifkan kepada susunan lajur menaik",
				       sSortDescending: ": diaktifkan kepada susunan lajur menurun"
				   }
				}
			});

			toastr.options = {
				closeButton: true,
				debug: false,
				progressBar: true,
				positionClass: "toast-top-right",
				onclick: null,
				showDuration: "300",
				hideDuration: "1000",
				timeOut: "2000",
				extendedTimeOut: "1000",
				showEasing: "swing",
				hideEasing: "linear",
				showMethod: "fadeIn",
				hideMethod: "fadeOut"
			}

			$('#participants').on('click', '.btn-attend', function(e) {
				var that = this;

				$.post('{{ route("participant.event.attend") }}', {
					event_id: $(this).data('event-id'),
					participant_id: $(this).data('participant-id'),
					attend_at: $(this).data('attend-at'),
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
