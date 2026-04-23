# Task App (Laravel)

Versão Laravel do mini-projeto de tasks. Mesmos endpoints e mesmo CRUD do `task-app` em PHP puro,
porém escrito do jeito Laravel — Eloquent, FormRequest, Blade, Route::resource, `.env`.

## Stack

- PHP 8.4 + Apache (Docker)
- Laravel 13
- MySQL 8
- Composer 2

## Arquitetura (o paralelo com o task-app PHP)

| Camada no task-app PHP                 | Equivalente aqui (Laravel)                          |
|----------------------------------------|------------------------------------------------------|
| `src/Core/Router.php`                  | `routes/web.php` + `routes/api.php` (framework)      |
| `src/Controllers/TaskController.php`   | `app/Http/Controllers/TaskController.php`            |
| `src/Controllers/Api/TaskApiController`| `app/Http/Controllers/Api/TaskApiController.php`     |
| `src/Services/TaskService.php`         | Eloquent no model `App\Models\Task`                  |
| `src/Models/Task.php` (DTO)            | `app/Models/Task.php` (Eloquent)                     |
| `src/database/init.sql`                | `database/migrations/*_create_tasks_table.php`       |
| `src/views/*.php` + `_layout.php`      | `resources/views/layouts/app.blade.php` + `tasks/*`  |
| validação manual no Controller         | `app/Http/Requests/TaskRequest.php`                  |
| `View::flash()`                        | `session()->flash()` (via `->with('success', ...)`)  |

## Como rodar

1. Subir os containers:

```bash
cd laravel-task-app
docker compose up --build -d
```

No primeiro start, o container `app`:
- roda `composer install`
- copia `.env.example` para `.env` (se não existir)
- gera `APP_KEY`
- roda `php artisan migrate`

2. Popular com dados de exemplo (opcional):

```bash
docker compose exec app php artisan db:seed
```

3. Acessar:

- http://localhost:8082/tasks

4. Parar:

```bash
docker compose down
```

Reset total (apaga o volume do MySQL):

```bash
docker compose down -v
```

## Rotas Web

| Método | URI                    | Ação                |
|--------|------------------------|---------------------|
| GET    | `/`                    | redireciona /tasks  |
| GET    | `/tasks`               | `TaskController@index`   |
| GET    | `/tasks/create`        | `TaskController@create`  |
| POST   | `/tasks`               | `TaskController@store`   |
| GET    | `/tasks/{task}/edit`   | `TaskController@edit`    |
| PUT    | `/tasks/{task}`        | `TaskController@update`  |
| DELETE | `/tasks/{task}`        | `TaskController@destroy` |

Formulários usam `@method('PUT')` / `@method('DELETE')` para o method spoofing do Laravel.

## API JSON

| Método | URI                  | Ação                          |
|--------|----------------------|-------------------------------|
| GET    | `/api`               | `TaskApiController@index`     |
| GET    | `/api/tasks`         | `TaskApiController@index`     |
| GET    | `/api/tasks/{task}`  | `TaskApiController@show`      |

Testes rápidos:

```bash
curl -s http://localhost:8082/api | jq
curl -s http://localhost:8082/api/tasks/1 | jq
curl -s http://localhost:8082/api/tasks/99999 | jq   # 404 JSON
```

O arquivo [requests.http](requests.http) tem chamadas prontas para PhpStorm.

## Comandos úteis (artisan)

```bash
docker compose exec app php artisan migrate
docker compose exec app php artisan migrate:fresh --seed
docker compose exec app php artisan tinker
docker compose exec app php artisan route:list
```

## Banco de dados

Conexão default (via `.env`):

```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=tasks
DB_USERNAME=app
DB_PASSWORD=app123
```

MySQL exposto em `localhost:3309`.

## Próximos passos sugeridos para estudo

- Criar `TaskResource` (API Resource) para controlar o shape do JSON
- Adicionar paginação com `Task::paginate()` no index
