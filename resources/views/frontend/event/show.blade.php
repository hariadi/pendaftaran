@extends('frontend.layouts.master')

@section('title', $event->name)

@section('container', 'container-fluid')

@section('content')

<!-- Jumbotron -->
<div class="jumbotron" id="event{{ $event->id }}">
	<h1>{!! $event->getNameEditLabel() !!}</h1>
	<div class="collapse in" id="collapseInfo">
		<div class="cover">
			<p class="lead">{!! $event->description !!}</p>
			<div class="text-normal">
			    <p><i class="fa fa-calendar margin-r-5"></i> {{ $event->start_at->formatLocalized('%d %b %Y %r') }} hingga {{ $event->end_at->formatLocalized('%d %b %Y %r') }}</p>
				<p><i class="fa fa-map-marker margin-r-5"></i> <a href="https://maps.google.com/?q={{ $event->location }}">{{ $event->location }}</a></p>
			</div>
		</div>

	</div>
</div>

@if (!Auth::guest())
<div class="row">
    <div class="col-md-12">

		<div class="row">
			<div class="col-md-12">
				<p>

				<div class="row">
					<div class="col-md-6">
						<a href="#collapseInfo" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapseInfo" class="btn btn-success"><i class="fa fa-info-circle"></i> Papar Info Program</a>

						<a href="{{ route('event.add.participants', $event->id) }}" class="btn btn-primary"><i class="fa fa-user-plus"></i> Tambah Peserta</a>

						<a href="{{ route('admin.report.event', $event->id) }}" class="btn btn-default"><i class="fa fa-bar-chart-o"></i> Laporan</a>
					</div>
					<div class="col-md-6">

						<div class="input-group input-group-sm">

							<input id="eventUrl" class="pull-left form-control" value="{{ $event->token_url }}" aria-label="Pautan pendaftaran peserta" readonly="" type="text">

							<span class="input-group-btn">
								<button type="button" class="btn btn-info btn-flat btn-clip" data-clipboard-target="#eventUrl"><i class="fa fa-copy"></i> Salin</button>
							</span>
						</div>

					</div>
				</div>

					{{-- <a data-toggle="modal" data-target="#addParticipant" href="{{ route('event.add.participants', $event->id) }}" class="btn btn-primary"><i class="fa fa-user-plus"></i> Tambah Peserta</a> --}}
				</p>
			</div>
		</div>

    	<div class="">
	    	<table id="participants" class="table table-bordered table-striped">
	    		<thead>
		    		<tr>

			    		<th class="hidden-xs vert-align">#</th>
			    		<th class="vert-align">Nama</th>
			    		<th class="hidden-xs vert-align"><abbr title="No. Kad Pengenalan">No. KP</abbr></th>
			    		<th class="hidden-xs hidden-md vert-align">Agensi</th>
			    		<th class="hidden-xs hidden-md vert-align">E-Mel</th>
			    		<th class="hidden-xs hidden-md vert-align">No. Telefon</th>

			    		@if ($event->isPast())

							@foreach ($event->getDateRanges() as $date)
							<th class="text-center">{{ $date->formatLocalized('%d %b %Y') }}</th>
							@endforeach

			    		@else
			    			<th class="text-center">{{ $event->start_at->formatLocalized('%d %b %Y') }}</th>
			    		@endif

		    		</tr>


	    		</thead>
		    	<tbody>

		    		@if (!count($event->participants))
		    		<tr>
		    			<td colspan="7" class="text-center">
		    			<p>Tiada maklumat peserta.</p></td>
		    		</tr>
		    		@else

		    		@foreach ($event->participants as $key => $participant)
		    		<?php $key++ ?>

		    		<tr>
			    		<th scope="row" class="hidden-xs">{{ $key }}</th>
			    		<td>
			    		@if (auth()->user())
			    			<a href="{{ route('participant.event.edit', [
			    				'participant' => $participant->id,
			    				'event' => $event->id,
			    			]) }}">{{ $participant->name }}</a>
			    		@else
			    			<a href="{{ route('event.add.participant', $event->id) }}">{{ $participant->name }}</a>
			    		@endif
			    		</td>
			    		<td>{{ $participant->ic }}</td>
			    		<td class="hidden-xs"><abbr title="{{ $participant->agency->name }}">{{ $participant->agency->short }}</abbr></td>
			    		<td class="hidden-xs">{{ $participant->email }}</td>
			    		<td class="hidden-xs">{{ $participant->phone }}</td>

				    	@if ($event->isPast())

				    		@foreach ($event->getDateRanges() as $date)
							<td class="text-center {{ $participant->isAttend($date) ? 'bg-success' : 'bg-warning' }}">
								<i class="fa fa-{{ $participant->isAttend() ? 'check' : 'close' }}"></i>
							</td>
							@endforeach

						@else

							<td class="text-center">

								@if ($event->isOnGoing())

				    			<button class="btn {{ $participant->isAttend() ? 'btn-success' : 'btn-warning' }} btn-sm btn-attend btn-block" data-html="true" data-event-id="{{ $event->id }}" data-participant-id="{{  $participant->id }}"><i class="fa fa-{{ $participant->isAttend() ? 'check' : 'close' }}"></i></button>

				    			@else

				    			<button class="btn bt-default btn-sm btn-block"><i class="fa fa-clock-o"></i> Belum dibuka</button>


				    			@endif

					    	</td>

				    	@endif

		    		</tr>
		    		@endforeach
		    		@endif
		    	</tbody>
	    	</table>

			<p class="help-block"><i>Nota: Pendaftaran dibuka awal sejam dari tarikh mula program/aktiviti</i></p>

    	</div>
    </div>
