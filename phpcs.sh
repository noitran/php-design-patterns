#!/bin/sh

## chmod +x phpcs.sh
## ./phpcs.sh

php-cs-fixer --verbose fix --allow-risky=yes --config=.php_cs.dist
