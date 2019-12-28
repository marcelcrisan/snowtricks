Snow Tricks
Codacy Badge


Community website about snowboard tricks

Prerequisites
Environment :

PHP 7
MySQL 14.14
You must have installed the following before install :

Git
Composer
Installing
Cloning the project repository :

https://github.com/marcelcrisan/snowtricks
Edit .env.dist by adding your MAILER_URL and admin mail in the parameters. Then rename the file .env.

Getting all dependencies :

$ composer install
Configure a DATABASE_URL constant, at the web server level, as explained here. Or edit the .env file and insert your database address :

DATABASE_URL=mysql://[db_user]:[password]@[IPaddress]:[port]/[db_name]
Setting up your database :

$ php bin/console make:migration
$ php bin/console doctrine:migrations:migrate
Loading fixture content :

$ php bin/console doctrine:fixtures:load
The default account have the following credentials :

User : "usertrick"
Email : user@snowtricks.com.
Password : "snowpass"
Running the tests
First, make sure to edit the phpunit.xml.dist file to define the DATABASE_URL and ADMIN_MAIL constants. Then, from the root folder of your project :

$ php vendor/bin/phpunit
Built with
Symfony 4.3 - PHP Framework
Composer - Dependency management
Author
Marcel Crisan- PHP developper
