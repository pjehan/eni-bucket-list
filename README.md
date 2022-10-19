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

```shell
composer install
```

### Démarrer le serveur PHP

```shell
php -S localhost:8000 -t public
```

OU

```shell
symfony serve
```
