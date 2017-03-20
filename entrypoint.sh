#!/usr/bin/env sh

composer dump-autoload --optimize --apcu
composer run-script post-install-cmd --no-interaction

bin/console cache:clear -n -e=prod

chmod 0777 -R /var/app/app/cache
chmod 0777 -R /var/app/app/logs

exec apache2-foreground