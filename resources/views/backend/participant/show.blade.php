@extends('backend.layouts.master')

@section ('title', trans('labels.backend.participant.management') . ' | ' . $participant->name)

@section('page-header')
    <h1>
    	{{ $participant->name }}
        <small>{{ trans('labels.backend.participant.management') }}</small>
    </h1>
@endsection

@section('content')

<div class="row">
	<div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">

              <h3 class="profile-username text-center">{{ $participant->name }}</h3>

              <p class="text-muted text-center">{{ $participant->agency->name }}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Aktiviti</b> <a class="pull-right">{{ $participant->attendances->count() }}</a>
                </li>
              </ul>

              <a href="{{ route('admin.participant.edit', $participant->id) }}" class="btn btn-primary btn-block"><b>Kemaskini</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Maklumat Peserta</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> E-Mel</strong>

              <p class="text-muted">
                {{ $participant->email }}
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Telefon</strong>

              <p class="text-muted">{{ $participant->phone }}</p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Alamat</strong>

              <p class="text-muted">{{ $participant->address }}</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

        <div class="col-md-9">
        	<div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Senarai Kehadiran</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
            	<table class="table table-hover">
                <tr>
                	<th>Bil.</th>
                  <th>Aktiviti</th>
                  <th>Kehadiran</th>
                </tr>
                @foreach ($participant->events as $i => $event)
                <?php ++$i; ?>

                <tr>
                <td>{{ $i }}</td>
                  <td>{{ $event->name }}</td>
                  <td>

                    @foreach ($event->getDateRanges() as $date)

                    <span class="btn {{ $participant->isAttend($date) ? 'btn-success' : 'btn-warning' }} btn-sm "><i class="fa fa-{{ $participant->isAttend($date) ? 'check' : 'close' }}"></i> {{ $date->formatLocalized('%d %B %Y %r') }}</span>

                    @endforeach
                  </td>
                </tr>
                @endforeach
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

</div>
@endsection
