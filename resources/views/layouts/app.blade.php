<!DOCTYPE html>
<html>
    <head>
        <title>{{config('app.name')}}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @section('assets')
            @include('layouts.assets')
        @show
    </head>
    <body>
        <div class="container-fluid">
            @yield('content')
        </div>
    </body>
</html>
