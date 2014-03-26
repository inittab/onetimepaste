Description and homepage
------------------------

https://onetimepaste.org

Requirements
------------
In order to get OneTimePaste to work on your server you need:

- PHP 5.1 or greater
- php mcrypt support (i.e. php5-mcrypt in Debian based distros)
- (optional) php MySQL support (i.e. php5-mysql in Debian based distros)

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

Avoiding MySQL dependency
-------------------------
There's a file based storage backend now (and it's the default).

If you want to develop a different storage backend, follow this steps:
- Create a file named BACKEND_NAME.php under storage/
- Your file will must not output anything, but must contain the following
  functions: read_msg, save_msg and purge_old. Just check the current ones for
  their behaviour.
- Change $backend in config.php :-)

Upgrading from versions prior to 2.0 using the MySQL storage backend
--------------------------------------------------------------------
The first releases of onetimepaste's MySQL backend had BLOB as the column type
for message storage, since there was no file upload support.
That column type (max 64kB) is not enough to hold files (unless very small).
You SHOULD change the column type to (at least) MEDIUMBLOB, with a MySQL command
like this:

mysql> ALTER TABLE pastes CHANGE message message mediumblob NOT NULL;

If you upgrade onetimepaste and don't change the column type, your file uploads
will be lost!
