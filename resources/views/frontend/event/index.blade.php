@extends('frontend.layouts.master')

@section('content')
    <div class="row">

	    <div class="col-md-9 col-md-push-3">
	    	@if (count($events))

	    	@if (request('view') == 'grid')


			@foreach ($events->chunk(3) as $grids)

			<div class="row margin-b20">

				@foreach ($grids as $i => $event)
				<?php $i++; ?>
				<div class="col-sm-6 col-md-4">
					<div class="event-list">
						<div class="event">

							<time datetime="{{ $event->start_at->toDateString() }}">
                                <span class="day">{{ $event->start_at->format('d') }}</span>
                                <span class="month">{{ $event->start_at->formatLocalized('%b') }}</span>
                                <span class="year">{{ $event->start_at->format('Y') }}</span>
                                <span class="time">{{ $event->start_at->format('h:i:s A') }}</span>
                            </time>
                            @if ($event->photo)
                            <img alt="{{ $event->name }}" src="{{ $event->photo }}" />
                            @endif
                            <div class="info">
                                <small class="when"><i class="fa fa-clock-o"></i> {{ $event->start_at->formatLocalized('%d %b %Y %r') }}</small>
                                <h2 class="what">{!! $event->getNameLabel() !!}</h2>
                                <p class="where"><i class="fa fa-map-marker"></i> {{ $event->location }}</p>
                                <ul>
                                    <li style="width:33%;"><span class="fa fa-hourglass-end"></span> {{ $event->duration }}</li>

                                    <li style="width:33%;"><span class="fa fa-users"></span> {{ $event->participants->count() }}</li>
                                </ul>
                            </div>
                            @if ($event->isSocialable())
                            <div class="social">
                                <ul>
                                    <li class="facebook" style="width:33%;">{!! $event->getFacebookShare() !!}</li>
                                    <li class="twitter" style="width:34%;">{!! $event->getTwitterShare() !!}</li>
                                    <li class="google-plus" style="width:33%;">{!! $event->getGplusShare() !!}</li>
                                </ul>
                            </div>
                            @endif

						</div>
					</div>
				</div>
				@endforeach

			</div>
			@endforeach

			@else

	    	<ul class="event-list">
		    	@foreach ($events as $i => $event)
		    	<?php $i++; ?>
	    		<li>
					<time datetime="{{ $event->start_at->toDateString() }}">
						<span class="day">{{ $event->start_at->format('d') }}</span>
						<span class="month">{{ $event->start_at->formatLocalized('%b') }}</span>
						<span class="year">{{ $event->start_at->format('Y') }}</span>
						<span class="time">{{ $event->start_at->format('h:i:s A') }}</span>
					</time>
					@if ($event->photo)
					<img alt="{{ $event->name }}" src="{{ $event->photo }}" />
					@endif
					<div class="info">
						<small class="when"><i class="fa fa-clock-o"></i> {{ $event->start_at->formatLocalized('%d %b %Y %r') }}</small>
						<h2 class="what">{!! $event->getNameLabel() !!}</h2>
						<p class="where"><i class="fa fa-map-marker"></i> {{ $event->location }}</p>
						<ul>
							<li style="width:33%;"><span class="fa fa-hourglass-end"></span> {{ $event->duration }}</li>

							<li style="width:33%;"><span class="fa fa-users"></span> {{ $event->participants->count() }}</li>
						</ul>
					</div>
					@if ($event->isSocialable())
					<div class="social">
						<ul>
							<li class="facebook" style="width:33%;">{!! $event->getFacebookShare() !!}</li>
							<li class="twitter" style="width:34%;">{!! $event->getTwitterShare() !!}</li>
							<li class="google-plus" style="width:33%;">{!! $event->getGplusShare() !!}</li>
						</ul>
					</div>
					@endif
				</li>
				@endforeach
		    </ul>

		    @endif

		    <div class="row">
				<div class="col-sm-12">
					{{ trans('site.event.total', ['count' => $i, 'total' => $events->total()]) }}
				</div>
				<div class="col-sm-12 text-center">
					{!! $events->appends($requests)->render() !!}
				</div>
			</div>

			@else
			<p class="text-center">{{ trans('site.no_event') }}</p>
			@endif


	    </div>
	    <div class="col-md-3 col-md-pull-9">
	    	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			  <div class="panel panel-default">
			    <div class="panel-heading" role="tab" id="eventCategory">
			      <h4 class="panel-title">
			        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseCategory" aria-expanded="true" aria-controls="collapseCategory">
			          {{ trans('site.category') }}
			          <small class="pull-right"><i class="fa fa-caret-down"></i></small>
			        </a>
			      </h4>
			    </div>
			    <div id="collapseCategory" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="eventCategory">
			      <div class="list-group">
					  <a href="{{ route('frontend.index', request()->except('cat')) }}" class="list-group-item {{ in_array(request('cat'), request()->query()) ? '' : 'active'}}">
					    Semua
					  </a>

					  @foreach	($categories as $category)
					  <a href="{{ route('frontend.index', array_merge($requests, ['cat' => $category->slug])) }}" class="list-group-item {{ (request('cat') == $category->slug) ? 'active' : '' }}">{{ $category->name }}</a>
					  @endforeach

					</div>
			    </div>
			  </div>
			  <div class="panel panel-default">
			    <div class="panel-heading" role="tab" id="headingWhen">
			      <h4 class="panel-title">
			        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseWhen" aria-expanded="true" aria-controls="collapseWhen">
			          {{ trans('site.when') }}
			          <small class="pull-right"><i class="fa fa-caret-down"></i></small>
			        </a>
			      </h4>
			    </div>
			    <div id="collapseWhen" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingWhen">
			      <div class="list-group">

					  <a href="{{ route('frontend.index', request()->except('when')) }}" class="list-group-item {{ in_array(request('when'), request()->query()) ? '' : 'active'}}">
					    Semua
					  </a>

					  @foreach ($whens as $when)
					  <a href="{{ route('frontend.index', array_merge($requests, ['when' => $when])) }}" class="list-group-item {{ (request('when') == $when) ? 'active' : '' }}">{{ trans('site.event.' . $when) }}</a>
					  @endforeach

					</div>
			    </div>
			    </div>
			  </div>
			   <a class="btn btn-info btn-block" href="{{ route('frontend.index') }}">Reset</a>
			</div>
	    </div>
</div>
@endsection

@section('after-scripts-end')
	<script>
    	$(function () {

			function toggleCaret(e) {
			    $(e.target).prev('.panel-heading').find('i').toggleClass('fa-caret-down fa-caret-left');
			}

			$('#accordion').on('hidden.bs.collapse', toggleCaret);
			$('#accordion').on('shown.bs.collapse', toggleCaret);
    	});
    </script>
@stop
