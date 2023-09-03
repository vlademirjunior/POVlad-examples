# Requisitos para rodar localhost
- Docker e docker-compose apenas.
    - composer dockerizado!
    - php8.1 e apache dockerizado!

# Rodar
- copie .env-example para .env e adicione o valor da secret_key.
```bash
docker-compose -f "docker-compose.yml" up -d --build
docker run --rm -v $(pwd)/src:/app composer install
```

# Como colocar no laravel?
- Clone esse repositório.
- Copie e cole a pasta `./src/PovladPagarme` para dentro de `./app/`
- Agora basta Importar a classes e utilizar seguindo o `./src/index-real.php` como exemplo.

## Extras
- As vezes com o passar dos anos, pode ser necessários rodar:
```bash
docker run --rm -v $(pwd)/src:/app composer update
```

## Testes com dados reais
- Apenas substitua o arquivo index-real.php por index.php.
    - Não esquece de marretar os valores reais dentro do index-real.php


### Boas práticas e qualidade de código
- Durante o desenvolvimento foi levado em consideração:
    - Clean Code
    - Five design principles (S.O.L.I.D)
    - YAGNI # (You Aren't Gonna Need It) os recursos só devem ser adicionados quando necessários.
    - Patterns (GoF) # Factory por Exemplo.

### TODO
- Testes unitários e de Integração automatizados.