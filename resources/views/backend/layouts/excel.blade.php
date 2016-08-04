<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title', app_name())</title>

	<!-- Meta -->
	<meta name="description" content="@yield('meta_description', 'Default Description')">
	<meta name="author" content="@yield('meta_author', 'Jabatan Perkhidmatan Awam')">
	@yield('meta')

</head>
<body>

	<div class="container-fluid">
		<!-- Main content -->
		<section class="@yield('cssClass', 'content')">
			@yield('content')
		</section><!-- /.content -->

	</div>
</body>
</html>
