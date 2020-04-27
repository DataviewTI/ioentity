# Cadastro de entidades para IntranetOne

Cadastro de entidades (clientes, fornecedores e funcionários) com endereço etc.

## Instalação

#### Composer installation

Laravel 7 or above, PHP >= 7.2.5

```sh
composer require dataview/ioconfig dev-master
```

laravel 5.6 or below, PHP >= 7 and < 7.2.5

```sh
composer require dataview/ioconfig 1.0.0
```

#### Laravel artisan installation

```sh
php artisan io-config:install
```

- Carregar as configurações

```sh
php artisan config:cache
```

- Configure o webpack conforme abaixo

```js
...
let entidade = require('intranetone-entity');
io.compile({
  services:{
    ...
    new entity()
    ...
  }
});

```

- Compile os assets e faça o cache

```sh
npm run dev|prod|watch
php artisan config:cache
```
