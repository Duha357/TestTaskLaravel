<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Список статей</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </head>
    <body>
        <ul id="menu">

        </ul>

        <h1>Список статей</h1>

        @if (count($articles) != 0)
        <table class="table table-striped ">
            <thead>
            <tr>
                <th>Заголовоки</th>
            </tr>
            </thead>
            <tbody>
            @foreach($articles as $article)
            <tr>
                <td><a href="{{ route('articles.get', ['id' => $article->id]) }}">{{ $article->topic }}</a> <th>{{ $article->created_at }}</th></td>
            </tr>
            @endforeach
            </tbody>
        </table>
        {{ $articles->links() }}
        @else
        <div>
            <h3>Записей нет</h3>
        </div>
        @endif

        <script>
            $(function() {
                $(document).on('ready', function() {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "{{ route('get_links') }}",
                        type: "GET",
                        success: function (data) {
                            $.each(data['links'], function(key, value){
                                var link = $(location).attr("origin") + '/' + value.route_name;
                                $("#menu").append("<li><a class='menu__item' href='" + link + "'>" + value.title + "</a></li>");
                            });

                            $(function() {
                                var href_url = window.location.href;

                                $(".menu__item").each(function() {
                                    var link = $(this).find('a').attr("href");
                                    if(this.href == href_url) {
                                        $(this).css('color', 'red');
                                    }
                                });
                            });
                        },
                        error: function (msg) {
                            $("#articles").append("Ошибка создания меню");
                        }
                    });
                });
            })
        </script>
    </body>
</html>
