Description and homepage
------------------------

https://onetimepaste.org

Requirements
------------
In order to get OneTimePaste to work on your server you need:

- PHP 5.1 or greater
- php mcrypt support (i.e. php5-mcrypt in Debian based distros)
- php MySQL support (i.e. php5-mysql in Debian based distros)

Instalation
-----------
- Extract (or copy) the files in a directory under you web server root
  directory.
- Edt config.php and set the correct $base_url, also set the cron job as
  indicated in that file if you want to delete messages after a certain amount
  of time.
- Create a database in mysql and a user with priviledges for it. The scheme for
  the database is in mysql.sql.
- Edit storage/mysql.config.php and set the correct user/password and database
  name.
- Profit!

Avoiding MySQL
--------------
If you want to develop a different storage backend, follow this steps:
- Create a file named BACKEND_NAME.php under storage/
- Your file will must not output anything, but must contain the following
  functions: read_msg, save_msg and purge_old. Just check the current ones for
  their behaviour.
- Change $backend in config.php :-)
