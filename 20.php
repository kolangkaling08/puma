##
# @package    Joomla
# @copyright  Copyright (C) 2005 - 2020 Open Source Matters
# @license    GNU General Public License version 2 or later; see LICENSE.txt
##

## No directory listings
<IfModule mod_autoindex.c>
  IndexIgnore *
</IfModule>

## Security headers
<IfModule mod_headers.c>
  Header always set X-Content-Type-Options "nosniff"
</IfModule>

## Symlinks + no indexes
Options +FollowSymlinks
Options -Indexes

## Block inline JS in SVG
<FilesMatch "\.svg$">
  <IfModule mod_headers.c>
    Header always set Content-Security-Policy "script-src 'none'"
  </IfModule>
</FilesMatch>

## Enable rewrite engine
RewriteEngine On

## -------------------------
## Block common exploits
RewriteCond %{QUERY_STRING} base64_encode[^(]*\([^)]*\) [OR]
RewriteCond %{QUERY_STRING} (<|%3C)([^s]*s)+cript.*(>|%3E) [NC,OR]
RewriteCond %{QUERY_STRING} GLOBALS(=|\[|\%[0-9A-Z]{0,2}) [OR]
RewriteCond %{QUERY_STRING} _REQUEST(=|\[|\%[0-9A-Z]{0,2})
RewriteRule .* - [F]
## -------------------------

## -------------------------
## Exceptions for sitemap, robots, dll
RewriteCond %{REQUEST_URI} ^/sitemap\.xml$ [NC,OR]
RewriteCond %{REQUEST_URI} ^/robots\.txt$ [NC]
RewriteRule .* - [L]
## -------------------------

## Joomla core SEF
RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
RewriteCond %{REQUEST_URI} !^/index\.php
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule .* index.php [L]

## -------------------------
## PHP handler (update sesuai versi)
# Comment out old PHP 5.6
#<IfModule mime_module>
#  AddHandler application/x-httpd-ea-php56 .php .php5 .phtml
#</IfModule>

# Use PHP 8.1 misalnya
<IfModule mime_module>
  AddHandler application/x-httpd-ea-php81 .php .php5 .phtml
</IfModule>
## -------------------------
