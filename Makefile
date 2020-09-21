serve:
	php artisan serve --port=7000
migrate:
	php artisan migrate:fresh --seed
optimize:
	php /home/mydan3/composer.phar dump-auto -o
	php artisan optimize
	php artisan route:cache
	php artisan view:cache
	php artisan config:cache