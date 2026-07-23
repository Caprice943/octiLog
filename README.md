# OctiLog — Catalogue de montures
 
Mini-projet Symfony développé pour monter en compétences sur le stack PHP/Symfony, en amont d'une candidature (secteur optique). L'application permet de gérer un catalogue de montures (CRUD complet) via une interface web et une API REST.
 
## 🎯 Objectif du projet
 
Ce projet a été conçu comme un terrain d'apprentissage volontairement simple, pour démontrer :
- La prise en main de **Symfony** et de son écosystème (Doctrine, Twig, Maker Bundle)
- La mise en place d'un environnement de développement **conteneurisé** avec Docker
- Une gestion propre de la persistance des données (BDD + fichiers uploadés)
## 🛠️ Stack technique
 
| Composant | Technologie |
|---|---|
| Framework | Symfony 8 |
| ORM | Doctrine |
| Moteur de templates | Twig |
| Base de données | MySQL 8.0 |
| Serveur web | Nginx + PHP-FPM |
| Conteneurisation | Docker / Docker Compose |
 
## ✨ Fonctionnalités
 
- CRUD complet sur les montures (création, lecture, modification, suppression)
- Upload de photo pour chaque monture
- Filtrage par genre (Homme / Femme / Enfant) et catégorie (Solaire / Optique)
- API REST exposant les mêmes ressources en JSON
## 📦 Modèle de données
 
Une entité unique `Monture` avec deux enums PHP pour le genre et la catégorie ( la volonté de garder le modèle simple ) :
 
- `id`, `nom`, `prix`, `stock`, `photo`
- `genre` : `HOMME` / `FEMME` / `ENFANT`
- `categorie` : `SOLAIRE` / `OPTIQUE`
## 🚀 Installation et lancement
 
### Prérequis
 
- Docker et Docker Compose installés
### 1. Cloner le projet
 
```bash
git clone https://github.com/<ton-username>/octilog.git
cd octilog
```
 
### 2. Configurer les variables d'environnement
 
```bash
cp .env.example .env.local
```
 
Puis renseigne tes propres valeurs dans `.env.local` (`DB_PASSWORD`, `DB_ROOT_PASSWORD`, `DATABASE_URL`).
 
### 3. Lancer les conteneurs
 
```bash
docker compose --env-file .env.local up -d --build
```
 
### 4. Installer les dépendances PHP
 
```bash
docker compose --env-file .env.local exec php composer install
```
 
### 5. Exécuter les migrations
 
```bash
docker compose --env-file .env.local exec php php bin/console doctrine:migrations:migrate
```
 
### 6. Accéder à l'application
 
- **Interface web** : [http://localhost:8080](http://localhost:8080)
- **API REST** : `http://localhost:8080/api/montures`

## 🔒 Sécurité
 
Les fichiers `.env` et `.env.local` contenant les secrets réels ne sont pas versionnés (voir `.gitignore`). Un fichier `.env.example` sert de modèle pour toute personne clonant le projet.

## 👩‍💻 Auteur
 
**Caprice** — Développeuse fullstack (Angular / Spring Boot)
Portfolio : [caprice-m.dev](https://caprice-m.dev)
 
Projet réalisé dans le cadre d'une démarche d'apprentissage ciblée sur le stack PHP/Symfony.