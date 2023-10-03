# OpenLink
(2023 rewrite)

OpenLink is a link shortener based on HiberLink. This is it's rewrote version in Symfony with Tailwind. It used to be made in bare PHP with handwritten CSS.

<img src="showcase/dark.jpg" alt="OpenLink Dark Mode"/>
<hr>
<img src="showcase/white.jpg" alt="OpenLink White Mode" />

## Docker Setup
- `cp .env.example .env`
- edit .env
- `docker compose up -d`
- `docker compose exec php bin/console doctrine:migrations:migrate`

After building, don't forget to remove unused images.

## Non-Docker Setup
- `cp .env.example .env`
- edit .env
- `composer install`
- `php bin/console doctrine:migrations:migrate`
- `npm install`
- `npm run build`
- `composer dump-env prod`
- [dev]: symfony server:start