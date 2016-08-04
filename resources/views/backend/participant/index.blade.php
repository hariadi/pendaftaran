@extends('backend.layouts.master')

@section('page-header')
    <h1>
        {{ trans('menus.backend.participant.title') }}
        <a href="{{ route('admin.participant.create') }}" class="btn btn-primary"><i class="fa fa-calendar-plus-o"></i> Tambah Aktiviti</a>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Senarai Peserta</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">

        	<div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>{{ trans('labels.backend.participant.id') }}</th>
                        <th>{{ trans('labels.backend.participant.name') }}</th>
                        <th>{{ trans('labels.backend.participant.ic') }}</th>
                        <th>{{ trans('labels.backend.participant.agency') }}</th>
                        <th>{{ trans('labels.backend.participant.phone') }}</th>
                        <th>{{ trans('labels.backend.participant.email') }}</th>
                        <th>{{ trans('labels.backend.participant.job_title') }}</th>
                        <th>{{ trans('labels.backend.participant.grade') }}</th>
                        <th>{{ trans('labels.general.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($participants as $i => $participant)
                        	<?php ++$i; ?>
                            <tr>
                                <td>{!! $participant->id !!}</td>
                                <td><a href="{{ route('admin.participant.edit', $participant->id) }}">{!! $participant->name !!}</a></td>
                                <td>{!! $participant->ic !!}</td>
                                <td>{!! $participant->agency->name !!}</td>
                                <td>{!! $participant->email !!}</td>
                                <td>{!! $participant->phone !!}</td>
                                <td>{!! $participant->job_title !!}</td>
                                <td>{!! $participant->grade !!}</td>
                                <td>{!! $participant->action_buttons !!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pull-left">
                Paparan {!! $i !!} daripada {!! $participants->total() !!} {{ trans('labels.backend.participant.table.total') }}
            </div>

            <div class="pull-right">
                {!! $participants->render() !!}
            </div>

            <div class="clearfix"></div>

        </div><!-- /.box-body -->
    </div><!--box box-success-->
@endsection
