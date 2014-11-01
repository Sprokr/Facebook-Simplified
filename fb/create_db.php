<?php
require 'db.inc.php';

$db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or
    die ('Unable to connect. Check your connection parameters.');

$sql = 'DROP DATABASE IF EXISTS  '.MYSQL_DB.' ';
mysql_query($sql, $db) or die(mysql_error($db));


$sql = 'CREATE DATABASE '.MYSQL_DB;
mysql_query($sql, $db) or die(mysql_error($db));


mysql_select_db(MYSQL_DB, $db) or die(mysql_error($db));



$sql = 'CREATE TABLE IF NOT EXISTS users (
        userid       INTEGER UNSIGNED       NOT NULL UNIQUE AUTO_INCREMENT,
        user_name    VARCHAR(50)     NOT NULL DEFAULT "",
        email        VARCHAR(50)     NOT NULL DEFAULT "",
		password     CHAR(50) )';
mysql_query($sql, $db) or die(mysql_error($db));



$sql = 'CREATE TABLE IF NOT EXISTS user_info (

        userid           INTEGER UNSIGNED    NOT NULL UNIQUE ,
        user_name        VARCHAR(50)         NOT NULL,
		name             VARCHAR(100)        NOT NULL,
        sex              VARCHAR(10)         NOT NULL,
        interest         VARCHAR(10)         NOT NULL,
        status           VARCHAR(20)         NOT NULL,
		dob              DATE        NOT NULL, 
        city             VARCHAR(25)         NOT NULL,
        state            VARCHAR(25)         NOT NULL,
        contact          VARCHAR(15)         NOT NULL,
		inst12           VARCHAR(50)         NOT NULL,
		instgrad         VARCHAR(50)         NOT NULL,
        year12           VARCHAR(50)         NOT NULL,
		yeargrad         VARCHAR(50)         NOT NULL,
        photo            LONGBLOB                NOT NULL,
		current_status   VARCHAR(50)         NOT NULL,
        photo_name       VARCHAR(50)         NOT NULL,   
		workexp          VARCHAR(50)         NOT NULL,
		email            VARCHAR(100)        UNIQUE,  
        		
		PRIMARY KEY (user_name),

		INDEX (userid)
		
		)';
mysql_query($sql, $db) or die(mysql_error($db));	


$sql = 'CREATE TABLE IF NOT EXISTS users_activity (
        userid       INTEGER UNSIGNED  NOT NULL ,
		user_name    VARCHAR(50)       NOT NULL DEFAULT "",
		activity_id   VARCHAR(20)  NOT NULL UNIQUE,
        activity_type VARCHAR(20)      NOT NULL,
        datetime     TIMESTAMP         NOT NULL,
        comments     VARCHAR(10)       NOT NULL DEFAULT "NO",
        likes        VARCHAR(10)       NOT NULL DEFAULT "NO",
        access_type  VARCHAR(10)       NOT NULL DEFAULT "PUBLIC",
        PRIMARY KEY (activity_id))';
mysql_query($sql, $db) or die(mysql_error($db));

$sql = 'CREATE TABLE IF NOT EXISTS users_images (
        activity_id  VARCHAR(20)  NOT NULL ,
		datetime     TIMESTAMP         NOT NULL,
        image        LONGBLOB       NOT NULL,
        imagetype        VARCHAR(10)       NOT NULL,
        caption      VARCHAR(200)       NOT NULL,
        userid INTEGER UNSIGNED  NOT NULL)';
mysql_query($sql, $db) or die(mysql_error($db));


$sql = 'CREATE TABLE IF NOT EXISTS users_status (
        activity_id  VARCHAR(20)  NOT NULL ,
		datetime     TIMESTAMP         NOT NULL,
        status     VARCHAR(500)       NOT NULL,
        userid INTEGER UNSIGNED  NOT NULL)';
mysql_query($sql, $db) or die(mysql_error($db));



$sql = 'CREATE TABLE IF NOT EXISTS users_comments (
        activity_id  VARCHAR(20)  NOT NULL ,
		datetime     TIMESTAMP         NOT NULL,
        comments     VARCHAR(200)       NOT NULL,
        commenter_id INTEGER UNSIGNED  NOT NULL)';
mysql_query($sql, $db) or die(mysql_error($db));






$sql = 'CREATE TABLE IF NOT EXISTS users_friends (
        userid       INTEGER UNSIGNED    NOT NULL ,
		friends_id   INT(10)        NOT NULL,
        friendship_status  VARCHAR(20) NOT NULL )';
mysql_query($sql, $db) or die(mysql_error($db));


$sql = 'CREATE TABLE IF NOT EXISTS users_notifications (
        userid      INTEGER UNSIGNED  NOT NULL,
        notification VARCHAR(50)       NOT NULL, 
        activity_id  VARCHAR(20)  NOT NULL )';
mysql_query($sql, $db) or die(mysql_error($db));

echo 'Success!';
?>
