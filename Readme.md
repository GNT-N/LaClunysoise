# SiteWeb de la Clunysoise

⚙️ Installation
--------------

Install the PHP dependencies and JS dependencies.
```sh
composer install
```
```sh
npm install
```

Installing assets
```sh
npm run watch
```

Entities / Database
```sh
symfony console doctrine:database:create (DB creation)
```
```sh
symfony console make:entity (Entities Creation)
```
```sh
symfony console make:migration (Creating a new migration)
```
```sh
symfony console doctrine:migrations:migrate (Applying migration)
```

Controller
```sh
symfony console make:controller (Create controllers)
```
