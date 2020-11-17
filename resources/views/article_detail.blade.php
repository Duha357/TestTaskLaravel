<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Страница статьи</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </head>
    <body>
        <ul id="menu">

        </ul>

        <h1>Страница статьи</h1>

        <h2>{{ $article->topic }}</h2>

        <h3>{{ $article->text }}</h3>

        <div>
            <h4>Лайки</h4>
            <button class="btn btn-theme margintop10 pull-left" type="submit" id="likes"></button>
        </div>

        <br><br><br>

        <div>
            <h4>Просмотры</h4>
            <button class="btn btn-theme margintop10 pull-left" type="submit" id="views"></button>
        </div>

        <table class="table table-striped ">
            <thead>
                <tr>
                    <th><h4>Теги</h4></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach($article->tags as $tag)
                        <th>{{ $tag->tag }}</th>
                    @endforeach
                </tr>
            </tbody>
        </table>

        <div id="formSlot">
            <form id="counterForm" method="POST">
                @csrf

                <h4>Комментарии</h4>

                <div>
                    <div class="col-lg-4 field">
                        <input type="text" id="topic" placeholder="* Тема комментария..." required />
                    </div>
                    <div class="col-lg-12 margintop10 field">
                        <textarea rows="12" id="text" class="input-block-level" placeholder="* Ваш коментарий..." required></textarea>
                        <p>
                            <button class="btn btn-theme margintop10 pull-left" type="submit" id="save">Отправить</button>
                            <span class="pull-right margintop20">* Заполните, пожалуйста, все обязательные поля!</span>
                        </p>
                    </div>
                </div>
            </form>
        </div>

        <script>
            $(function() {
                $('#save').on('click', function(){
                    var topic = $('#topic').val();
                    var text = $('#text').val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
                        }
                    });

                    $('#counterForm').submit(function (event) {
                        event.preventDefault();

                        $.ajax({
                            url: "{{ route('articles.create_comment', ['id' => $article->id]) }}",
                            type: "POST",
                            data: {articleId:{{ $article->id }}, topic:topic, text:text},
                            success: function (data) {
                                $("#counterForm").remove();
                                $("#formSlot").append("Ваше сообщение " + data['topic'] + " успешно отправлено");
                            },
                            error: function (msg) {
                                alert("Ошибка отправки сообщения");
                            }
                        });
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
                        url: "{{ route('articles.get_likes', ['id' => $article->id]) }}",
                        type: "GET",
                        success: function (data) {
                            $("#likes").append(data['likes']);
                        },
                        error: function (msg) {
                            $("#likes").append("Ошибка получения лайков");
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
                        url: "{{ route('articles.get_views', ['id' => $article->id]) }}",
                        type: "GET",
                        success: function (data) {
                            $("#views").append(data['views']);
                        },
                        error: function (msg) {
                            $("#views").append("Ошибка получения просмотров");
                        }
                    });
                });
            })
        </script>

        <script>
            $(function() {
                $(document).on('ready',function(){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "{{ route('articles.set_view', ['id' => $article->id]) }}",
                        type: "POST",
                        data: {articleId:{{ $article->id }}, view:1},
                        success: function (data) {
                            setTimeout(function() {
                                $("#views").empty().append(data['views']);
                            }, 5000);
                        },
                        error: function (msg) {
                            $("#views").append("Ошибка получения просмотров");
                        }
                    });
                });
            })
        </script>

        <script>
            $(function() {
                $('#likes').on('click',function(){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "{{ route('articles.set_like', ['id' => $article->id]) }}",
                        type: "POST",
                        data: {articleId:{{ $article->id }}, like:1},
                        success: function (data) {
                            $("#likes").empty().append(data['likes']);
                        },
                        error: function (msg) {
                            $("#likes").append("Ошибка получения лайков");
                        }
                    });
                });
            })
        </script>
    </body>
</html>
