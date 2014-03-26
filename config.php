<?php
# Site URL, you should REALLY run it under https
$base_url="https://".$_SERVER['HTTP_HOST'].pathinfo($_SERVER['PHP_SELF'])['dirname'];
# you may want to override the auto-detected URL
#$base_url="https://CHANGE_THIS_TO_YOUR_SITE_ADDRESS";

# storage backend, storage config in storage/_BACKEND_.config.php
$backend="textfiles";
#$backend="mysql";

# days till an unread message is purged from the DB
# remember to set a cronjob like
# 0 * * * * YOUR_USER /usr/bin/curl https://YOUR_INSTALLATION_URL/cron.php
$hours_expire=72;

# max upload filesize (in megabytes)
# check the value is smaller than php.ini's upload_max_filesize & post_max_size
# set to 0 to remove the limit
$max_upload_size=5
?>
