# AWS-beanstalk-wordpress-EFS
This is a bunch of scripts in .ebextensions for wordpress to use EFS with AWS beanstalk.
The scripts mount EFS, then copy wordpress from /var/app/current to /var/app/efs so beanstalk autoscaling can be used without having to worry about constantly syncing plugins or content. Thus allowing for wordpress to be more handsfee for autoscaling.
It also allows for symlinking from the apache Webroot in beanstalk webserver instances to the webshare and also installs webmin for those that like a gui to mange instances.
It also includes config for New Relic infrastructure monitoring.
It also creates a cron job to run the EFS mount script every 5 minutes to check to see if EFS is mounted, if WordPress is installed in your EFS share, if not it copies it after 5 minutes and then creates a symlink from the /var/app/current Webroot to the new EFS share web root. It will also check if your symlink is good.
I have included the sample wp-config.php file which also has the SSL checks in it a calls the keys file for the salt configs as beanstalk variables.
How to
1.	Download wordpress https://wordpress.org/latest.zip and extract the .zip to a folder 
2.	Create a new .ebextensions folder in the root of the extracted wordpress install zip
3.	Add these files to a new .ebextensions folder in the root of the woordpress install .zip
4.	You'll need to add your own values for Wordpress salt keys from here > https://api.wordpress.org/secret-key/1.1/salt/ in the 03keys.config file.
5.	You'll need to add your EFS File System ID to the 01efsmount.config file from your EFS console. (Remember this is VPC specific and only instances in the same VPC can access your EFS share.)
6.	Don't forget to update the WP-Config.php in the ZIP file with your RDS username, password and RDS (use aurora its easiest ) cluster end point. 
7.	Remember to zip the contents of the wordpress zip with .EBextensions folder not just the top level folder otherwise Beanstalk won't extract the contents correctly.
8.	Remember to wait until the next 5 minute mark for the cron job to do its thang.
9.	Log into wordpress via the beanstalk url and create your user name and password
10.	Go to route 53 and configure your dns names to point to beanstalk url.
11.	Remember if your using multisite, use a Route53 A record from your domain names root (mydomain.com > A record with Alias to mydomain.aws-region.beanstalk.com 
12.	create your certificate in certificate manager (its free so always use SSL) and assign it in the beanstalk ELB in the beanstalk console.
13.	Log into wordpress  using your new URL and change the default site and base url in General setting before enabling multisite.
14.	Go to tools > network and enable multsite and follow the instructions provided.
15.	Log ino your instances to create a new root password with sudo su > passwd  
16.	Use webmin (enable authentic theme) to update the .htaccess file and wp-config file in the /var/app/efs directory under NOT the install zip or it won’t work.
Happy wordpressing.
You could get fancy with cloudfront but this should be good enough in most cases.
TO-DO
Add a new cron job to clean up the wpconfig copy log files in /TMP once a week and send them off to S3
Add New Relic APM script.
