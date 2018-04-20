## PdfList sample project

Project requirements: php7.1+, nginx, npm, composer, imagick

Project deployment: steps

Project was developed and tested on Homestead environment. 
You can get more info on how to setup it here: https://laravel.com/docs/5.6/homestead

To install the project, you need to:

cmd: git clone https://github.com/andrewtarkovsky/pdflist.git

Install imagick

1. cmd: sudo apt-get update
2. cmd: sudo apt-get install pkg-config libmagickwand-dev -y
3. cmd: sudo pecl install imagick-beta
4. cmd: Edit your system's active php cli ini file(normally /etc/php/7.2/cli/php.ini), add 'extension=imagick.so' to other extensions
5. cmd: Edit your system's active php fpm ini file(normally /etc/php/7.2/fpm/php.ini), add 'extension=imagick.so' to other extensions
6. cmd: sudo service nginx restart

Proceed with dependency installation

1. cmd: composer install
2. cmd: npm install (depending on your rights, it may require to add "sudo", like "sudo npm install")
3. cmd: npm run dev
4. create .env file in the root of the project, fill it with data form .env.example (right beside it)
5. cmd: php artisan migrate
6. cmd: php artisan storage:link

Now, the site should be available on the location you've chosen for it in nginx sites-available/YOURSITENAME.conf file