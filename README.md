# EgalTestTask

## [Задание](https://docs.google.com/document/d/1_7PywrF1Z5imFbRMVooqGybNsqWlkY3W2w8-k8Hy8EQ)

## Установка

### 1. Варианты загрузки на выбор:

- С помощью git clone:

  ```bash
  git clone https://github.com/killyouare/egalTest.git
  ```

- Выгрузить zip-архив с [github](https://github.com/killyouare/egalTest). После загрузки распаковать в текущую
  директорию.

### 2. Настройка

```bash
cd egalTest/deploy/
# Создание переменных окружения
cp .env.example .env
sudo docker-compose up -d --build
```

Сервер доступен по адресу:

http://localhost:80

Для доступа к базе данных:

|     Атрибут      | Вводимые данные |
| :--------------: |:---------------:|
|      Движок      |   PostgreSQL    |
|      Сервер      |    database     |
| Имя пользователя |    postgres     |
|      Пароль      |    password     |
|   База данных    |   application   |

Тестирование в postman:

- Импортировать postman-коллекцию
- Импортировать окружение

## Примечания

- Для установки вам необходимы:

    - [git](https://github.com/git-guides/install-git)
    - [docker](https://docs.docker.com/engine/install/)

- Папка Helpers в postman-коллекции нужна для авторизации и аутентификации заданных системой пользователя и админа.

- В случае если порт занят, попытайтесь отключить все службы использующие данный порт или измените его в переменных
  окружения(deploy/.env).
