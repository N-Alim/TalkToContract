# Projet de groupe Talk To Contract
(Dayana KEO, Maël BARBÉ, Alim NOUIRA)

## Présentation
Site de mise en relation entre candidats et recruteurs dans le cadre de stages

## Installation

Les instructions suivantes doivent être éxecutés dans le dossier racine du projet

### Dépendances Symfony

Installez les dépendances nécessaires :
```Shell
composer install
```

### Base de données

1. Créez la base de données :
```Shell
php bin/console doctrine:database:create
```

2. Mettez à jour la base de donnée avec les fichiers de migrations :
```Shell
php bin/console doctrine:migrations:migrate
```

3. Remplissez la base de données avec les données de test : 
```Shell
php bin/console doctrine:fixtures:load
```

### Webpack

Installez les dépendances nécessaires :
```Shell
npm install
```

## Démarrage des serveurs

Les instructions suivantes doivent être éxecutés dans le dossier racine du projet et il est nécessaire de réserver un terminal pour chaque serveur

### Serveur Apache

```Shell
php -S localhost:4000 -t public
```

### Serveur Webpack

```Shell
npm run watch
```

## Mise à jour

Les instructions suivantes doivent être éxecutés dans le dossier racine du projet

### Dépendances Symfony

Installez les dépendances manquantes :
```Shell
composer install
```

1. Mettez à jour la base de donnée avec les fichiers de migrations :
```Shell
php bin/console doctrine:migrations:migrate
```

2. Remplissez la base de données avec les données de test : 
```Shell
php bin/console doctrine:fixtures:load
```
