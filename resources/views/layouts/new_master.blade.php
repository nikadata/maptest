<!DOCTYPE html>
<html lang="en">
<head>
@include('layouts.partials.test_head')
</head>

<body>
@include('layouts.partials.nav')
<div class="container">
@yield('content')
</div>
@include('layouts.partials.test_footer-scripts')
</body>

</html>
