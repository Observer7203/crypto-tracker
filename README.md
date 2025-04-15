# Crypto Tracker

**Crypto Tracker** — Laravel-приложение для мониторинга и управления криптовалютными парами, с автоматическим обновлением курсов из внешнего API (Binance).

---

## Возможности

- Управление криптовалютными парами (создание, редактирование, удаление)
- Периодическое обновление курсов через Binance API
- История курсов с фильтрацией и сортировкой
- Веб-интерфейс в стиле Metronic (Tailwind)
- Laravel Cron Scheduler

---

## Установка

```bash
# Клонировать репозиторий
git clone https://github.com/your-username/crypto-tracker.git
cd crypto-tracker

# Установить зависимости
composer install

# Создать .env и сгенерировать ключ
cp .env.example .env
php artisan key:generate

# Настроить подключение к БД в .env

# Запустить миграции
php artisan migrate

# (опционально) Заполнить пары с Binance
php artisan app:sync-binance-pairs
```

---

## Автоматическое обновление курсов

Курсы обновляются каждые `update_interval` минут для активных пар.

Настройка cron:

```bash
* * * * * cd /path-to-project && php artisan schedule:run >> /dev/null 2>&1
```

Также можно запускать вручную:

```bash
php artisan schedule:work
```

---

## Структура БД

### crypto_pairs
| Поле | Тип | Описание |
|------|-----|----------|
| id | bigint | PK |
| base_currency | string | Например, BTC |
| quote_currency | string | Например, USDT |
| update_interval | int | В минутах |
| is_active | boolean | true/false |
| current_price | decimal | Текущий курс |

### crypto_rates
| Поле | Тип | Описание |
|------|-----|----------|
| id | bigint | PK |
| crypto_pair_id | bigint | FK на crypto_pairs |
| rate | decimal | Курс |
| timestamp | datetime | Когда получен курс |

---

## Web-интерфейс

- `/pairs` — список крипто-пар
- `/pairs/create` — добавление пары
- `/pairs/{id}/edit` — редактирование пары
- `/rates` — история курсов с фильтрацией по паре и дате

---

## API и команды

### Ручной запуск получения курсов
```bash
php artisan app:update-crypto-rates
```

### Получение и сохранение доступных пар с Binance
```bash
php artisan app:sync-binance-pairs
```

---

## Развёртывание (на Laravel Cloud)

1. Зарегистрируйся на [https://cloud.laravel.com](https://cloud.laravel.com)
2. Подключи GitHub-репозиторий
3. Laravel сам создаст pipeline
4. Укажи ENV и базу данных
5. Деплой завершён 

---

## Используемые технологии
- Laravel 11+
- TailwindCSS (Metronic стиль)
- Scheduler + Cron
- Binance API (Spot)

---

##  Автор
Разработка: [@Observer7203](https://github.com/Observer7203)  
На основе тех.задания: [php-laravel-test.md](./php-laravel-test.md)

---

## Лицензия
MIT

