# Easy-Web-Chat
A MySQL/PHP Web Chat!
Demo of the Chat -> [Here](http://server.marlon9757.de)

Setup:
______________________________________________________________________
*1.Install needed Applications*

1.1 Easiest Method
    Install [Xammp](https://www.apachefriends.org/de/index.html)
    or
    Install Apache
    Install Php
    Install MySQL
    Install PhpMyAdmin

1.2 Launch all the needet Modules
______________________________________________________________________
*2.Setup the Database*

2.1 Create Database in phpMyAdmin
    Click on MySQL -> Admin in the Xammp Control Panel
    (if installed separately -> Open phpMyAdmin)

2.2 Click on "SQL" and paste:
     CREATE DATABASE chat_db;
     USE chat_db;

2.3 Add Tables
     Click on the Created "chat_db" and paste:
     CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
    );
and
    CREATE TABLE messages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        message TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id)
    );
then Click "OK"
______________________________________________________________________
*3.Setup the Website*

3.1 Download the htdocs.zip from the Github Page

3.2 Extract the File to:
    C:\xampp\htdocs
    or
    the htdocs folder on Apache
______________________________________________________________________
*4.Port forwarding*

Forward the Port 80 to your PC
______________________________________________________________________

That's it!
This Tutorial is for Windows it'll work on Linux but not the same way.
