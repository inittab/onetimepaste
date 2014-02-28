<?php
# Site URL, you should REALLY run it under https
$base_url="https://CHANGE_THIS_TO_YOUR_SITE_ADDRESS";
# storage backend, storage config in storage/_BACKEND_.config.php
$backend="mysql";
# days till an unread message is purged from the DB
# remember to set a cronjob like
# 0 * * * * YOUR_USER /usr/bin/curl https://1tp.es/cron.php
$hours_expire=72;
?>
