<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Head contents -->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <!-- Vue app will mount here -->
</div>
<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
