docker run -i -t -p 80:80 -p 3306:3306 -v "%~dp0/app:/app" -v "%~dp0/mysql:/var/lib/mysql" -v "%~dp0/logs:/var/log/apache2" fuzzpault/php-mysql-nosql-php