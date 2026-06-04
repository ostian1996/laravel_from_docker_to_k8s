# ─── Stage 1 : builder (compile les extensions, installe Composer) ───────────
FROM php:8.3-fpm-alpine AS builder

RUN apk add --no-cache \
    postgresql-dev \
    libzip-dev \
    zip \
    unzip \
    autoconf \
    gcc \
    g++ \
    make \
    linux-headers

RUN docker-php-ext-install pdo pdo_pgsql zip \
 && pecl install redis \
 && docker-php-ext-enable redis

# Copie uniquement ce dont Composer a besoin
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /var/www
COPY composer.json composer.lock ./

# ─── Stage 2 : production ─────────────────────────────────────────────────────
FROM php:8.3-fpm-alpine AS production

# Seulement les libs runtime (pas les headers, pas les compilateurs)
RUN apk add --no-cache \
    libpq \
    libzip

# Copie les extensions compilées depuis le builder
COPY --from=builder /usr/local/lib/php/extensions/ /usr/local/lib/php/extensions/
COPY --from=builder /usr/local/etc/php/conf.d/    /usr/local/etc/php/conf.d/

WORKDIR /var/www

# Copie vendor installé sans dépendances dev
COPY --from=builder /usr/bin/composer /usr/bin/composer
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copie le code de l'application
COPY . .

RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]