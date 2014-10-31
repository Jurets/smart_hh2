Yii 2 Advanced Application Template
===================================

Yii 2 Advanced Application Template is a skeleton Yii 2 application best for
developing complex Web applications with multiple tiers.

The template includes three tiers: front end, back end, and console, each of which
is a separate Yii application.

The template is designed to work in a team development environment. It supports
deploying the application in different environments.


DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
tests                    contains various tests for the advanced application
    codeception/         contains tests developed with Codeception PHP Testing Framework
```


REQUIREMENTS
------------

The minimum requirement by this application template that your Web server supports PHP 5.4.0.


INSTALLATION
------------


After you install the application, you have to conduct the following steps to initialize
the installed application. You only need to do these once for all.

1. Run command `php composer install`
1. Run command `init` to initialize the application with a specific environment.
2. Create a new database and configuration in `common/config/main-local.php` accordingly.
3. Apply migrations with console command `yii migrate`. This will create tables needed for the application to work.

 if you want to tune the application to use a "single point access" as additional way to deployment
 you can perform the following steps:
 
 1. Put in root .gitignore file this:
   # Single point access to site
   frontend/web/.htaccess
   backend/web/.htaccess
 2. Create a .htaccess files in backend/web and frontend/web with:
   #hide index.php
   RewriteEngine On
   RewriteCond %{REQUEST_FILENAME} !-f
   RewriteCond %{REQUEST_FILENAME} !-d
   RewriteRule . index.php
 3.  Add in frontend/config/main-local.php:
       in the root section: 'homeUrl' => '/',
       in the components section:
       'urlManager' => [
              'baseUrl' => '/',
          ],
 4. Add in backend/config/main-local.php:
       in the root section: 'homeUrl' => '/admin',
       in the components section:
       'urlManager' => [
              'baseUrl' => '/admin',
          ],
 5. In the root directory of your project create .htaccess with:
     RewriteEngine On
     RewriteBase /

     RewriteRule ^admin/?(.*) backend/web/index.php/$1 [L]

     RewriteCond %{REQUEST_URI} !/backend/web/index.php/
     RewriteCond %{REQUEST_URI} !/frontend/web/index.php/

     RewriteRule (.*) frontend/web/index.php/$1 [L]
 
 After that steps you may use just one webserver for frontend and backend tjgether:
   yoursite.ex/
   yoursite.ex/admin


