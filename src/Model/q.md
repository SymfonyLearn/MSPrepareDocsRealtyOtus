# Entity

## User

### VO

* id:
  type: integer

* email:
  type: string format: email

* name:
  type: string description: ФИО

* password:
  type: string description: Хэш пароля

## Ad

### VO

* id: !
  type: integer

* created: !
  type: string format: date-time

* category:
  type: string description: Категория объявления enum:

- Квартира
- Дом
- Участок

* address: !
  type: string description:
  type: string

* price: !
  type: integer description: 'Цена, руб.'

* rooms: !
  type: integer description: Кол-во комнат (для домов и квартир)

* area:
  type: number description: 'Площадь, кв.м.'
* floor: !
  type: integer description: Этаж (для квартир)
* seller_id: !
  type: integer

## Deal

### VO

* id:
  type: integer

* state: !
  type: string enum:

        - Новая
        - Договор подготовлен
        - Договор подписан
        - На регистрации
        - Ошибка регистрации
        - Регистрация завершена description: Текущий статус сделки

* ad_id: !
  type: integer description: ID объявления
 
* buyer_id: !
  type: integer description: ID покупателя

## DealEvent

### VO

* deal_id: !
  type: integer description: ID сделки
* created: !
  type: string format: date-time
* state: !
  type: string enum:

- Новая
- Договор подготовлен
- Договор подписан
- На регистрации
- Ошибка регистрации
- Регистрация завершена


