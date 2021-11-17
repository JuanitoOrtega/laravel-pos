# Creamos el proyecto
laravel new ventas

# Instalamos jetstream
composer require laravel/jetstream

php artisan jetstream:install livewire --teams

npm install && npm run dev

php artisan migrate

# Para iniciar servidor laravel con host personalizado
sudo php artisan serve --host=ventas.test --port=80
# Se debe agregar 127.0.0.1 ventas.test en /etc/hosts

# Creamos modelos y controladores
// Creamos modelo con su migración
php artisan make:model Categoria -m

// Creamos modelo con todo
php artisan make:model Producto -a
php artisan make:model Cliente -a
php artisan make:model Pedido -a
php artisan make:migration create_pedido_producto_table

// Creamos modelo Proveedor
php artisan make:model Proveedor -a
// Tabla ralación
php artisan make:migration create_producto_proveedor_table

// Creamos controlador con recursos
php artisan make:controller CategoriaController -r

// Para crear archivos de errores
php artisan vendor:publish --tag=laravel-errors

// Controlador de usuarios
php artisan make:controller UserController -r

# Para ver lista de rutas, compacto
php artisan route:list -c

# Actualizar una tabla sin perder datos, creamos primero la migración, añadimos las columnas necesarias
php artisan make:migration add_logo_to_proveedors_table

# Actualizar una tabla sin perder datos, creamos primero la migración, añadimos las columnas necesarias
php artisan make:migration add_cantidad_to_producto_proveedor_table
# Para aplicar las nuevas columnas
php artisan migrate

# Para revertir migraciones, revirte migraciones hacia atrás 1 a 1
php artisan migrate:rollback
