#!/bin/bash

# Wait for MySQL container to be ready
until nc -z -v -w30 mysql_host 3306
do
    echo "Waiting for MySQL container to be ready..."
    sleep 5
done

# Set the MySQL host and port
export PMA_HOST=mysql_host
export PMA_PORT=3306

# Start PHPMyAdmin
exec /usr/sbin/apache2ctl -D FOREGROUND