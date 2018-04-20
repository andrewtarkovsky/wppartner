## Wordpress Partner sample project

Project requirements: php7.1+, nginx, npm, composer

Project deployment: steps

Project was developed and tested on Homestead environment. 
You can get more info on how to setup it here: https://laravel.com/docs/5.6/homestead

To install the project, you need to:

cmd: git clone https://github.com/andrewtarkovsky/wppartner.git

Proceed with dependency installation

1. cmd: composer install
2. cmd: npm install (depending on your rights, it may require to add "sudo", like "sudo npm install")
3. cmd: npm run dev
4. create .env file in the root of the project, fill it with data form .env.example (right beside it)
5. cmd: php artisan migrate

Now, the site should be available on the location you've chosen for it in nginx sites-available/YOURSITENAME.conf file

To use wordpress plugin:
 1. copy all the content of "wordpress_plugin" folder into your Wordpress installation folder ("wp-content/plugins");
 2. Go to wordpress administration gui panel and activate plugin "VF Comment Ratings";
 3. Alter path to current project (look for "API_URL" constant in "vfcommentratings.php", currently "http://wppartner.test");
 4. Go to post, give it a rating and comment and submit your opinion;
 5. Bingo, your rating should be included under current project '/' url list.
 
 
 To check local project for possible problems, use "phpunit" command in server console