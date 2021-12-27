<?php
error_reporting(0);
// Developer : @virtualdev
$telegram_ip_ranges = [
['lower' => '149.154.160.0', 'upper' => '149.154.175.255'], // literally 149.154.160.0/20
['lower' => '91.108.4.0',    'upper' => '91.108.7.255'],    // literally 91.108.4.0/22
];$ip_dec = (float) sprintf("%u", ip2long($_SERVER['REMOTE_ADDR']));
$ok=false;
foreach ($telegram_ip_ranges as $telegram_ip_range) if (!$ok) {  $lower_dec = (float) sprintf("%u", ip2long($telegram_ip_range['lower']));$upper_dec = (float) sprintf("%u", ip2long($telegram_ip_range['upper']));
 if ($ip_dec >= $lower_dec and $ip_dec <= $upper_dec) $ok=true;}
if (!$ok) die("Hello My Bitch :)");
//┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅
$tokens = "5075407591:AAHNmN4rX2_CYWatC-pYJKrneRFbvQQb_3Q"; // توکن ربات 
//┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅
define('API_KEY',$tokens);
function bot($method,$datas=[]){ // Bot Function
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
if(curl_error($ch)){
        var_dump(curl_error($ch));
    } else {
        return json_decode($res);
               }
}
function step($from_id,$step){
$user = json_decode(file_get_contents("data/users.json"),true);
  	$user["user"]["$from_id"]["step"]="$step";
$user = json_encode($user,128|256);
file_put_contents("data/users.json",$user);	
return true;
}
function sendaudio($chat_id, $audio, $caption){
 bot('sendaudio',[
 'chat_id'=>$chat_id,
 'audio'=>$audio,
 'caption'=>$caption,
 ]);
 }
 function sendvoice($chat_id, $voice, $caption){
 bot('sendvoice',[
 'chat_id'=>$chat_id,
 'voice'=>$voice,
 'caption'=>$caption,
 ]);
 }
 function deletefolder($path){
 if($handle=opendir($path)){
  while (false!==($file=readdir($handle))){
   if($file<>"." AND $file<>".."){
    if(is_file($path.'/'.$file)){ 
     @unlink($path.'/'.$file);
    } 
    if(is_dir($path.'/'.$file)) { 
     deletefolder($path.'/'.$file); 
     @rmdir($path.'/'.$file); 
    }
   }
        }
    }
}
function Forward($KojaShe, $AzKoja, $KodomMSG){
    bot('ForwardMessage', [
        'chat_id' => $KojaShe,
        'from_chat_id' => $AzKoja,
        'message_id' => $KodomMSG
    ]);
}
// powered by @nulltheme_org

/* ...........
جاهای مشخص شده زیر را پر کنید
.......... */
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
$message_id = $message->message_id;
$from_id = $message->from->id;
$text = $message->text;
$tc = $update->message->chat->type;
$user = json_decode(file_get_contents("data/users.json"),true);
$step = $user["user"]["$from_id"]["step"];
// آیدی عددی ادمین ها
$admins = array("1422078105","00000000");
// نام کاربری ربات شما بدون @
$bottag = "Editor_seniorbot_bot";
// آدرس محل نصب سورس ربات
$d = "https://benaymin.herokuapp.com/index.php";
	//┈┈┈┈┈┈┈┈┈┈┈┈┈┈┈┈┈┈┈┈
	$sss = json_encode([
'keyboard'=>[
         [['text'=>"گرد به معمولی 🎥"],['text'=>"🎥 معمولی به گرد"]],
         [['text'=>"صدا به ویس 🎙"],['text'=>"🎙 ویس به صدا"]],
   	   	[['text'=>"استیکر به عکس 📸"],['text'=>"📸 عکس به استیکر"]],
   	   	[['text'=>"🌷 درباره ما"],['text'=>"🔄 متن به صدا"]],
],
"resize_keyboard"=>true]);
$back_b = json_encode([
'keyboard'=>[
   	   	[['text'=>"🏠 Back | برگشت 🏠"]],
],
"resize_keyboard"=>true]);
//---
$back_pb = json_encode([
'keyboard'=>[
   	   	[['text'=>"🏠 برگشت پنل"]],
],
"resize_keyboard"=>true]);
//---
$pnel = json_encode([
'keyboard'=>[
   	[['text'=>"📬 ارسال همگانی 📬"],['text'=>"📬 فوروارد همگانی📬"]],
   	[['text'=>"🚫 بلاک کردن"],['text'=>"❕آنبلاک کردن"]],
   		[['text'=>"👥 آمار کلی ربات👥"],['text'=>"✏️ تنظیم درباره"]],
   			[['text'=>"🏠 Back | برگشت 🏠"]],
	],"resize_keyboard"=>true]);
	//---
		 if($tc != "private"){
  bot('LeaveChat',[
  'chat_id'=>$chat_id
  ]);
}
$members = file_get_contents("data/members.txt");
$memberss = explode("\n",$members);
	if(!in_array($from_id,$memberss) && $tc == "private"){
	$myfile2 = fopen("data/members.txt", "a") or die("Unable to open file!");
fwrite($myfile2, "\n$from_id");
fclose($myfile2);
	mkdir("file/$chat_id");
	}
	//---
