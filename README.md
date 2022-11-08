# tm-smart-csv
Importação de CSV em Background com Laravel utilizando Queue

Passos para execução

Clonar Repositório

1) git clone https://github.com/thpmachado89/tm-smart-csv

Entrar no diretório

2) cd tm-smart-csv

Subir o backend

3) docker-compose up -d

Iniciar o serviço de filas do laravel

4) Dentro do terminal do servidor executar: php artisan queue:work --daemon

Rodar o frontend

5) npm run dev
