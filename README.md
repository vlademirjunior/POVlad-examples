# Como colocar no laravel?
- Clone esse repositório.
- Copie e cole a pasta `./src/PovladPagarme` para dentro de `./app/`
- Agora basta Importar a classes e utilizar seguindo o `./src/index-real.php` como exemplo.

# Rodar
- copie .env-example para .env e adicione o valor da secret_key.
```bash
docker-compose -f "docker-compose.yml" up -d --build
docker run --rm -v $(pwd)/src:/app composer install
```

## Extras
- As vezes com o passar dos anos, pode ser necessários rodar:
```bash
docker run --rm -v $(pwd)/src:/app composer update
```

## Testes com dados reais
- Apenas substitua o arquivo index-real.php por index.php.
    - Não esquece de marretar os valores reais dentro do index-real.php