</div>
@endif

<div id="addParticipant" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addParticipantModalLabel" aria-hidden="true"></div>

@endsection

@section('after-styles-end')
	{!! Html::style('plugins/toastr/toastr.min.css') !!}
	{!! Html::style('plugins/datatables/dataTables.bootstrap.css') !!}
	@if ($event->photo)
	<style type="text/css">
		.jumbotron p {
		    font-size: 23px;
		    font-weight: 400;
		}
		.cover {
			color: yellow;
			padding: 18px;
			background-color:rgba(0, 0, 0, 0.9);
		}

		#event{{ $event->id}} {
			background: url({{ $event->photo }}) no-repeat top center fixed;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		}
	</style>
	@endif
@stop

@if (!Auth::guest())
@section('after-scripts-end')
    {!! Html::script('plugins/toastr/toastr.min.js') !!}
    <!-- DataTables -->
    @if ($event->participants->count() > 0)
	{!! Html::script('plugins/datatables/jquery.dataTables.min.js') !!}
	{!! Html::script('plugins/datatables/dataTables.bootstrap.min.js') !!}
	@endif
    {!! Html::script('plugins/clipboardjs/clipboard.min.js') !!}

    <script>
    	$(function () {

    		$('.btn-clip').tooltip({
			  trigger: 'click',
			  placement: 'bottom'
			});

			function setTooltip(btn, message) {
			  $(btn).tooltip('hide')
			    .attr('data-original-title', message)
			    .tooltip('show');
			}

			function hideTooltip(btn) {
			  setTimeout(function() {
			    $(btn).tooltip('hide');
			  }, 3000);
			}

    		var clipboard = new Clipboard('.btn-clip');

    		clipboard.on('success', function(e) {
			  setTooltip(e.trigger, 'Disalin!');
			  hideTooltip(e.trigger);
			});

			clipboard.on('error', function(e) {
			  setTooltip(e.trigger, 'Gagal disalin!');
			  hideTooltip(e.trigger);
			});

    		$('[data-target="#addParticipant"]').on('click', function(e) {
				$('#addParticipant').load('{{ route('admin.event.modal') }}', function () {
					$(this).modal('show');
				});
			});

    		toastr.options = {
		        closeButton: true,
		        debug: false,
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

		    @if ($event->participants->count() > 0)
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

            $('#participants').on('click', '.btn-attend', function(e) {
            	var that = this;

            	$.post('{{ route("participant.event.attend") }}', {
					event_id: $(this).data('event-id'),
	                participant_id: $(this).data('participant-id'),
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
			@endif
        });
    </script>
@stop
@endif
