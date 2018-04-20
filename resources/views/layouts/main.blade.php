<html>
<head>
    <link href="{{ asset('css/app.css') }}" media="all" rel="stylesheet" type="text/css" />
    <title>@yield('title')</title>
</head>
<body>
<div class="container" id="app">
    @yield('content')
</div>

<script>
  window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
</script>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

</body>
</html>