$user_flood = file_get_contents("spam/$from_id.txt");
if($user_flood < time()){ 
$spamtime = 0.09; // تایم اسپم پشت سرهم
$tt = time() + $spamtime;
file_put_contents("spam/$from_id.txt",$tt);
//---
if(strpos($text,"'") !== false or strpos($text,'"') !== false or strpos($text,"}") !== false or strpos($text,"{") !== false or strpos($text,")'") !== false or strpos($text,"(") !== false or strpos($text,",") !== false){	
$spamtime = 2000; 
$tt = time() + $spamtime;
file_put_contents("spam/$from_id.txt",$tt);
  bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"بدلیل استفاده از کد شما به مدت 2000 ثانیه بلاک شدید❌",
 'parse_mode'=>"HTML",
  'reply_to_message_id'=>$message_id,
	 ]); 
	 bot('sendMessage',[
 'chat_id'=>$admins[0],
 'text'=>"[😊 کد داد و مسدود شد](tg://user?id=$from_id)",
 'parse_mode'=>"MarkDown",

	 ]); 
	}
		if($text == "/start" or $text == "🏠 Back | برگشت 🏠" ){
		if($tc == "private"){
		step($chat_id,"none");
 bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"👌🏻 به ربات تبدیلگر خوش آمدید .

<b>✅ توی این ربات میتونی :</b>

➕ تبدیل عکس به استیکر
➕ تبدیل استیکر به عکس
➕ تبدیل ویس به صدا
➕ تبدیل صدا به ویس
➕ تبدیل متن به صدا یا ویس
➕ و..

👑 پیشرفته ترین ربات تبدیلگر برای خدمت گزاری #رایگان برای شما آماده است.
🌹 خدمات ربات #کاملا_رایگان است.
🆔 : @$bottag
👇🏻 انتخاب کن 👇🏻",
 'reply_markup'=>$sss,
  'parse_mode'=>"HTML",
	 ]); 
	 }
	 }
	  if($text == "گرد به معمولی 🎥" && $tc == "private"){
	 step($chat_id,"getom");
	  bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"<b>لطفا ویدیو گرد را ارسال فرمایید :</b>",
 'reply_markup'=>$back_b,
  'parse_mode'=>"HTML",
	 ]); 
	 }
	 if(isset($message->video_note)){
	 if($step == "getom" && $text != "🏠 Back | برگشت 🏠" && $tc == "private"){
	if($user_flood < time()){ 
	 step($chat_id,"none");
	 	  bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"<i>در حال پردازش صبور باشید ..</i>",
  'parse_mode'=>"HTML",
	 ]); 
$file = $message->video_note->file_id;
$get = Bot('getFile',['file_id'=> $file]);
$patch = $get->result->file_path;
file_put_contents("file/$chat_id/voice.mp4",file_get_contents('https://api.telegram.org/file/bot'.$tokens.'/'.$patch));
   bot('sendVideo',[
  'chat_id'=>$chat_id,
	'video'=>new CURLFile("file/$chat_id/voice.mp4"),

	'caption'=>"➕ عملیات موفقیت آمیز بود.",
        ]);
deletefolder("file/$chat_id");
	 }
	 }
	 }
	 if($text == "🎥 معمولی به گرد" && $tc == "private"){
	 step($chat_id,"maToge");
	  bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"<b>لطفا ویدیو معمولی را ارسال فرمایید :</b>",
 'reply_markup'=>$back_b,
  'parse_mode'=>"HTML",
	 ]); 
	 }
	 if(isset($message->video)){
	 if($step == "maToge" && $text != "🏠 Back | برگشت 🏠" && $tc == "private"){
	if($user_flood < time()){ 
	 step($chat_id,"none");
	 	  bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"<i>در حال پردازش صبور باشید ..</i>",
  'parse_mode'=>"HTML",
	 ]); 
$file = $message->video->file_id;
$get = Bot('getFile',['file_id'=> $file]);
$patch = $get->result->file_path;
$pp = file_get_contents('https://api.telegram.org/file/bot'.$tokens.'/'.$patch);
file_put_contents("file/$chat_id/voice.mp4",$pp);
   bot('sendVideoNote',[
  'chat_id'=>$chat_id,
	'video_note'=>new CURLFile("file/$chat_id/voice.mp4"),

        ]);
deletefolder("file/$chat_id");
	 }else{
	 bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"❌ حجم ویدیو باید کمتر از 3 مگابایت باشد.",
  'parse_mode'=>"HTML",
	 ]); 
	 }
	 }
	 }
	 	 if($text == "🌷 درباره ما"){
	 	 $drb = file_get_contents("data/about.txt");
	 	 if($drb != null ){
	 	  bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"$drb",
  'parse_mode'=>"HTML",
	 ]); 
	 	 }else{
	 bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"<b>❌ هنوز کسی از پنل این متنو تنظیم نکرده!</b>",
  'parse_mode'=>"HTML",
	 ]); 
	 }
	 }
	 if($text == "🔄 متن به صدا"){
	 step($chat_id,"mtnToVoice");
	 bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"<b>لطفا متن را ارسال فرمایید :</b>
 
 <code>فقط می توانید متن انگلیسی ارسال کنید</code>",
 'reply_markup'=>$back_b,
  'parse_mode'=>"HTML",
	 ]); 
	 }
	if($step == "mtnToVoice" && $text != "🏠 Back | برگشت 🏠"){
	if($user_flood < time()){ 
	step($chat_id,"none");
	 bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"<i>در حال پردازش صبور باشید ..</i>",
  'parse_mode'=>"HTML",
	 ]); 
	 $voice1 = file_get_contents('http://tts.baidu.com/text2audio?lan=en&ie=UTF-8&text='.urlencode($text));
