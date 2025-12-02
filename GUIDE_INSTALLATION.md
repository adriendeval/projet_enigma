# Guide d'Installation - Projet Enigma

Guide détaillé pour installer et configurer le projet Enigma sur votre machine locale.

## Prérequis

Avant de commencer, assurez-vous d'avoir installé :

- **PHP 8.2** ou supérieur
- **Composer** (gestionnaire de dépendances PHP)
- **Node.js** (version 18 ou supérieure) et **npm**
- **PostgreSQL 16** (ou Docker pour utiliser la version conteneurisée)
- **Git**

## Étape 1 : Cloner le projet

Ouvrez un terminal et clonez le dépôt GitHub :

```bash
git clone https://github.com/adriendeval/projet_enigma.git
cd projet_enigma
```

## Étape 2 : Installer les dépendances PHP

Installez toutes les dépendances PHP avec Composer :

```bash
composer install
```

Cette commande va télécharger et installer tous les packages Symfony et leurs dépendances.

## Étape 3 : Installer les dépendances Node.js

Installez les dépendances JavaScript (notamment Tailwind CSS) :

```bash
npm install
```

## Étape 4 : Configurer la base de données

### Option A : Avec Docker (Recommandé)

Si vous avez Docker installé, la configuration est simplifiée :

1. Démarrez les conteneurs Docker :

```bash
docker compose up -d
```

2. Le fichier `.env` est déjà configuré par défaut pour fonctionner avec Docker. La connexion est :
   - **Host** : 127.0.0.1
   - **Port** : 5432
   - **Database** : app
   - **User** : app
   - **Password** : !ChangeMe!

### Option B : Sans Docker

Si vous préférez utiliser PostgreSQL installé localement :

1. Créez une base de données PostgreSQL :

```sql
CREATE DATABASE enigma_db;
```

2. Modifiez le fichier `.env` à la racine du projet et configurez la ligne `DATABASE_URL` :

```env
DATABASE_URL="postgresql://votre_user:votre_password@127.0.0.1:5432/enigma_db?serverVersion=16&charset=utf8"
```

Remplacez :
- `votre_user` par votre nom d'utilisateur PostgreSQL
- `votre_password` par votre mot de passe PostgreSQL
- `enigma_db` par le nom de votre base de données

## Étape 5 : Créer la base de données et exécuter les migrations

Une fois la configuration de base de données effectuée :

1. Créez la base de données (si elle n'existe pas déjà) :

```bash
php bin/console doctrine:database:create
```

2. Exécutez les migrations pour créer les tables :

```bash
php bin/console doctrine:migrations:migrate
```

Répondez `yes` quand la console vous demande confirmation.

## Étape 6 : Charger les fixtures (optionnel)

Pour ajouter des données de test, vous pouvez exécuter les fixtures :

```bash
php bin/console doctrine:fixtures:load
```

⚠️ **Attention** : Cette commande va effacer toutes les données existantes et les remplacer par les données de test.

## Étape 7 : Compiler les assets CSS (Tailwind)

Générez le fichier CSS avec Tailwind :

```bash
npm run build
```

Pour le développement avec rechargement automatique :

```bash
npm run watch
```

Cette commande reste active et recompile automatiquement le CSS à chaque modification.

## Étape 8 : Générer le secret de l'application

Générez une clé secrète pour Symfony dans le fichier `.env` :

1. Ouvrez le fichier `.env`
2. Modifiez la ligne `APP_SECRET` avec une chaîne aléatoire :

```env
APP_SECRET=VotreChainAleatoireIci123456789
```

Ou générez-en une automatiquement :

```bash
php bin/console secrets:generate-keys
```

## Étape 9 : Lancer le serveur de développement

Démarrez le serveur web Symfony :

```bash
symfony serve
```

Ou si vous n'avez pas le CLI Symfony installé :

```bash
php -S localhost:8000 -t public
```

L'application sera accessible à l'adresse : **http://localhost:8000**

## Étape 10 : Créer un utilisateur administrateur

Pour accéder à l'interface d'administration, créez un utilisateur avec le rôle admin :

```bash
php bin/console app:create-user
```

Ou manuellement via une fixture ou directement dans la base de données.

## Commandes utiles

### Développement

```bash
# Vider le cache
php bin/console cache:clear

# Lister toutes les routes
php bin/console debug:router

# Voir les logs en temps réel
tail -f var/log/dev.log
```

### Base de données

```bash
# Créer une nouvelle migration après modification des entités
php bin/console doctrine:migrations:diff

# Voir le statut des migrations
php bin/console doctrine:migrations:status

# Revenir à une migration précédente
php bin/console doctrine:migrations:migrate prev
```

### Tailwind CSS

```bash
# Build production (minifié)
npm run build

# Mode développement (watch)
npm run watch
```

## Résolution des problèmes courants

### Erreur de connexion à la base de données

- Vérifiez que PostgreSQL est bien démarré
- Vérifiez les identifiants dans le fichier `.env`
- Si vous utilisez Docker, vérifiez que les conteneurs sont actifs : `docker compose ps`

### Erreur de permissions

Si vous rencontrez des erreurs de permissions sur les dossiers `var/` ou `public/` :

```bash
chmod -R 777 var/
chmod -R 777 public/build/
```

### Le CSS ne se charge pas

- Assurez-vous d'avoir exécuté `npm run build`
- Vérifiez que le dossier `public/build/` existe et contient `app.css`
- Videz le cache du navigateur

### Port déjà utilisé

Si le port 8000 est déjà utilisé, spécifiez un autre port :

```bash
symfony serve --port=8001
```

Ou avec PHP :

```bash
php -S localhost:8001 -t public
```

## Support

Pour toute question ou problème d'installation, n'hésitez pas à :
- Consulter la documentation Symfony : https://symfony.com/doc/current/index.html
- Vérifier les issues GitHub du projet
- Contacter l'équipe de développement

---

**Bon développement avec Projet Enigma ! 🔐**
