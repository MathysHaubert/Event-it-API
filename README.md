# Event-it-API

This is the API for event-it web application.
To run it just run a `docker compose up` and it will automaticly create your database if it was not created before on the machine.

In case the database is not created you can run in your php-api container :

`php src/bin/doctrine.php orm:schema-tool:create`

If at one point you want to modify or add an entity you will have to run the following commands in the php-api container :

`php src/bin/doctrine.php orm:schema:update --dump-sql`

`php src/bin/doctrine.php orm:schema-tool:update --force`
