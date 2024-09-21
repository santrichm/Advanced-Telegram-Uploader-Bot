<?php
// Don't edit This File.
// Set CronJob ( 1 min ) 
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
//---------------------- i n c l u d e --------------------------------//
include "config.php";
//------------------------------------------------------//
flush();
ob_start();
ob_implicit_flush(1);
 ini_set( "expose_php","Off" );
ini_set( "Allow_url_fopen","Off" );
ini_set( "disable_functions","exec,passthru,shell_exec,system,proc_open,popen,curl_exec,curl_multi_exec,parse_ini_file,show_source,eval,file,file_get_contents,file_put_contents,fclose,fopen,fwrite,mkdir,rmdir,unlink,glob,echo,die,exit,print,scandir" );
ini_set( "max_execution_time","25" );
ini_set( "max_input_time","25" );
ini_set( "memory_limit","15M" );
ini_set( "file_uploads","Off" );
ini_set( "post_max_size","10k" );
error_reporting(0);
ini_set( "log_errors","Off" );
ignore_user_abort(true);
date_default_timezone_set('Asia/Tehran');
define('API_KEY',$API_KC);
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
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
$get = mysqli_query($connect, "SELECT * FROM dbremove WHERE time <= ".time()."");
 while($row = $get->fetch_assoc()) {
  bot('deleteMessage',[
            'chat_id' => $row['id'],
            'message_id' => $row['message_id'],
  ]);
 $connect->query("DELETE FROM dbremove WHERE id = '{$row['id']}' and message_id = '{$row['message_id']}' LIMIT 1");
 }