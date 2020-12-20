## Запуск окружения
Скопировать файл окружения 
`cp .env.example .env`
При необходимости указать свои значения (пароль, логин). 
Базово все значения из примера валидны и рабочие (пути, порты и прочее)
Запустить` docker-compose up -d`. 
Это инициализирует и запустит все контейнеры, а затем оставит их работать в фоновом режиме.

Приложение доступно по адресу [localhost:8074](http://localhost:8074)

_8074 - порт указанный в WEB_HTTP_PORT_

# Docker compose шпаргалка #

**Note:** you need to cd first to where your docker-compose.yml file lives.

  * Start containers in the background: `docker-compose up -d`
  * Start containers on the foreground: `docker-compose up`. You will see a stream of logs for every container running.
  * Stop containers: `docker-compose stop`
  * Kill containers: `docker-compose kill`
  * View container logs: `docker-compose logs`
  * Execute command inside of container: `docker-compose exec SERVICE_NAME COMMAND` where `COMMAND` is whatever you want to run. Examples:
        * Shell into the PHP container, `docker-compose exec php-fpm bash`
        * Run symfony console, `docker-compose exec php-fpm bin/console`

# Разрешения файлов приложения #

В случае ошибки прав доступы сделать корректировку прав доступа выполнив команду:
`docker-compose exec php-fpm chown -R www-data:www-data /application`

# Recommendations #

# Базовая конфигурация Xdebug configuration с интеграцией PHPStorm
- Включить в .env INSTALL_XDEBUG=true

- Создать конфигурацию сервера в PHPStorm:
     * In PHPStorm open Preferences | Languages & Frameworks | PHP | Servers
     * Add new server
     * В поле “Name” требуется указать значение параметра “serverName” в “environment” в docker-compose.yml. 
        _Значение устанавливается в .env "CONTAINER_NAME"_
     * В поле "Hose" требуется указать значение "localhost"
     * В поле "Port" требуется указать значение из .env "WEB_HTTP_PORT"
     * Выбрать "Use path mappings" и установить след:
        - File/Directory (path_to_project)
        - Absolute path on the server (/application)

## Symfony CLI
Для установки команды symfony необходимо в .env файле прописать:
`INSTALL_SYMFONY=true`
