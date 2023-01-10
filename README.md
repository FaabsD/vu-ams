# VU-AMS Theme

 WordPress theme built for [VU-AMS](https://vu-ams.nl)

## For further development on MacOS

- Install [Homebrew](https://brew.sh/) if not already installed.

- Install PHP using [Homebrew](https://brew.sh/) `brew install php`. Or for specific version `brew install php@8.0` any version from php7.4 up to php8.2 will work.

- Install [Composer (PHP) package manager](https://getcomposer.org/). Can also be installed using Homebrew: `brew install composer`

- Webserver software: Laravel Valet for installation see:
  [Laravel Valet](https://laravel.com/docs/9.x/valet#installation) (Requires: [Homebrew](https://brew.sh/) and PHP installed via Homebrew)

- MySQL (can be installed using Homebrew `brew install mysql` follow instruction after installation to make MySQL start when MacOS starts)

> Another option is to install [XAMMP](https://www.apachefriends.org/) or [MAMP](https://www.mamp.info/en/mamp/mac/) which sets Apache, PHP, MySQL up for you, The only thing you to install yourself in this case is Composer.

### After installing Laravel Valet

1. First navigate of create a folder in which you want to store your local websites.

2. Then open the (created) folder in your command-line

3. Run the following command: `valet park` this will set laravel to use any subfolder within this folder as a local site.

4. To test if it works
    1. create a folder. Call it whatever you want (e.g. test).
    2. inside the folder create an index.php file.
    3. open the index.php file
    4. put in the following code `<?php echo php_version(); ?>`.
    5. save & close the file
    6. go into any browser and type:  "your_folder_name".test

5. if you are presented by a screen showing the PHP version it works. If not repeat the steps from step 4. Or try reinstalling Laravel Valet

6. check if MySQL works
   1. install a database viewer like [Sequel ace](https://apps.apple.com/nl/app/sequel-ace/id1518036000?mt=12) or [MySQL workbench](https://dev.mysql.com/downloads/workbench/)
   2. depending on the viewer (using Sequel Ace as example)
      - click "QUICK CONNECT"
      - type `127.0.0.1` or `localhost` (whichever you prefer) for Host
      - type `root` for Username
      - leave Password empty
      - leave "Database" and "Port" empty
      - click "Test connection"
      - if you get the message "Connection succeeded" (on the left from the Connect button) click connect or you can click "Add to favorites under the message first so you don't have to repeat this next time
   3. If connecting is successful you're done if not try restarting MySQL by typing `brew services restart mysql` in the command-line or check the documentation for your database viewer.

## For further development on Windows

- install a webserver of choice. easiest options are:

  - [WampServer](https://www.wampserver.com/en/) (installs: PHP, Apache, MySQL, PHPMyAdmin. Pretty easy to switch PHP version from the interface).
  - [XAMMP](https://www.apachefriends.org/) (installs: PHP, Apache, MariaDB(MySQL) & PHPMyAdmin. PHP version is switchable from submenu in taskbar icon)
  - [Laragon](https://laragon.org/docs/) (full download installs: Apache, Nginx, MySQL, PHP, Node.js, npm, git & Composer. Any package already present on system can be removed from laragon check the [docs](https://laragon.org/docs/disposable.html). Also features pretty urls (my_site.test) )

> Or you can install any webserver software of your choice.
Depending on your choice you have to install [Composer](https://getcomposer.org/doc/00-intro.md#installation-windows) by yourself
> all of the Webservers listed above create a folder named after the webserver software on the C disk in which you will find a folder called "www", "sites" or "htdocs".

### To check if it's working

- start the webserver.

- create a folder of any name inside the folder of said names.

- within that folder create a new PHP file called `index.php`

- open the `index.php` file and type: `<?php echo php_version(); ?>`.

- save and close the `index.php` file.

- in your browser type `localhost:80/your_folder_name` or `localhost:8080/your_folder_name` or in case you chose Laragon as your Webserver type: `your_folder_name.test`.

  - if everything was installed correctly you should see a screen showing the current PHP version if not try restarting/reinstalling the webserver.
- To check if the database was installed correctly go to `localhost:80/phpmyadmin` / `localhost:8080/phpmyadmin` Or from Laragon inside the submenu open mysql and then the first option. The standard database login is username: `root` passwd: leave empty or `root`.

## Before cloning the theme

Before you clone the theme make sure you have a copy of the [VU-AMS website](https://vu-ams.nl) running on your local webserver.
The easiest way to do this is to:

- go to the [WordPress dashboard](https://vu-ams.nl/wp-admin)
- login using your credentials
- from the left side menu go to Duplicator
  - If Duplicator is not present go to Plugins
  - look for Duplicator in the table with installed plugins or click on inactive (above the table).
  - click on activate
  - you get a message that duplicator was activated
  - (optional) update duplicator if it says there is an update available
- When you go to Duplicator you'll see a table with Packages
- click "Create New"
- keep the settings as they are (all media will be excluded from the package)
- click Next
- after scanning the site you will see some notices
  - if the size is 1gb or greater check any folder that is inside the VU-AMS folder from the Quick filters (you won't need the theme folder because you will be cloning it)
- click "Yes. Continue with the built process
- Duplicator will start Building a package wait for this process to finish and don't close the browser tab
- after a successful build download both the installer and package files (installer.php and the zip file)
- Now on your device create a folder inside the folder your Webserver looks in (as described in "For further development on MacOS" or "For further development on Windows")
- give the folder any name you want or call it "vu-ams"
- copy the installer and package file over to the folder you just created
- go to your browser and navigate to `localhost:80/vu-ams/installer.php`, `localhost:8080/vu-ams/installer.php` or `vu-ams.test/installer.php` depending on which webserver you're running
- follow the installation steps
- when you get to database select create new database and set host to `127.0.0.1` or `localhost` with username `root` and password empty.
- click test connection.
- after checking the connection works you can click on the continue/install button which starts the installation of the files and database.
- after installation is done click on the to admin dashboard button to ga to the WordPress dashboard and login with the same credentials (users are also carried over)
- after logging in you'll see a massage from duplicator that all the leftover files are deleted.
- After installing via duplicator you should login to the site using FTP.
- From your FTP connection go to the following folder "wp-content"
- from the "wp-content" folder copy the uploads folder to your local site inside the "wp-content" folder and choose replace. To save some time you can also copy it to the desktop first

### If creating a local copy via Duplicator doesn't work

- from the hosting
  - go to the file management section
  - select all files and create a zip archive (if possible)
  - download the zip file
  - go to the database management
  - create a dump of the database
- on your device
  - unpack the zip archive you have downloaded inside the folder described in the duplicator steps (make sure in does not extract into a subfolder).
  - open your Sql viewer or PHPMyAdmin
  - import the sql file you got from the database dump
  - go into the root of your WordPress folder
  - open `wp-config.php`
  - in `wp-config.php` change the following lines:
    - `define('DB_NAME', 'current_name' );` TO `define('DB_NAME', 'local_DB_name' );` it is most likely that you don't have to change this when using this method
    - `define( 'DB_USER', 'whichever_user_that_is' );` To `define( 'DB_USER', 'root' );`
    - `define( 'DB_PASSWORD', 'password' );` TO `define( 'DB_PASSWORD', '' );`
    - `define( 'DB_HOST', 'localhost' );` this one you can keep the same
    - `define( 'DB_CHARSET', 'if_different' );` TO `define( 'DB_CHARSET', 'utf8mb4' );`
    - keep `define('DB_COLLATE', '');` as it is.
    - Also add the following lines (somewhere at the bottom of the file) to set the correct site url
      - `define('WP_HOME', 'placeholder')`
      - `define('WP_SITEURL, 'placeholder)`
      > (instead of placeholder type "localhost:80/your_folder_name", "localhost:8080/your_folder_name or "your_folder_name.test)
      > according to which local webserver your running

  - after editing the `wp-config.php` file save it and close it
  - then go to your site using the correct url
  - the site should work now

## After making sure you have copy of the site running on your local webserver

1. clone the Theme from GitHub
   - get the cloning link for the theme from GitHub
   - go to the folder of your local copy of the website
   - go to wp-content/themes
   - clone the VU-AMS theme inside the themes folder
2. go into the newly cloned folder from the terminal
    - install NPM packages type: `npm install` in terminal
    - install composer packages type: `composer install` in terminal
3. to make BrowserSync sync the right url
   - open the webpack.mix.js file
   - look for `mix.browserSync`
   - inside the `proxy` options change `target` to the link you use to open the local site in your browser
4. to compile all the loose CSS/JavaScript files to one CSS and one JavaScript file use the commands in the terminal:
   - `npm run watch` for compiling the files as you edit them (also runs browserSync to inject your changes for a live preview) you can stop this process by typing `ctrl + c` in the running terminal.
   - `npm run dev` this one is similar to `npm run watch` but it compiles the files once and stops after that
   - `npm run production` or short version `npm run pod` this script compiles the CSS ans JavaScript files for use on the live environment by minifying the files and removing unnecessary logs. Like `npm run dev` this runs only once.

