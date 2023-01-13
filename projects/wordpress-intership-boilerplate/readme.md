##Requirements

* Docker (https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-ubuntu-20-04-ru)
* Docker compose (https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-compose-on-ubuntu-20-04-ru)
* Nodejs 14+
* wp cli (https://wp-cli.org/)
* docker nginx proxy (https://github.com/nginx-proxy/nginx-proxy)

## Preparing

1. add wib.local and phpmyadmin.wib.local to `/etc/hosts`;
2. install wordpress to the `.wordpress` directory;
3. create or change constants in the `.wordpress/wp-config.php`:
```php
define('FS_METHOD', 'direct');

define('WP_SITEURL', getenv('BASE_URL'));
define('WP_HOME', getenv('BASE_URL'));

define('DB_NAME', getenv('MYSQL_DATABASE'));
define('DB_USER', getenv('MYSQL_USER'));
define('DB_PASSWORD', getenv('MYSQL_PASSWORD'));
define('DB_HOST', 'mysql');
```
4. clone .env.example as .env in the `infrastructure` directory;
5. execute `npm run infrastructure/up` from the `project root` directory.
6. specify git remote.