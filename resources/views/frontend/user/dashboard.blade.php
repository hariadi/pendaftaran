@extends('frontend.layouts.auth')

@section('content')
		<!-- Info boxes -->
      <div class="row">

        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-calendar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Aktiviti / Program</span>
              <span class="info-box-number">{{ $events->total() }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-4 col-sm-6 col-xs-12">
        <?php $participant = round(report($reports['attendance'], $reports['participant'] * 100), 2); ?>
          <div class="info-box {{ bgClass($participant) }}">
            <span class="info-box-icon"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Kehadiran (Peserta)</span>
              <span class="info-box-number">{{ $participant }}<small>%</small></span>
              <div class="progress">
                <div class="progress-bar" style="width: {{ $participant }}%"></div>
              </div>
              <span class="progress-description">{{ $reports['attendance'] }} / {{ $reports['participant'] }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-4 col-sm-6 col-xs-12">

        	<?php $agency = round(report($reports['agency_attend'], $reports['agency_total'] * 100), 2); ?>

          <div class="info-box {{ bgClass($agency) }}">
            <span class="info-box-icon"><i class="fa fa-bank"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Kehadiran (Agensi)</span>
              <span class="info-box-number">{{ $agency }}<small>%</small></span>

              <div class="progress">
                <div class="progress-bar" style="width: {{ $agency }}%"></div>
              </div>
              <span class="progress-description">{{ $reports['agency_attend'] }} / {{ $reports['agency_total'] }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
      	<div class="box box-success">
	        <div class="box-header with-border">
	            <h3 class="box-title">Senarai Aktiviti / Program</h3>

	            @if (request()->has('by'))
	            	<a href="{{ route('frontend.user.dashboard') }}" role="button" class="btn btn-primary">Papar aktiviti saya sahaja</a>
	            @else
	            	<a href="{{ route('frontend.user.dashboard', ['by' => 'all']) }}" role="button" class="btn btn-primary">Papar semua aktiviti</a>
	            @endif

	            <div class="box-tools pull-right">
	                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	            </div><!-- /.box tools -->
	        </div><!-- /.box-header -->
	        <div class="box-body">

	        	<div class="table-responsive">
	                <table class="table table-striped table-bordered table-hover">
	                    <thead>
	                    <tr>
	                        <th>{{ trans('labels.backend.event.id') }}</th>
	                        <th>{{ trans('labels.backend.event.title') }}</th>
	                        <th>{{ trans('labels.backend.event.start') }}</th>
	                        <th>{{ trans('labels.backend.event.end') }}</th>
	                        <th>{{ trans('labels.backend.event.participants') }}</th>
	                        <th>{{ trans('labels.backend.event.days') }}</th>
	                        <th>{{ trans('labels.general.actions') }}</th>
	                    </tr>
	                    </thead>
	                    <tbody>
	                    <?php $index = 0 ?>
	                        @foreach ($events as $index => $event)
	                        <?php ++$index; ?>
	                            <tr>
	                                <td>{!! $event->id !!}</td>
	                                <td>{!! $event->status_link !!} {!! $event->addparticipant_button !!}</td>
	                                <td>{!! $event->start_at->diffForHumans() !!}</td>
	                                <td>{!! $event->end_at->diffForHumans() !!}</td>
	                                <td>
	                                    @if ($event->participants->count() > 0)
	                                    	{!! $event->participants->count() !!}
	                                    @else
	                                        {{ trans('labels.general.none') }}
	                                    @endif
	                                </td>
	                                <td>{!! $event->getTotalDay() !!}</td>
	                                <td>{!! $event->action_buttons !!}</td>
	                            </tr>
	                        @endforeach
	                    </tbody>
	                </table>

	                <div class="pull-left">
			            {{ $index }} daripada {!! $events->total() !!} Aktiviti
			        </div>

			        <div class="pull-right">
			            {!! $events->render() !!}
			        </div>

			        <div class="clearfix"></div>
	            </div>

	        </div><!-- /.box-body -->
	    </div><!--box box-success-->
      </div><!--row-->


    <div class="row">

        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('navs.frontend.dashboard') }}</div>

                <div class="panel-body">
                    <div role="tabpanel">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">{{ trans('navs.frontend.user.my_information') }}</a>
                            </li>
                        </ul>

                        <div class="tab-content">

                            <div role="tabpanel" class="tab-pane active" id="profile">
                                <table class="table table-striped table-hover table-bordered dashboard-table">
                                    <tr>
                                        <th>{{ trans('labels.frontend.user.profile.avatar') }}</th>
                                        <td><img src="{!! $user->picture !!}" class="user-profile-image" /></td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('labels.frontend.user.profile.name') }}</th>
                                        <td>{!! $user->name !!}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('labels.frontend.user.profile.email') }}</th>
                                        <td>{!! $user->email !!}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('labels.frontend.user.profile.created_at') }}</th>
                                        <td>{!! $user->created_at !!} ({!! $user->created_at->diffForHumans() !!})</td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('labels.frontend.user.profile.last_updated') }}</th>
                                        <td>{!! $user->updated_at !!} ({!! $user->updated_at->diffForHumans() !!})</td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('labels.general.actions') }}</th>
                                        <td>
                                            <a href="{!! route('frontend.user.profile.edit') !!}" class="btn btn-primary btn-xs">{{ trans('labels.frontend.user.profile.edit_information') }}</a>

                                            @if ($user->canChangePassword())
                                                <a href="{!! route('auth.password.change') !!}" class="btn btn-warning btn-xs">{{ trans('navs.frontend.user.change_password') }}</a>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div><!--tab panel profile-->

                        </div><!--tab content-->

                    </div><!--tab panel-->

                </div><!--panel body-->

            </div><!-- panel -->

        </div><!-- col-md-10 -->

    </div><!-- row -->
@endsection
