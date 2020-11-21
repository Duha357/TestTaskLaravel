# TestTaskLaravel
Тестовое задание располагается по адресу: https://gist.github.com/smskin/aa39833f9d57f9e96899c8b065057eb7

### Проверено на версии PHP:
php 7.4

### Как запустить проект:
- Скачать и установить PHP в любую папку

- Скачать и установить Composer

- Скачать проект целиком и распаковать в желаемую папку или использовать команду: `git clone https://github.com/Duha357/TestTaskLaravel`

- Через терминал зайти в папку проекта и запустить миграции: php artisan migrate

- Запустить сидеры: php artisan db:seed

- Запустить: php artisan serve

- Перейти на localhost:8000, либо http://127.0.0.1:8000

#### Внимание: В случае возникновения некоторых ошибок

- Если проект будет жаловаться на осутствие расширения fileinfo с подписью `require ext-fileinfo * -> it is missing from your system.`, то необходимо зайти в папку с PHP и в файле `php.ini` изменить строчку `;extension=fileinfo` на `extension=fileinfo`

- Если при выполнении команды `php artisan migrate` проект будет жаловаться на драйвер с подписью `could not find driver`, то необходимо зайти в папку с PHP и в файле `php.ini` изменить строчку `;extension=pdo_sqlite` на `extension=pdo_sqlite`
