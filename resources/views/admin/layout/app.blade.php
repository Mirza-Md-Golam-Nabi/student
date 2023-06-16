<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ auth()->user()->brand ?? ''}} - {{ $title }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('admin.includes.style')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.1.10.11.css') }}">

</head>

<body>

    @include('admin.includes.header')

    <div class="wrapper">

        @include('admin.includes.sidebar')

        <div class="content mb-4" id="content" onclick="sidebar()">
            <h4>{{ $title }}</h4>
            @yield('maincontent')

        </div>

    </div>
    @include('admin.includes.script')
    @include('admin.includes.scriptextra')

    @yield('extrascript')

</body>

</html>
