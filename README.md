# Сервис подготовки документов для организации сделок с недвижимостью (learn)

## запуск проекта (стандартный)

из-под ОС:
> docker-compose up --build

из-под контейнера "php-fpm"
> composer install  
> php bin/console doctrine:migrations:migrate

---

## Документация OpenAPI

[Документация OpenAPI (/docs/openapi.v1.yaml)](docs/openapi.v1.yaml)

---

## События + RabbitMQ

- указать в .env корректный RABBITMQ_URL (с учётом Docker)
- обновить зависимости Composer (т.к. в изначальной версии Symfony Cache была ошибка, которую исправили в 5.2.1)
- запуск consumer-а из командной строки:

```
> php bin/console rabbitmq:consumer create_ad
```

---

## некоторые запросы для создания сущностей (примеры)

### create User (/api/v1/user, POST, no auth)

```
{
    "email": "user@example3.com",
    "name": "Иван Иванов",
    "password": "123456",
    "roles": [
        "ROLE_USER"
    ]
}
```

### create Ad (/api/v1/ad, POST, basic auth: >= ROLE_USER)

```
{
  "category": "Квартира",
  "address": "Зеленоград, к. 130, кв. 14",
  "description": "Очень просторная двушка",
  "price": 9500000,
  "rooms": 2,
  "area": 54,
  "floor": 3,
  "seller_id": 1
}
```

### create Deal (/api/v1/deal, POST, basic auth: >= ROLE_USER)

```
{
  "ad_id": 8,
  "buyer_id": 2
}
```

---

## интеграция с ElasticSearch

- события, попавшие в RabbitMQ и перехваченные consumer-ом, теперь отгружаются в ElasticSearch
- поиск по ElasticSearch

### Запуск:

```
> symfony console fos:elastica:create
```

### Пример поискового запроса:

```
{
   "category": "Квартира",
   "price_from": 9500000,
   "price_to": 12000000,
   "rooms": 2
 }
```

### Пример поискового запроса:

```
{
  "category": "Квартира",
  "price_from": 9500000,
  "price_to": 12000000,
  "rooms": 2
}
```

---

## Запуск тестов

- обновить зависимости композера
  > composer install  
  или установить пакет
  > composer require --dev symfony/phpunit-bridge
- войти в контейнер
- запустить (первый запуск)
  > ./vendor/bin/simple-phpunit --migrate-configuration
- в дальнейшем запускать тесты так:
  > ./vendor/bin/simple-phpunit
