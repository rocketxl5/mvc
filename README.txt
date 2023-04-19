# About mvc

MVC is a PHP blueprint of the architectural setup for the development of dynamic web applications.
It connect to a database via a PHP PDO class that instantiate a PDO object.  


# Installastion

Updating files:

@ /public/.htaccess 

  RewriteBase base of the mod rewrite file have to be updated with the current 
  public directory path of your project. Ex: RewriteBase /mvc/public

@ /app/config/config.php

  Database, URL and Sitename Global variables have to be updated with the actual values 
  of your database and project.