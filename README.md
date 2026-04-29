# Sondage Élèves

Application de gestion de sondages pour élèves développée avec **Laravel** et **Vite**.

---

## Installation

### Cloner le projet

```bash
git clone <repo_url>
cd sondage_eleves
composer install
npm i
cp .env.exemple .env
php artisan key:generate
php artisan wayfinder:generate
npm run build
php artisan migrate
php artisan db:seed
php artisan storage:link
php artisan install:broadcasting
```
## Déploiement local
### .env
```txt
APP_URL=http://157.26.121.105:8000
ou
APP_URL=http://localhost:8000

REVERB_HOST=157.26.121.105
ou
REVERB_HOST=localhost

QUEUE_CONNECTION=sync # Pour les tests, on utilise la connexion sync pour éviter d'avoir à gérer un worker de queue
```

### vite.config.ts
```js
export default defineConfig({
    plugins: [
        ...
    ],
    server: {
        host: '0.0.0.0',
        hmr: {
            host: '157.26.121.136',
        },
    },
});
```

### CORS :
config/cors.php
```php
'allowed_origins' => ['http://10.224.82.232:5173', 'http://localhost:5173'],
```

### Commandes :
```bash
php artisan serve --host=0.0.0.0 --port=8000
npm run dev -- --host
php artisan reverb:start
```
