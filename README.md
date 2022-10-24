# Bucket List Symfony

## Création du projet

```shell
composer create-project symfony/skeleton bucket-list
```

OU

```shell
symfony new bucket-list
```

### Webapp (version full)

Installation de l'ensemble des packages (Doctrine, Twig, Form...)

```shell
composer require webapp
```

### Apache-pack

Si vous utilisez Apache pour rediriger toutes les requêtes vers le controlleur frontal (public/index.php).

```shell
composer require symfony/apache-pack
```

## Installation

### Mettre en place l'environnement (une seule fois, après avoir récupéré le projet)

Créer le fichier .env.local :

```dotenv
DATABASE_URL="mysql://root:@127.0.0.1:3306/bucket_list?serverVersion=8&charset=utf8mb4"
```

```shell
composer install
php bin\console doctrine:database:drop --force
php bin\console doctrine:database:create
php bin\console doctrine:schema:update --force
php bin\console doctrine:fixtures:load
```

### Démarrer le serveur PHP

```shell
php -S localhost:8000 -t public
```

OU

```shell
symfony serve
```
