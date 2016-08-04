@extends('backend.layouts.master')

@section('page-header')
    <h1>
        {{ trans('menus.backend.event.title') }}
        <a href="{{ route('admin.event.create') }}" class="btn btn-primary"><i class="fa fa-calendar-plus-o"></i> Tambah Aktiviti</a>
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
                        @foreach ($events as $event)
                            <tr>
                                <td>{!! $event->id !!}</td>
                                <td><a href="{{ route('admin.report.event', $event->id) }}">{!! $event->name !!}</a></td>
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
            </div>

        </div><!-- /.box-body -->
    </div><!--box box-success-->
@endsection
