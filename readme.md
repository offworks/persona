# Persona

A simple blog project that utilizes exedra and range of tools like, 
- laravel eloquent (through offworks/laraquent)
- twig/twig
- cebe/markdown
- nesbot/carbon
- jasongrimes/paginator
- symfony/console
- filp/whoops

## installation

### clone
`git clone https://github.com/offworks/persona`

### composer install
```
cd persona

composer install
```

### env setup
- create a database named `persona`
- duplicate `config/env.json.example` into `config/env.json`, setup db credential accordingly.
- run `php database/schema.php` to migrate insert db schemas

### testing
- `cd public` and `php -S localhost:9000`
- then run `http://localhost:9000` on your browser

### routes
run `php console.php app:routes` or `php console.php routeller:routes` to list the routing.