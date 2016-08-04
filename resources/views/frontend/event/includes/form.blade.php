<div class="col-md-7">

					<div class="form-group required {{ $errors->has('categories') ? 'has-error has-feedback' : '' }}">
						{!! Form::label('categories', 'Kategori', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
						{!! Form::selectCategory('categories[]', isset($event) ? $event->categories->lists('id')->toArray() : null, [
							'id' => 'categories',
							'class' => 'form-control',
							'multiple' => 'multiple'
						]) !!}
						</div>
					</div>

						<!-- form-group -->
						<div class="form-group {{ $errors->has('name') ? 'has-error has-feedback' : '' }}">
						{!! Form::label('name', 'Nama Aktiviti', ['class' => 'col-sm-2 control-label']) !!}
							<div class="col-sm-10">
								{!! Form::text('name', null, [
									'class' => 'form-control',
									'placeholder' => 'Nama aktiviti, pendek dan jelas'
								]) !!}
							</div>
						</div>

						<!-- form-group -->
						<div class="form-group {{ $errors->has('location') ? 'has-error has-feedback' : '' }}">
						{!! Form::label('location', 'Lokasi / Tempat', ['class' => 'col-sm-2 control-label']) !!}
							<div class="col-sm-10">
								{!! Form::textarea('location', null, [
									'rows' => 3,
									'class' => 'form-control',
									'placeholder' => 'Alamat atau nama dewan / bangunan'
								]) !!}
							</div>
						</div>

						<!-- form-group -->
						<?php $start = \Carbon\Carbon::createFromTime(8); ?>
						<div class="form-group {{ $errors->has('start_at') ? 'has-error has-feedback' : '' }}">
						{!! Form::label('start_at', 'Mula', ['class' => 'col-sm-2 control-label']) !!}
							<div class="col-sm-6">

								<div class="input-group">
									{!! Form::text('start_at', null, [
										'class' => 'form-control',
										'placeholder' => $start->toDateTimeString()
									]) !!}

									<div class="input-group-btn">
										<button class="btn btn-primary btn-date" type="button"><i class="fa fa-calendar"></i></button>
									</div>
								</div>
							</div>
						</div>

						<!-- form-group -->
						<div class="form-group {{ $errors->has('end_at') ? 'has-error has-feedback' : '' }}">
						{!! Form::label('end_at', 'Tamat', ['class' => 'col-sm-2 control-label']) !!}
							<div class="col-sm-6">
								<div class="input-group">
									{!! Form::text('end_at', null, [
										'class' => 'form-control',
										'placeholder' => $start->addHours(8)->toDateTimeString()
									]) !!}

									<div class="input-group-btn">
										<button class="btn btn-primary btn-date" type="button"><i class="fa fa-calendar"></i></button>
									</div>
								</div>
							</div>
						</div>

						<!-- form-group -->
						<div class="form-group">
						{!! Form::label('photo', 'Gambar', ['class' => 'col-sm-2 control-label']) !!}
							<div class="col-sm-10">
								{!! Form::file('photo', null, [
									'class' => 'form-control',
								]) !!}
								@if ( isset($event) && $event->photo )
								<br>
								<img src="{{ $event->photo }}" class="img-responsive img-thumbnail img-event" style="height: 200px">
								@endif
							</div>

						</div>

						<!-- form-group -->
						<div class="form-group">
						{!! Form::label('description', 'Keterangan', ['class' => 'col-sm-2 control-label']) !!}
							<div class="col-sm-10">
								{!! Form::textarea('description', null, [
									'rows' => 5,
									'class' => 'form-control',
									'placeholder' => 'Keterangan berkenaan aktiviti ini'
								]) !!}
							</div>
						</div>


					</div><!-- /.col-md-7 -->

					<div class="col-md-5">

						<h3 class="page-header">Notifikasi</h3>
						<div class="form-group">
						{!! Form::label('options.notification.owner', 'E-mel Urus Setia', ['class' => 'sr-only']) !!}
							<div class="col-sm-12">
								<div class="checkbox">
									<label>
										{!! Form::checkbox('options[notification][owner]', 1, isset($options) ? array_has($options, 'notification.owner') : true, ['id' => 'options.notification.owner']) !!}  Hantar e-mel pemakluman kepada urus setia setelah peserta mengisi borang pendaftaran
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
						{!! Form::label('options.notification.participant', 'E-mel Urus Setia', ['class' => 'sr-only']) !!}
							<div class="col-sm-12">
								<div class="checkbox">
									<label>
										{!! Form::checkbox('options[notification][participant]', 1, isset($options) ?array_has($options, 'notification.participant') : true, ['id' => 'options.notification.participant']) !!}  Hantar e-mel pemakluman kepada peserta berkenaan butiran aktiviti selepas mendaftar
									</label>
								</div>
							</div>
						</div>

						<h3 class="page-header">Kehadiran</h3>
						<div class="form-group">
						{!! Form::label('options.attendant', 'Kehadiran', ['class' => 'col-sm-2 control-label']) !!}
							<div class="col-sm-10">
								<div class="checkbox">
									<label>
										{!! Form::checkbox('options[attendant]', 1, isset($options) ? array_has($options, 'attendant') : true, ['id' => 'options.attendant']) !!}  Ambil kedatangan peserta mengikut hari
									</label>
									<p class="help-block">Kedatangan akan diambil secara atas talian setiap hari sepanjang tempoh berlangsungnya aktiviti.</p>
								</div>
							</div>
						</div>

						<h3 class="page-header">Sosial</h3>
						<!-- form-group -->
						<div class="form-group">
						{!! Form::label('options.share', 'Share', ['class' => 'col-sm-2 control-label']) !!}
							<div class="col-sm-10">

								<div class="checkbox">
									<label>
										{!! Form::checkbox('options[share][facebook]', 1, isset($options) ? array_has($options, 'share.facebook') : true) !!}  Facebook
									</label>
								</div>
								<div class="checkbox">
									<label>
										{!! Form::checkbox('options[share][twitter]', 1, isset($options) ? array_has($options, 'share.twitter') : true) !!}  Twitter
									</label>
								</div>
								<div class="checkbox">
									<label>
										{!! Form::checkbox('options[share][gplus]', 1, isset($options) ? array_has($options, 'share.gplus') : true) !!}  Google Plus
									</label>
								</div>
								<p class="help-block">Membolehkan pengguna membuat perkongsian sosial melalui butang yang disediakan.</p>
							</div>
						</div>

					</div>
