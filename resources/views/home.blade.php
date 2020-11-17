<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Главная страница</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </head>
    <body>
        <ul id="menu">

        </ul>

        <h1>Главная страница</h1>

        <table class="table table-striped ">
            <thead>
            <tr>
                <th>Последние статьи</th>
            </tr>
            </thead>
            <tbody id="articles">
            </tbody>
        </table>

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

        <script>
            $(function() {
                $(document).on('ready', function() {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "{{ route('articles.pagination', ['count' => 6]) }}",
                        type: "GET",
                        success: function (data) {
                            $.each(data['articles']['data'], function(key, value){
                                var link = $(location).attr("href") + 'articles/' + value.id;
                                $("#articles").append("<tr><td><a href=" + link + ">" + value.topic + "</a></td></tr>");
                            });


                        },
                        error: function (msg) {
                            $("#articles").append("<tr><td>Записей нет</td></tr>");
                        }
                    });
                });
            })
        </script>
    </body>
</html>
