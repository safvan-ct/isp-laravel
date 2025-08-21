composer require laravel/breeze --dev - https://github.com/laravel/breeze
composer require spatie/laravel-permission - https://spatie.be/docs/laravel-permission/v6/basic-usage
composer require yajra/laravel-datatables-oracle

// Setup on server 
- git clone
- curl -sS https://getcomposer.org/installer | php -- --2 install on project folder
- use php composer.phar instead of composer
- copy public files to root folder : cp -r public/* /home/u316993456/domains/islamicstudyportal.org/public_html/dev/
- update index.php
- add .htaccess file on root

// Permission
chmod -R 755 .
chmod -R 755 storage bootstrap/cache

// CMD
- create: touch
- view: nano
- delete: rm -rf


<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Redirect all requests to index.php
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
