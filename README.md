#very2simple : Very very simple php Framework
##instalasi :
- Kalo via git yah tinggal di clone aja
- Folder Template ada view
- Model table ada di folder model namespace Model
- Route untuk framework nya adalah file url.php 
- web root ada di folder public
- edit configurasi database.yml menyesuaikan dengan database di komputer masing masing
- karena saya tidak sertakan folder vendor dan bower_components jadi :
  install sendiri di komputernya via composer : composer update (didalam folder projek)
- jika ingin source bootsrap dan jquery ada di local seperti contoh maka mesti install via bower :
  bower install bower install bootstrap, yah klo mau css sama js di load dari internet/cdn edit 
  layout.twig 	
- Install bower di dalam folder public install jquery dan bootsrap
- Run php developing server ``` php -S localhost:8000 -t public/ ```
- untuk berjalan dengan web server yang ada pastikan web server sudah di config untuk remove index.php
  - apache use .htaccess, nginx set config 
### Friendly URL

Untuk apache .htaccess taruh di root web (public) dan Apache sudah enabled mod_rewrite

```apache
Options +FollowSymLinks
RewriteEngine On
RewriteRule ^(.*)$ index.php [NC,L]
```

contoh config nginx:

```nginx
server {
	listen 80;
	server_name very2simple.dev;
	root /var/www/very2simple/public;

	index index.php;

	location / {
		try_files $uri $uri/ /index.php?$query_string;
	}

	location ~ \.php$ {
		fastcgi_split_path_info ^(.+\.php)(/.+)$;
		# NOTE: You should have "cgi.fix_pathinfo = 0;" in php.ini

		# With php5-fpm:
		fastcgi_pass unix:/var/run/php5-fpm.sock;
		fastcgi_index index.php;
		include fastcgi.conf;
		fastcgi_intercept_errors on;
	}
}
```  


- saya sertakan juga dump mysql untuk database nya
- dan Masi banyak perlu pengembangan contoh seperti middleware,auth,psr-7 http request, pagination akan saya kembangkan perlahan silahkan request bila ada yg mau bantuin :D
- Starting developing for make backend front with vue js 
referensi :
* [Elequont laravel](https://laravel.com/docs/5.3/eloquent)
* [Twig Template](twig.sensiolabs.org/documentation)
* [bootsratp](getbootstrap.com/getting-started/)
* [composer](https://getcomposer.org/)
