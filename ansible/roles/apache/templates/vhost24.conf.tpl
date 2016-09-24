# Default Apache virtualhost template

<VirtualHost *:80>
    ServerName {{ apache.servername }}
    DocumentRoot {{ apache.docroot }}

    <Directory {{ apache.docroot }}>
        AllowOverride None
        Require all granted
        Allow from All

        <IfModule mod_rewrite.c>
            Options -MultiViews
            RewriteEngine On
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteRule ^(.*)$ app.php [QSA,L]
        </IfModule>
    </Directory>

    ErrorLog /var/log/apache2/project_error.log
    CustomLog /var/log/apache2/project_access.log combined
</VirtualHost>
