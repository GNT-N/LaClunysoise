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

BDD creation / migration
```sh
symfony console doctrine:database:create (Création de la BDD en ayant renseigner le .ENV)
```
```sh
symfony console make:migration (Création d'une nouvelle migration)
```
```sh
symfony console doctrine:migrations:migrate (Application de la migration)
```