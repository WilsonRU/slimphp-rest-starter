# Backend

### Requisitos

- [Docker](https://docs.docker.com/install/linux/docker-ce/ubuntu/)
- [Docker Compose](https://docs.docker.com/compose/install/)

### Instalação

- Criando as docker
    
    `docker-compose build`
    
- Iniciando as docker

    `docker-compose up -d`
    
- Instalando dependencias
   
   `docker-compose run --rm php-fpm composer install`
   
- Executando as migrations do banco de dados

    `docker-compose run --rm php-fpm vendor/bin/phinx migrate -e development`

- Criando uma migration para banco de dados

  `docker-compose run --rm php-fpm vendor/bin/phinx create nomeMigration`

- Executar PHPUnit e PHPStan

  `docker-compose run --rm php-fpm composer check`

- Executar CodeSniffer

  `docker-compose run --rm php-fpm composer cs-fix`
