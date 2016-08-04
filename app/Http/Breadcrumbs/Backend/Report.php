<?php

Breadcrumbs::register('admin.report.index', function ($breadcrumbs) {
	$breadcrumbs->parent('admin.dashboard');
	$breadcrumbs->push(trans('menus.backend.report.management'), route('admin.report.index'));
});