$voice2 = file_put_contents("file/$chat_id/voice.ogg",$voice1);
bot('sendvoice',[
'chat_id'=>$chat_id,
'voice'=> new CURLFile("file/$chat_id/voice.ogg"),
'caption'=>"➕ عملیات موفقیت آمیز بود."
]);
deletefolder("file/$chat_id");
}
}
	 if($text == "استیکر به عکس 📸" && $tc == "private"){
	 step($chat_id,"webptopng");
	  bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"<b>لطفا استیکر را ارسال فرمایید :</b>",
 'reply_markup'=>$back_b,
  'parse_mode'=>"HTML",
	 ]); 
	 }
	 if(isset($message->sticker)){
	 if($step == "webptopng" && $text != "🏠 Back | برگشت 🏠" && $tc == "private"){
	if($user_flood < time()){ 
	 step($chat_id,"none");
	 	  bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"<i>در حال پردازش صبور باشید ..</i>",
  'parse_mode'=>"HTML",
	 ]); 
$sticker = $message->sticker->file_id;
$get = Bot('getFile',['file_id'=> $sticker]);
$patch = $get->result->file_path;
file_put_contents("file/$chat_id/voice.png",file_get_contents('https://api.telegram.org/file/bot'.$tokens.'/'.$patch));
bot('SendPhoto',[
'chat_id'=>$chat_id,
'photo'=>new CURLFile("file/$chat_id/voice.png"),
'caption'=>"➕ عملیات موفقیت آمیز بود.",
]);
deletefolder("file/$chat_id");
	 }
	 }
	 }
	 	 if($text == "📸 عکس به استیکر" && $tc == "private"){
	 step($chat_id,"pngTowwbp");
	  bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"<b>لطفا عکس را ارسال فرمایید :</b>",
 'reply_markup'=>$back_b,
  'parse_mode'=>"HTML",
	 ]); 
	 }
	 if(isset($message->photo)){
	 if($step == "pngTowwbp" && $text != "🏠 Back | برگشت 🏠" && $tc == "private"){
	if($user_flood < time()){ 
	 step($chat_id,"none");
	 	  bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"<i>در حال پردازش صبور باشید ..</i>",
  'parse_mode'=>"HTML",
	 ]); 
$photo = $message->photo;
$file = $photo[count($photo)-1]->file_id;
$get = Bot('getFile',['file_id'=> $file]);
$patch = $get->result->file_path;
file_put_contents("file/$chat_id/voice.webp",file_get_contents('https://api.telegram.org/file/bot'.$tokens.'/'.$patch));
bot('SendSticker',[
'chat_id'=>$chat_id,
'sticker'=>new CURLFile("file/$chat_id/voice.webp"),
]);
deletefolder("file/$chat_id");
	 }
	 }
	 }
	 if($text == "🎙 ویس به صدا" && $tc == "private"){
	 step($chat_id,"VoiceTomp3");
	  bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"<b>لطفا ویس را ارسال کنید :</b>",
 'reply_markup'=>$back_b,
  'parse_mode'=>"HTML",
	 ]); 
	 }
	 if(isset($message->voice)){
	 if($step == "VoiceTomp3" && $text != "🏠 Back | برگشت 🏠" && $tc == "private"){
		if($user_flood < time()){ 
	 step($chat_id,"none");
	 	  bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"<i>در حال پردازش صبور باشید ..</i>",
  'parse_mode'=>"HTML",
	 ]); 
	 $voice = $message->voice;
$file = $voice->file_id;
$get = bot('getfile',['file_id'=>$file]);
$patch = $get->result->file_path;
file_put_contents("file/$chat_id/voice.mp3",file_get_contents('https://api.telegram.org/file/bot'.$tokens.'/'.$patch));
sendaudio($chat_id ,new CURLFile("file/$chat_id/voice.mp3"),"➕ عملیات موفقیت آمیز بود ...");
deletefolder("file/$chat_id");
	 }
	 }
	 }
	 if($text == "صدا به ویس 🎙" && $tc == "private"){
	 step($chat_id,"mp3ToVoice");
	  bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"<b>لطفا صدا را با فرمت mp3 ارسال کنید :</b>",
 'reply_markup'=>$back_b,
  'parse_mode'=>"HTML",
	 ]); 
	 }
	 if(isset($message->audio)){
	 if($step == "mp3ToVoice" && $text != "🏠 Back | برگشت 🏠" && $tc == "private"){
	if($user_flood < time()){ 
	 step($chat_id,"none");
	 	  bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"<i>در حال پردازش صبور باشید ..</i>",
  'parse_mode'=>"HTML",
	 ]); 
	 $audio = $message->audio;
$file = $audio->file_id;
$get = bot('getfile',['file_id'=>$file]);
$patch = $get->result->file_path;
file_put_contents("file/$chat_id/voice.ogg",file_get_contents('https://api.telegram.org/file/bot'.$tokens.'/'.$patch));
sendvoice($chat_id ,new CURLFile("file/$chat_id/voice.ogg"),"➕ عملیات موفقیت آمیز بود ...");
deletefolder("file/$chat_id");
	 }
	 }
	 }
	 }
	 if($text == "/panel" or $text == "پنل" or $text == "🏠 برگشت پنل"){
	 step($chat_id,"none");
	 if(in_array($from_id,$admins)){
	 	 bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"✅ شما ادمین شناخته شدید !
 ┈┈┈┈┅┅┅━┅┅┅┈┈┈┈
 ❇️ Your id : `$chat_id`
┈┈┈┈┅┅┅━┅┅┅┈┈┈┈
 💎 پنل مدیریتی هم اکنون باز شد !",
   'reply_to_message_id'=>$message_id,
   'parse_mode'=>'MarkDown',
 'reply_markup'=>$pnel
	 ]); 
	 }else{
	 bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"❌ شما ادمین ربات نیستید !",
	 ]); 
	 }
	 }
	   if($text == "❕آنبلاک کردن"){
if(in_array($from_id,$admins)){
step($chat_id,"unblackuser");
	 	 bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>" ✓ آیدی عددی شخص را ارسال کنید :",
 'reply_markup'=>$back_pb
	 ]); 
	 }
	 }
	 if($step == "unblackuser" and $text != "🏠 برگشت پنل"){
	step($chat_id,"none");
	$tt = time();
file_put_contents("spam/$text.txt",$tt);
	  bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"✅ کاربر $text دیگر بلاک نیست.",
 'reply_markup'=>$back_pb
	 ]); 
	  bot('sendMessage',[
 'chat_id'=>$text,
 'text'=>"✅ مدیریت شمارا از بلاکی در آورد.",
	 ]); 
	 }
	   if($text == "🚫 بلاک کردن"){
if(in_array($from_id,$admins)){
step($chat_id,"blackuser");
	 	 bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>" ⇚ این بلاکی ، بلاک کردن زمان دار است.

 ✓ آیدی عددی شخص را ارسال کنید :",
 'reply_markup'=>$back_pb
	 ]); 
	 }
	 }
	 if($step == "blackuser" and $text != "🏠 برگشت پنل"){
	file_put_contents("data/user.txt",$text);
	step($chat_id,"blackuser2");
	  bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"✏️ لطفا زمان بلاک را به ثانیه بفرستید :
 
 ✓ بصورت لاتین مثال : 100",
 'reply_markup'=>$back_pb
	 ]); 
	 }
	 	 if($step == "blackuser2" and $text != "🏠 برگشت پنل"){
$user =	file_get_contents("data/user.txt");
	step($chat_id,"none");
$tt = time() + $text;
file_put_contents("spam/$user.txt",$tt);
	  bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"✅ با موفقیت $text ثانیه بلاک شد.",
 'reply_markup'=>$back_pb
	 ]); 
	 bot('sendMessage',[
 'chat_id'=>$user,
 'text'=>"👤 مدیریت شمارا تا $text ثانیه دیگر بلاک کرد.",
	 ]); 
	 }
	  if($text == "✏️ تنظیم درباره"){
if(in_array($from_id,$admins)){
step($chat_id,"setAbout");
	 	 bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"✏️ لطفا متن درباره ما را ارسال کنید :
 ➖➖➖➖➖
 <code>کد کردن متن</code>
 <b>درشت کردن متن</b>
 <i>کج کردن متن</i>
 ",
 'reply_markup'=>$back_pb
	 ]); 
	 }
	 }
	 if($step == "setAbout" and $text != "🏠 برگشت پنل"){
	file_put_contents("data/about.txt",$text);
	  bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"✅ با موفقیت تنظیم شد.",
 'reply_markup'=>$back_pb
	 ]); 
	 }
	 if($text == "👥 آمار کلی ربات👥"){ 
if(in_array($from_id,$admins)){
	 $alluser = file_get_contents("data/members.txt");
	$alaki = explode("\n",$alluser);
    $allusers = count($alaki)-1;
	 	 bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"📍 کل اعضای ربات : $allusers",
	 ]); 
	 }
	 }
	  if($text == "📬 فوروارد همگانی📬"){
if(in_array($from_id,$admins)){
step($chat_id,"forall");
	 	 bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"👈 پیام خودتان را فور کنید :",
 'reply_markup'=>$back_pb
	 ]); 
	 }
	 }
	 if($step == "forall" and $text != "🏠 برگشت پنل"){
	  bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"🔥 پیام شما با موفقیت به صف ارسال رفت !",
 'reply_markup'=>$back_pb
	 ]); 
	   $users = file_get_contents("data/members.txt");
                $ex = explode("\n",$users);
            foreach($ex as $key){
                Forward($key, $chat_id,$message_id);
                }
	 }
	 	 if($text == "📬 ارسال همگانی 📬"){
if(in_array($from_id,$admins)){
step($chat_id,"sendall");
	 	 bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"👈 پیام متنی خود را ارسال کنید :",
 'reply_markup'=>$back_pb
	 ]); 
	 }
	 }
	 if($step == "sendall" and $text != "🏠 برگشت پنل"){
	  bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"🔥 پیام شما با موفقیت به صف ارسال رفت !",
 'reply_markup'=>$back_pb
	 ]); 
	   $users = file_get_contents("data/members.txt");
                $ex = explode("\n",$users);
               foreach($ex as $key){
                 bot('sendMessage',[
 'chat_id'=>$key,
 'text'=>$text,
  ]);
                }
	 }
