<?php
// Don't edit This File.
// Set CronJob ( 1 min ) 
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
function Takhmin($fil){
if($fil <= 200 ){
return "2";
}else{
$besanie = $fil/200;
return ceil($besanie)+1;
}
}
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
//===================================================================
$settings = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM settings WHERE botid = '$botid' LIMIT 1"));
$foall = $settings["forall"];
$sendall = $settings["sendall"];
$tedad = $settings["tedad"];
$text = $settings["text"];
$chat_id = $settings["chat_id"];
$msg_id = $settings["msg_id"];
$msg_id2 = $settings["msg_id2"];
$is_all = $settings["is_all"];
$users = mysqli_query($connect,"select id from user");
$fil = mysqli_num_rows($users);
//=====================================================
if($tedad + 0.1 > $fil ){
$connect->query("UPDATE settings SET forall = 'false' WHERE botid = '$botid' LIMIT 1");	
$connect->query("UPDATE settings SET sendall = 'false' WHERE botid = '$botid' LIMIT 1");	
$connect->query("UPDATE settings SET tedad = '0' WHERE botid = '$botid' LIMIT 1");	
$connect->query("UPDATE settings SET msg_id2 = 'no' WHERE botid = 'none' LIMIT 1");	
bot('sendMessage',[
 'chat_id'=>$admins[0],
 'text'=>"✅ عملیات همگانی پایان یافت !",
 'parse_mode'=>"HTML",
  ]);
  bot('editMessageReplyMarkup',[
    'chat_id'=>$is_all,
    'message_id'=>$msg_id2,
 'reply_markup'=> json_encode([
            'inline_keyboard'=>[
                  [['text'=>"✅ همگانی پایان یافت .",'callback_data'=>"none"]],
              ]
        ])
    		]);
    		$connect->query("UPDATE settings SET is_all = 'no' WHERE botid = '$botid' LIMIT 1");	
}
$settings = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM settings WHERE botid = '$botid' LIMIT 1"));
$foall = $settings["forall"];
if($foall == "true"){
while($row = mysqli_fetch_assoc($users)){
     $ex[] = $row["id"];
}
$kobs2 = $tedad + 200;
for($z = $tedad;$z <= $kobs2;$z++){
		   		   bot('ForwardMessage',[
		   		    'chat_id'=>$ex[$z],
		   		   	'from_chat_id'=>$chat_id,
	'message_id'=>$msg_id,
  ]);
		}    
if($fil < 200.1 ){
$connect->query("UPDATE settings SET tedad = '$fil' WHERE botid = '$botid' LIMIT 1");	
$settings1 = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM settings WHERE botid = '$botid' LIMIT 1"));
$tddd = $settings1['tedad'];
$tfrigh = $fil - $tddd;
$min = Takhmin($tfrigh);
bot('editMessageReplyMarkup',[
    'chat_id'=>$is_all,
    'message_id'=>$msg_id2,
 'reply_markup'=> json_encode([
            'inline_keyboard'=>[
                  [['text'=>"🔹 تعداد افراد ارسال شده : $tddd",'callback_data'=>"none"]],
                  [['text'=>"🚀 زمان تخمینی ارسال : $min دقیقه (باقیمانده)",'callback_data'=>"none"]],
              ]
        ])
    		]);
}else{
if($kobs2 > $fil ){
$connect->query("UPDATE settings SET tedad = '$kobs2' WHERE botid = '$botid' LIMIT 1");	
$settings1 = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM settings WHERE botid = '$botid' LIMIT 1"));
$tddd = $settings1['tedad'];
$tfrigh = $fil - $tddd;
$min = Takhmin($tfrigh);
bot('editMessageReplyMarkup',[
    'chat_id'=>$is_all,
    'message_id'=>$msg_id2,
 'reply_markup'=> json_encode([
            'inline_keyboard'=>[
                  [['text'=>"🔹 تعداد افراد ارسال شده : $tddd",'callback_data'=>"none"]],
                  [['text'=>"🚀 زمان تخمینی ارسال : $min دقیقه (باقیمانده)",'callback_data'=>"none"]],
              ]
        ])
    		]);
}else{
$connect->query("UPDATE settings SET tedad = '$kobs2' WHERE botid = '$botid' LIMIT 1");	
$settings1 = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM settings WHERE botid = '$botid' LIMIT 1"));
$tddd = $settings1['tedad'];
$tfrigh = $fil - $tddd;
$min = Takhmin($tfrigh);
bot('editMessageReplyMarkup',[
    'chat_id'=>$is_all,
    'message_id'=>$msg_id2,
 'reply_markup'=> json_encode([
            'inline_keyboard'=>[
                  [['text'=>"🔹 تعداد افراد ارسال شده : $tddd",'callback_data'=>"none"]],
                  [['text'=>"🚀 زمان تخمینی ارسال : $min دقیقه (باقیمانده)",'callback_data'=>"none"]],
              ]
        ])
    		]);
}
}
}
$settings = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM settings WHERE botid = '$botid' LIMIT 1"));
$sendall = $settings["sendall"];
if($sendall == "true"){
while($row = mysqli_fetch_assoc($users)){
     $ex[] = $row["id"];
}
$kobs2 = $tedad + 200;
for($z = $tedad;$z <= $kobs2;$z++){
		   bot('sendMessage',[
 'chat_id'=>$ex[$z],
 'text'=>$text,
 'parse_mode'=>"HTML",
   'disable_web_page_preview'=>true,
  ]);
		}    
if($fil < 200.1 ){
$connect->query("UPDATE settings SET tedad = '$fil' WHERE botid = '$botid' LIMIT 1");	
$settings1 = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM settings WHERE botid = '$botid' LIMIT 1"));
$tddd = $settings1['tedad'];
$tfrigh = $fil - $tddd;
$min = Takhmin($tfrigh);
bot('editMessageReplyMarkup',[
    'chat_id'=>$is_all,
    'message_id'=>$msg_id2,
 'reply_markup'=> json_encode([
            'inline_keyboard'=>[
                  [['text'=>"🔹 تعداد افراد ارسال شده : $tddd",'callback_data'=>"none"]],
                  [['text'=>"🚀 زمان تخمینی ارسال : $min دقیقه (باقیمانده)",'callback_data'=>"none"]],
              ]
        ])
    		]);
}else{
if($kobs2 > $fil ){
$connect->query("UPDATE settings SET tedad = '$kobs2' WHERE botid = '$botid' LIMIT 1");	
$settings1 = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM settings WHERE botid = '$botid' LIMIT 1"));
$tddd = $settings1['tedad'];
$tfrigh = $fil - $tddd;
$min = Takhmin($tfrigh);
bot('editMessageReplyMarkup',[
    'chat_id'=>$is_all,
    'message_id'=>$msg_id2,
 'reply_markup'=> json_encode([
            'inline_keyboard'=>[
                  [['text'=>"🔹 تعداد افراد ارسال شده : $tddd",'callback_data'=>"none"]],
                  [['text'=>"🚀 زمان تخمینی ارسال : $min دقیقه (باقیمانده)",'callback_data'=>"none"]],
              ]
        ])
    		]);
}else{
$connect->query("UPDATE settings SET tedad = '$kobs2' WHERE botid = '$botid' LIMIT 1");	
$settings1 = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM settings WHERE botid = '$botid' LIMIT 1"));
$tddd = $settings1['tedad'];
$tfrigh = $fil - $tddd;
$min = Takhmin($tfrigh);
bot('editMessageReplyMarkup',[
    'chat_id'=>$is_all,
    'message_id'=>$msg_id2,
 'reply_markup'=> json_encode([
            'inline_keyboard'=>[
                  [['text'=>"🔹 تعداد افراد ارسال شده : $tddd",'callback_data'=>"none"]],
                  [['text'=>"🚀 زمان تخمینی ارسال : $min دقیقه (باقیمانده)",'callback_data'=>"none"]],
              ]
        ])
    		]);
}
}
}
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
?>