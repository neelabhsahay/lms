# Leave Management System
=========================


Leave Management using REST API. The Database is in lms/api/DATABASE/mylms.sql.

This use JWT for authorization. It uses a library called PHP-JWT (https://github.com/firebase/php-jwt). 

We will need to install use \Firebase\JWT\JWT


api directory contain the REST API which does the Leave management system.

web is the directory where the the web site reside. 
app is the directory where the mobile application code reside. ( TOD ).

we can install all these directories on different servers.

At present we install something line this:

  www.leavemanagementsystem.com
                or
                     /localhost
                              |
                              V
                              |
                              +--/api
                              |
                              +--/web
