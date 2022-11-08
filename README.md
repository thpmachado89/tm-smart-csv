# tm-smart-csv
Importação de CSV em Background com Laravel utilizando Queue

Passos para execução

Clonar Repositório

1) git clone https://github.com/thpmachado89/tm-smart-csv

Entrar no diretório

2) cd tm-smart-csv

Instalar dependências do Front

3) npm install

Subir o backend

4) docker-compose up -d

Instalar dependências do backend

5) Dentro do terminal do servidor executar: composer install

Rodar as migrations

6) Dentro do terminal do servidor executar: php artisan migrate

Iniciar o serviço de filas do laravel

7) Dentro do terminal do servidor executar: php artisan queue:work --daemon

Rodar o frontend

8) npm run dev
