<?php
error_reporting(0);
//-----------------------------------------------------------------------------------------------
$API_KC = "1957221944:AAFO4QNVw5gJFc6W2foZK672Adrqko-a56w";#token
$adminm = 1390918103;#ایدی عددی ادمین اصلی
//-----------------------------------------------------------------------------------------------
$dbname = "robot_up"; //  Name db
$username = "robot_up"; // Username db
$password = 'erfandrawer1385'; // Pass username db
//-----------------------------------------------------------------------------------------------
$connect = mysqli_connect("localhost", $username, $password, $dbname);
mysqli_query($connect,"SET SESSION collation_connection = 'utf8_persian_ci'");
//-----------------------------------------------------------------------------------------------
$API_TEL = json_decode(file_get_contents('https://api.telegram.org/bot'.$API_KC.'/getme'));
$botid = $API_TEL->result->id;
$bottag = $API_TEL->result->username;
//-----------------------------------------------------------------------------------------------
/*
سورس ربات آپلودر
پیشرفته ترین آپلودر تلگرام
اوپن شد در کانال 
@San_trich

pv @Ziazl

حمایت کنید نسخه اصلی نیست این نسخه اصلی دارای تنظیمات سین و تغییر انوع متون میباشد
اصکی بدون ذکر منبع ممنوع
اگه اصکی بری و منبع نزنی ....
*/