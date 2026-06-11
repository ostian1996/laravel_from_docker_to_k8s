# 1. Cloner le projet
git clone git@github.com:user/repo.git
cd From_docker_to_k8s

# 2. Créer les fichiers d'environnement depuis les templates
cp .env.example .env
cp laravel-api/.env.example laravel-api/.env

# 3. Remplir les valeurs (éditeur de texte)
# .env racine : DB_DATABASE, DB_USERNAME, DB_PASSWORD
# laravel-api/.env : APP_KEY, DB_*, REDIS_*, etc.

# 4. Générer une APP_KEY Laravel
docker run --rm -v $(pwd)/laravel-api:/app \
  composer:2 php artisan key:generate --show
# Copier la clé générée dans laravel-api/.env

# 5. Lancer
docker compose -f docker-compose.dev.yml up -d