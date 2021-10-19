# Creamos el proyecto
laravel new ventas

# Instalamos jetstream
composer require laravel/jetstream

php artisan jetstream:install livewire --teams

npm install && npm run dev

php artisan migrate

# Para iniciar servidor laravel con host personalizado
php artisan serve --host=ventas.test --port=80
# Se debe agregar 127.0.0.1 ventas.test en /etc/hosts
