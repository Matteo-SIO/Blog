# Installation:
## Dependencies:
* install ``php 8.1`` and ``mysql/mariadb``
* install ``composer``
* ``cd`` into the project directory
* execute ``php ./composer.phar install``

## Configuration:
* modify database credentials in ``propel.php``
* execute ``./vendor/bin/propel config:convert`` to update the configuration

## Database:
* execute ``./vendor/bin/propel model:build`` to build the model files
* execute ``./vendor/bin/propel sql:build`` to build the sql files
* execute ``./vendor/bin/propel sql:insert`` to insert the sql files into the database

# Usage:
* The root page is in ``/pages/``
* This repo is public

# Maintenance:
* on change of ``schema.xml``, do 'database' steps above
* Read propel2 documentation for more information about ORM

# Credits:
* [Propel](https://github.com/propelorm/Propel2)