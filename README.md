# 🚀 Installation et démarrage du projet

## Prérequis

Avant de commencer, assurez-vous d'avoir installé les outils suivants sur votre machine :

* Docker
* Docker Compose
* Git

Vérifiez les versions installées :

```bash
docker --version
docker compose version
git --version
```

---

## 1. Cloner le projet

Clonez le dépôt GitHub puis placez-vous à la racine du projet :

```bash
git clone git@github.com:user/repo.git
cd From_docker_to_k8s
```

---

## 2. Créer les fichiers d'environnement

Le projet utilise deux fichiers d'environnement :

* Un fichier `.env` à la racine pour Docker Compose
* Un fichier `laravel-api/.env` pour Laravel

Créez-les à partir des fichiers d'exemple :

```bash
cp .env.example .env
cp laravel-api/.env.example laravel-api/.env
```

---

## 3. Configurer les variables d'environnement

### Configuration Docker

Ouvrez le fichier `.env` situé à la racine du projet et renseignez les variables suivantes :

```env
DB_DATABASE=laravel_docker_k8s
DB_USERNAME=db_manager
DB_PASSWORD=your_password
```

### Configuration Laravel

Ouvrez ensuite le fichier :

```text
laravel-api/.env
```

Configurez au minimum :

```env
APP_NAME="From Docker To K8s"

DB_CONNECTION=pgsql
DB_HOST=postgres
DB_PORT=5432
DB_DATABASE=laravel_docker_k8s
DB_USERNAME=db_manager
DB_PASSWORD=your_password

CACHE_STORE=redis
QUEUE_CONNECTION=redis

REDIS_HOST=redis
REDIS_PORT=6379
```

---

## 4. Générer la clé d'application Laravel

Laravel nécessite une clé d'application unique pour le chiffrement des sessions, cookies et données sensibles.

Exécutez la commande suivante :

```bash
docker run --rm \
  -v $(pwd)/laravel-api:/app \
  -w /app \
  composer:2 \
  php artisan key:generate --show
```

Exemple de résultat :

```text
base64:XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX=
```

Copiez cette valeur dans :

```env
APP_KEY=
```

du fichier :

```text
laravel-api/.env
```

---

## 5. Construire et démarrer l'environnement Docker

Lancez l'environnement de développement :

```bash
docker compose -f docker-compose.dev.yml up -d --build
```

Vérifiez que tous les conteneurs sont démarrés :

```bash
docker compose -f docker-compose.dev.yml ps
```

Vous devriez obtenir un résultat similaire à :

```text
laravel
nginx
postgres
redis
node
```

Tous les services doivent être dans l'état `Up`.

---

## 6. Installer les dépendances Laravel

Installez les dépendances PHP :

```bash
docker compose -f docker-compose.dev.yml exec laravel composer install
```

---

## 7. Exécuter les migrations

Initialisez la base de données :

```bash
docker compose -f docker-compose.dev.yml exec laravel php artisan migrate
```

Pour recharger complètement la base :

```bash
docker compose -f docker-compose.dev.yml exec laravel php artisan migrate:fresh
```

---

## 8. Vérifier l'accès à l'application

Une fois les conteneurs démarrés, les services suivants doivent être accessibles :

### Dashboard Laravel

```text
http://admin.local:8000
```

### API Laravel

```text
http://api.local:8000
```

### Serveur Vite (Hot Reload)

```text
http://localhost:5173
```

---

## 9. Vérifier les logs

Laravel :

```bash
docker compose -f docker-compose.dev.yml logs -f laravel
```

Nginx :

```bash
docker compose -f docker-compose.dev.yml logs -f nginx
```

Node / Vite :

```bash
docker compose -f docker-compose.dev.yml logs -f node
```

PostgreSQL :

```bash
docker compose -f docker-compose.dev.yml logs -f postgres
```

---

## 10. Arrêter l'environnement

Arrêter les conteneurs :

```bash
docker compose -f docker-compose.dev.yml stop
```

Supprimer les conteneurs :

```bash
docker compose -f docker-compose.dev.yml down
```

Supprimer également les volumes :

```bash
docker compose -f docker-compose.dev.yml down -v
```

⚠️ Cette dernière commande supprimera les données PostgreSQL stockées localement.

```
```
# 🏗️ Architecture du projet

## Vue d'ensemble

Le projet a pour objectif de mettre en place une architecture moderne basée sur Docker, Laravel, PostgreSQL, Redis et Vue.js/Nuxt.js, tout en préparant progressivement le terrain pour un déploiement Kubernetes.

L'ensemble des services communiquent via un réseau Docker privé.

