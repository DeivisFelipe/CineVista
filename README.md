## CineVista

# Passo para rodar

-   copy .env.example .env
-   composer install
-   npm install
-   php artisan storage:link
-   php artisan key:generate
-   php artisan migrate --seed
-   npm run dev

# Multi Tenant

Para que o Multi Tenant funcionar é preciso ter um servidor PHP que permita rodar domain.localhost, pois os dominios tem que ser subdominios do localhost
