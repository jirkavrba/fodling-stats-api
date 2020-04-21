<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Folding stats admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<body>
<header>
    <nav class="teal">
        <div class="nav-wrapper">
            <div class="container">
                <a href="{{ route('administration.index') }}" class="brand-logo">Folding stats admin</a>

                @auth
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        {{--                        <li><a href="sass.html">Sass</a></li>--}}
                        {{--                        <li><a href="badges.html">Components</a></li>--}}
                        {{--                        <li><a href="collapsible.html">JavaScript</a></li>--}}
                    </ul>
                @endauth
            </div>
        </div>
    </nav>
</header>
<main>
    <div class="container">
        @yield('main')
    </div>
</main>
</body>
</html>
