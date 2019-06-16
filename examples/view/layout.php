<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>{{ title }}</title>

        {{ style('style.css') }}
        <script src="{{ assets('css/test.css') }}"></script>
    </head>
    <body>
        <header>
            <h1>{{ title }}</h1>
        </header>

        <main>
            @block content
                //
            @endblock
            
            @include credits
        </main>

        <footer>
            {{ date('Y') }} PHP-Template-Engine
        </footer>
        
        {{ script('script.js') }}
    </body>
</html>