# Projet Enigma

Application web éducative de gestion d'énigmes développée avec Symfony 7.

## Description

Projet Enigma est une plateforme permettant aux professeurs et administrateurs de créer et gérer des parcours d'énigmes interactives pour les équipes d'étudiants. L'application offre un système complet de gestion des utilisateurs, des jeux, des énigmes et des équipes.

## Fonctionnalités principales

- **Gestion des utilisateurs** : Système d'authentification avec rôles (prof, admin, super-admin)
- **Gestion des jeux** : Création et configuration de parties d'énigmes
- **Gestion des énigmes** : Création d'énigmes de différents types (cartes, QCM, vidéo, etc.)
- **Gestion des équipes** : Suivi de la progression des équipes dans les énigmes
- **Système de paramètres** : Configuration personnalisable pour chaque jeu
- **Interface moderne** : Design sobre et professionnel avec Tailwind CSS

## Technologies utilisées

- **Backend** : Symfony 7.3 (PHP 8.2+)
- **Base de données** : PostgreSQL 16
- **ORM** : Doctrine
- **Frontend** : Tailwind CSS 3.4
- **Conteneurisation** : Docker & Docker Compose

## Structure de la base de données

L'application utilise les entités suivantes :

- **User** : Gestion des utilisateurs avec vérification d'email
- **Game** : Parties de jeu avec message et image d'accueil
- **Enigma** : Énigmes avec type, ordre, instructions et code secret
- **Type** : Types d'énigmes (card, mcq, video, etc.)
- **Thumbnail** : Vignettes associées aux énigmes
- **Team** : Équipes avec position, progression et notes
- **Avatar** : Avatars pour personnaliser les équipes
- **Setting** : Paramètres associés à chaque jeu

## Prérequis

- PHP 8.2 ou supérieur
- Composer
- Node.js et npm
- PostgreSQL 16
- Docker et Docker Compose (optionnel)

## Installation

Pour les instructions détaillées d'installation, veuillez consulter le fichier [GUIDE_INSTALLATION.md](GUIDE_INSTALLATION.md).

## Documentation

- [Guide d'installation](GUIDE_INSTALLATION.md) : Instructions complètes pour installer et configurer le projet

## Structure du projet

```
projet_enigma/
├── assets/              # Fichiers CSS, JS et autres assets
├── bin/                 # Scripts exécutables (console Symfony)
├── config/              # Configuration de l'application
├── migrations/          # Migrations Doctrine
├── public/              # Point d'entrée web et fichiers publics
├── src/
│   ├── Controller/      # Contrôleurs Symfony
│   ├── Entity/          # Entités Doctrine
│   ├── Form/            # Formulaires Symfony
│   └── Repository/      # Repositories Doctrine
├── templates/           # Templates Twig
├── tests/               # Tests unitaires et fonctionnels
└── var/                 # Cache et logs
```

## Contribution

Ce projet est développé dans un cadre éducatif. Pour toute question ou suggestion, veuillez contacter l'équipe de développement.

## Licence

Propriétaire - Tous droits réservés

## Auteurs

Développé pour le projet Enigma éducatif.