```text
                    ┌─────────────────┐
                    │   Navigateur    │
                    └────────┬────────┘
                             │
                             ▼
                    ┌─────────────────┐
                    │      Nginx      │
                    │ Reverse Proxy   │
                    └────────┬────────┘
                             │
              ┌──────────────┴──────────────┐
              │                             │
              ▼                             ▼
      admin.local                    api.local
              │                             │
              └──────────────┬──────────────┘
                             ▼
                    ┌─────────────────┐
                    │     Laravel     │
                    │ PHP-FPM 8.3     │
                    └───────┬─────────┘
                            │
          ┌─────────────────┼─────────────────┐
          ▼                 ▼                 ▼
   PostgreSQL           Redis          Queue Workers
   Base de données      Cache          Jobs Async
```

---

## Services Docker

### Laravel

Le conteneur Laravel contient :

* L'application métier
* Les routes Web
* Les routes API
* Les contrôleurs
* Les modèles Eloquent
* Les migrations
* Les jobs et événements

Laravel est exécuté via PHP-FPM et ne communique jamais directement avec le navigateur.

Toutes les requêtes passent d'abord par Nginx.

---

### Nginx

Nginx joue le rôle de Reverse Proxy.

Ses responsabilités :

* Recevoir les requêtes HTTP
* Servir les fichiers statiques
* Transmettre les requêtes PHP à Laravel
* Effectuer le routage par domaine

Exemple :

```text
admin.local
    ↓
Nginx
    ↓
Laravel
```

```text
api.local
    ↓
Nginx
    ↓
Laravel
```

Le même projet Laravel sert donc à la fois :

* Le Dashboard Administrateur
* L'API REST

---

### PostgreSQL

PostgreSQL est le système de gestion de base de données principal.

Il stocke :

* Utilisateurs
* Rôles
* Permissions
* Campagnes
* Influenceurs
* KPI
* Paiements
* Paramètres applicatifs

Les données sont persistées grâce à un volume Docker.

---

### Redis

Redis est utilisé pour :

* Le cache Laravel
* Les sessions (si nécessaire)
* Les files d'attente (queues)
* Le stockage temporaire de données

Configuration Laravel :

```env
CACHE_STORE=redis
QUEUE_CONNECTION=redis
```

Redis permet d'améliorer fortement les performances de l'application.

---

### Node / Vite

Le conteneur Node est utilisé uniquement en environnement de développement.

Il fournit :

* Vite
* Hot Module Reload (HMR)
* Compilation des assets

Exemple :

```text
resources/js
resources/css
```

↓

```text
Vite
```

↓

```text
public/build
```

En production, aucun conteneur Node n'est nécessaire.

Les assets sont directement compilés dans l'image Docker de production.

---

## Routage applicatif

### Dashboard Administrateur

Domaine :

```text
http://admin.local:8000
```

Routes :

```php
routes/web.php
```

Réponses :

```text
HTML
Blade
Dashboard Admin
```

Exemples :

```text
/dashboard
/users
/roles
/settings
```

---

### API REST

Domaine :

```text
http://api.local:8000
```

Routes :

```php
routes/api.php
```

Réponses :

```json
{
  "success": true
}
```

L'API est destinée à être consommée par :

* Vue.js
* Nuxt.js
* Applications mobiles
* Services tiers

Exemples :

```text
/api/login
/api/users
/api/roles
/api/campaigns
```

---

## Authentification

L'authentification API repose sur Laravel Sanctum.

Processus :

```text
Login
  ↓
Création d'un token
  ↓
Retour du token au client
  ↓
Authorization: Bearer TOKEN
  ↓
Accès aux routes protégées
```

Exemple :

```http
Authorization: Bearer 1|xxxxxxxxxxxxxxxxxxxx
```

---

## Environnements

Le projet sépare les environnements :

### Développement

Fichier :

```text
docker-compose.dev.yml
```

Caractéristiques :

* Code monté en volume
* Hot Reload
* Vite
* Debug simplifié

---

### Production

Fichier :

```text
docker-compose.yml
```

Caractéristiques :

* Image optimisée
* Multi-stage build
* Assets compilés
* Aucun bind mount
* Prête pour Kubernetes

---

## Vision cible

L'objectif final du projet est de reproduire une architecture proche d'un environnement réel de production :

```text
Laravel API
Vue/Nuxt Frontend
PostgreSQL
Redis
Queue Workers
CI/CD GitHub Actions
Docker Hub
GitHub Container Registry
Kubernetes
```

Cette architecture servira de base pour les étapes suivantes du parcours Docker → Kubernetes → DevOps.
