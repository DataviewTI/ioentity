# Cadastro de entidades para IntranetOne

Cadastro de entidades (clientes, fornecedores e funcionários) com endereço etc.

## Conteúdo

## Instalação

```sh
composer require dataview/ioentity
```

```sh
php artisan io-entity:install
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
