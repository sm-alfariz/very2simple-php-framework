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
  - apache use .htaccess, nginx set config (search google how to remove index.php from uri apache or ngix)

sekarang sudah menjadi Frame work php sederhana dari awal yang native

** saya sertakan juga dump mysql untuk database nya

referensi :
* [Elequont laravel](https://laravel.com/docs/5.3/eloquent)
* [Twig Template](twig.sensiolabs.org/documentation)
* [bootsratp](getbootstrap.com/getting-started/)
* [composer](https://getcomposer.org/)
