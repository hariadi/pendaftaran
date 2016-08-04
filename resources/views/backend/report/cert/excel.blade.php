@extends('backend.layouts.excel')

@section ('title', trans('labels.backend.report.management') . ' | ' . $event->title)

@section('page-header')
    <h1>
        {{ trans('menus.backend.report.title') }}
    </h1>
@endsection

@section('cssClass', 'invoice')

@section('content')

	<div class="row">
		<div class="col-md-12">

			<div class="table-responsive">
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th class="vert-align">Nama</th>
							<th class="vert-align"><abbr title="No. Kad Pengenalan">No. KP</abbr></th>
							<th class="text-center">Kehadiran</th>
						</tr>
					</thead>
					<tbody>

						@if (!count($event->participants))
						<tr>
							<td colspan="7" class="text-center">
							<p>Tiada maklumat peserta.</p></td>
						</tr>
						@endif

						@foreach ($event->participants as $participant)

						<tr>
							<td>{{ $participant->name }}</td>
							<td class="hidden-xs">{{ $participant->ic }}</td>

							<td class="text-center">

								{{ attend($event, $attendances[$participant->id]) }}

							</td>

						</tr>
						@endforeach

					</tbody>
				</table>
			</div>
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
