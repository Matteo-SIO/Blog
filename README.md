# Installation:
## Dependencies:
* install ``php 8.1`` and ``mysql/mariadb``
* install ``composer``
* ``cd`` into the project directory
* execute ``php ./composer.phar install``

## Database:
* modify database credentials in ``propel.php``
* execute ``./vendor/bin/propel config:convert`` to update the configuration
* execute ``./vendor/bin/propel model:build`` to build the model files
* execute ``./vendor/bin/propel sql:build`` to build the sql files
* execute ``./vendor/bin/propel sql:insert`` to insert the sql files into the database

## Configuration:
* modify ``/config/global.php`` with your desired configuration
* modify ``/config/install.php`` with your desired admin user credentials
* execute ``php ./config/install.php`` to create roles and the admin user

# Content of the project:
* ``/pages/index.php``: root page (listing recent posts)
* ``/pages/admin.php``: admin page (can manage roles and users)
## Authentication:
* ``/pages/login/register.php``: create new account and connect to it
* ``/pages/login/login.php``: connect to existent account
* ``/pages/login/logout.php``: destroy session
## Publishing:
* ``/pages/publisher/publisher.php``: create new post
## Reading:
* ``/pages/view/view.php``: read a post (with comments, can moderate if moderator)

# Maintenance:
* on change of ``schema.xml``, do 'database' steps above
* Read propel2 documentation for more information about ORM
* Require ``./api/mainLoader.php`` to load ORM and all API files

# Usage:
* The root page is in ``/pages/``
* This repo is public

# Credits:
* [Propel](https://github.com/propelorm/Propel2)