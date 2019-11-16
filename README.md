# Magic-adt-sql
framework sederhana khusus untuk pemograman android studio

Tambahkan file .htaccess satufolder dengan index.php

Options -Multiviews

RewriteEngine On

RewriteCond %{REQUEST_FILENAME} !-d

RewriteCond %{REQUEST_FILENAME} !-f

RewriteRule ^(.*)$ index.php?url=$1 [L] 

