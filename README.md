![Screenshot](https://github.com/sinakhoshdel/crud-php-oop-pdo/blob/master/assets/Screenshot.png "CRUD")
<br>
<h3>Installation steps:</h3>

Create a new db -> <strong>DB name : removify</strong><br>
run this sql file removify.sql in your phpMyAdmin<br>
you can clone this to your xammp or any other local server you have and the only change you need is this:
for example:
<pre>http://localhost:8080/removify</pre>

but If you want to have it on your own follow these steps:

1- add this to your host file
<pre>
127.0.0.1 dev.removify.com
</pre>
2-add this to httpd.conf
<pre>
<Directory "C:/Users/{your username}/workspace">
     AllowOverride      All
     Order              Deny,Allow
     Allow              from all
Require all granted
</Directory>
<VirtualHost *:80>
    ServerAdmin webmaster@dummy-host.example.com
    DocumentRoot "C:/Users/{your username}/workspace/removify"
    ServerName  dev.removify.com
    ErrorLog logs/crud-error_log
</VirtualHost>
</pre>

3-Restart your appache and reach dev.removify.com

