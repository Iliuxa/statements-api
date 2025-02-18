# statements-api

Для того чтобы развернуть приложение необходимо выполнить
```bash
docker-compose up --build
```
далее зайти в контейнер api и выполнить 
```bash
make deploy
```
Готово! приложение запущено на `http://localhost:8080/`

Для запуска тестов выполнить
```bash
php bin/phpunit
```

Для статического анализа кода
```bash
vendor/bin/phpstan analyse
```
