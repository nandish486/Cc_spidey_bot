<?php

$botToken = "5739203932:AAFN0FeKHhZN6-anwCH2ZMumAl_x0K3NP-c";
$website = "https://api.telegram.org/bot".$botToken;
$update = file_get_contents('php://input');
//echo $update;
$update = json_decode($update, TRUE);
//global $website;
$e = print_r($update);
$update["message"]["chat"]["title"]; 
$newusername     = $update["message"]["new_chat_member"]["username"];
$newgId          = $update["message"]["new_chat_member"]["id"];
$newfirstname    = $update["message"]["new_chat_member"]["first_name"];
$new_chat_member = $update["message"]["new_chat_member"];
$message         = $update["message"]["text"];
$message_id      = $update["message"]["message_id"];
$chatId          = $update["message"]["chat"]["id"];
$username2       = $update["message"]["from"]["username"];
$firstname       = $update["message"]["from"]["first_name"];
$cdata2          = $update["callback_query"]["data"];
$cchatid2        = $update["callback_query"]["message"]["chat"]["id"]; 
$username2       = $update["callback_query"]["from"]["username"];
$firstname2      = $update["callback_query"]["from"]["first_name"];
$userId2         = $update["callback_query"]["from"]["id"];
$cmessage_id2    = $update["callback_query"]["message"]["message_id"]; 
$username3       = ('@'.$username);
// $username3       = '@'.$username2;
 $info            = json_encode($update, JSON_PRETTY_PRINT); 
$emojid = '❌';
$emojil = '✅';
$owner = '<code>@spidey09</code>';
$botu = "𝐁𝐨𝐭 𝐔𝐩𝐝𝐚𝐭𝐞𝐬 ↯ @spidey09";
$cofuid = '1212';
$cofuid2 = '1212';
$cofuid3 = '1212';
#FIN DE LA CAPTURA

$update = json_decode(file_get_contents("php://input"));

$chat_id = $update->message->chat->id;

$userId = $update->message->from->id;

$userIdd = $update->message->reply_to_message->from->id;

$firstnamee = $update->message->reply_to_message->from->first_name;

$firstname = $update->message->from->first_name;

$lastname = $update->message->from->last_name;

$username = $update->message->from->username;

$chattype = $update->message->chat->type;

$replytomessageis = $update->message->reply_to_message->text;

$replytomessagei = $update->message->reply_to_message->from->id;

$replytomessageiss = $update->message->reply_to_message;

$data = $update->callback_query->data;

$callbackfname = $update->callback_query->from->first_name;

$callbacklname = $update->callback_query->from->last_name;

$callbackusername = $update->callback_query->from->username;

$callbackchatid = $update->callback_query->message->chat->id;

$callbackuserid = $update->callback_query->message->reply_to_message->from->id;

$callbackmessageid = $update->callback_query->message->message_id;

$callbackfrom = $update->callback_query->from->id;

$callbackmessage = $update->callback_query->message->text;

$callbackid = $update->callback_query->id;

$text = $update->message->text;
$owner = '<code>@spidey09</code>';




//=======inline keyboard========//
$keyboard = json_encode([
    'inline_keyboard' => [
        [
            ['text' => " Owner ", 'url' => "/cmds"],
        ],
    ]
]);

//=======Inline Keyboard for "BACK" button========//

if ($cdata2 == "back") {
    // Go back to the welcome page
    $gatesText = "";

    $gatesText = "";

    $gatesKeyboard = json_encode([
        'inline_keyboard' => [
            [['text' => '𝐀𝐮𝐭𝐡 🌝 ', 'callback_data' => 'premium'], ['text' => '𝐆𝐚𝐭𝐞𝐰𝐚𝐲 𝐌𝐚𝐬𝐬 👾', 'callback_data' => 'free']],
            [['text' => '𝙃𝙤𝙢𝙚 🏡', 'callback_data' => 'back2']]
        ]
    ]);
    $videoUrl = "https://t.me/NetfliX_Crcker";

    $inputMediaVideo = json_encode([
        'type' => 'video',
        'media' => $videoUrl,
        'caption' => $gatesText,
        'parse_mode' => 'HTML'
    ]);

    file_get_contents("https://api.telegram.org/bot$botToken/editMessageMedia?chat_id=$cchatid2&message_id=$cmessage_id2&media=" . urlencode($inputMediaVideo) . "&reply_markup=" . urlencode($gatesKeyboard));
}

//============GATES START===========//

if ($cdata2 == "gates") {
    $gatesText = "";

  
    $gatesKeyboard = json_encode([
        'inline_keyboard' => [
            [['text' => '𝐀𝐮𝐭𝐡 🌝 ', 'callback_data' => 'premium'], ['text' => '𝐆𝐚𝐭𝐞𝐰𝐚𝐲 𝐌𝐚𝐬𝐬 👾', 'callback_data' => 'free']],
            [['text' => '𝙃𝙤𝙢𝙚 🏡', 'callback_data' => 'back2']]
        ]
    ]);

    $videoUrl = "https://t.me/NetfliX_Crcker";

    $inputMediaVideo = json_encode([
        'type' => 'video',
        'media' => $videoUrl,
        'caption' => $gatesText,
        'parse_mode' => 'HTML'
    ]);

    file_get_contents("https://api.telegram.org/bot$botToken/editMessageMedia?chat_id=$cchatid2&message_id=$cmessage_id2&media=" . urlencode($inputMediaVideo) . "&reply_markup=" . urlencode($gatesKeyboard));
}





//=========Back===========//

$premiumButton = json_encode([
    'inline_keyboard' => [
        [
            ['text' => '𝐀𝐮𝐭𝐡 🌝 ', 'callback_data' => 'premium'],
                             ['text' => '𝙃𝙤𝙢𝙚 🏡', 'callback_data' => 'back2'],
            ['text' => '<', 'callback_data' => 'back']
        ]
    ]
]);

if ($cdata2 == "free") {
    $freeText = "
<b>火 𝐆𝐚𝐭𝐞𝐰𝐚𝐲 𝐌𝐚𝐬𝐬 火</b>

- - - - - - - - - - - - - - - - - - -
<b>× GATEWAY - AUTH MASS</b>
<b>× USAGE - <code>/mchk cc|mm|yy|cvv</code></b>
<b>× RANK - <code> SPECIAL GRADE LIMITE 25</code></b>
<b>× STATUS - <code>OFF 🚫</code></b>
- - - - - - - - - - - - - - - - - - -
<b>× GATEWAY -BRAINTRE MASS </b>
<b>× USAGE - <code>/mck cc|mm|yy|cvv</code></b>
<b>× RANK - <code>SPECIAL GRADE LIMITE 25</code></b>
<b>× STATUS - <code>OFF 🚫</code></b>
- - - - - - - - - - - - - - - - - - -
<b>× GATEWAY -PAYPAL MASS </b>
<b>× USAGE - <code>/mau cc|mm|yy|cvv</code></b>
<b>× RANK - <code>SPECIAL GRADE LIMITE 5</code></b>
<b>× STATUS - <code>ON ✅</code></b>
- - - - - - - - - - - - - - - - - - -
<b>× GATEWAY -SHOPIFY MASS </b>
<b>× USAGE - <code>/mccn cc|mm|yy|cvv</code></b>
<b>× RANK - <code>SPECIAL GRADE LIMITE 25</code></b>
<b>× STATUS - <code>ON ✅</code></b>
- - - - - - - - - - - - - - - - - - -
";

    // Replace this with your video URL
    $videoUrl = "https://t.me/NetfliX_Crcker";

    $inputMediaVideo = json_encode([
        'type' => 'video',
        'media' => $videoUrl,
        'caption' => $freeText,
        'parse_mode' => 'HTML'
    ]);

    file_get_contents("https://api.telegram.org/bot$botToken/editMessageMedia?chat_id=$cchatid2&message_id=$cmessage_id2&media=" . urlencode($inputMediaVideo) . "&reply_markup=" . urlencode($premiumButton));
}


//========Premium and free=======//
$freeButton = json_encode([
    'inline_keyboard' => [
        [
            ['text' => '𝐆𝐚𝐭𝐞𝐰𝐚𝐲 𝐌𝐚𝐬𝐬 👾', 'callback_data' => 'free'],
                          ['text' => '𝙃𝙤𝙢𝙚 🏡', 'callback_data' => 'back2'],
            ['text' => ' < ', 'callback_data' => 'back']
        ]
    ]
]);

if ($cdata2 == "premium") {
   $premiumText = "火 𝘼𝙐𝙏𝙃 𝙂𝘼𝙏𝙀𝙒𝘼𝙔'𝙎 火

- - - - - - - - - - - - - - - - - - -
<b>× GATEWAY - BRAINTREE 3D LookUp</b>
<b>× USAGE - <code>/vbv cc|mm|yy|cvv</code></b>
<b>× RANK - <code>SPECIAL GRADE</code></b>
<b>× STATUS - <code>ON ✅</code></b>
- - - - - - - - - - - - - - - - - - -
<b>× GATEWAY - BRAINTREE AUTH [V1]</b>
<b>× USAGE - <code>/brr cc|mm|yy|cvv</code></b>
<b>× RANK - <code>SPECIAL GRADE</code></b>
<b>× STATUS - <code>ON ✅</code></b>
- - - - - - - - - - - - - - - - - - -
<b>× GATEWAY - SHOPIFY+SPREEDLY [6$]</b>
<b>× USAGE - <code>/sd cc|mm|yy|cvv</code></b>
<b>× RANK - <code>SPECIAL GRADE</code></b>
<b>× STATUS - <code>ON ✅️</code></b>
- - - - - - - - - - - - - - - - - - -
<b>× GATEWAY - STRIPE AUTH</b>
<b>× USAGE - <code>/ss cc|mm|yy|cvv</code></b>
<b>× RANK - <code>SPECIAL GRADE</code></b>
<b>× STATUS - <code>ON ✅</code></b>
- - - - - - - - - - - - - - - - - - -
<b>× GATEWAY - PAYPAL CHARGED [1$]</b>
<b>× USAGE - <code>/pp |mm|yy|cvv</code></b>
<b>× RANK - <code>SPECIAL GRADE</code></b>
<b>× STATUS - <code>ON ✅</code></b>
- - - - - - - - - - - - - - - - - - -";

    // Replace this with your video URL
    $videoUrl = "https://t.me/NetfliX_Crcker";

    $inputMediaVideo = json_encode([
        'type' => 'video', 
        'media' => $videoUrl,
        'caption' => $premiumText,
        'parse_mode' => 'HTML'
    ]);

    file_get_contents("https://api.telegram.org/bot$botToken/editMessageMedia?chat_id=$cchatid2&message_id=$cmessage_id2&media=" . urlencode($inputMediaVideo) . "&reply_markup=" . urlencode($freeButton));
}


//=======Premium and free end=====//


//==============TOOLS===============//
$toolKeyboard = json_encode([
    'inline_keyboard' => [
        [['text' => "𝗚𝗔𝗧𝗘𝗦", 'callback_data' => 'gates'], ['text' => "<", 'callback_data' => 'back2']]
    ]
]);



if ($cdata2 == "herr") {

  $toolcmds = "<b>火 TOOL KIT 火</b>

- - - - - - - - - - - - - - - - - - -
<b>× USER INFO - <code>/id</code>
× USAGE - <code>/id</code>
× STATUS - <code>ON ✅</code>
- - - - - - - - - - - - - - - - - - -
× IP LOOKUP - <code>/ip</code>
× USAGE - <code>/ip 1.1.1.1</code>
× STATUS - <code>ON ✅</code>
- - - - - - - - - - - - - - - - - - -
× BIN LOOKUP - <code>/bin</code>
× USAGE - <code>/bin 509786</code>
× STATUS - <code>ON ✅</code>
- - - - - - - - - - - - - - - - - - -
× CC GENERATE- <code>/gen</code>
× USAGE - <code>/gen 509786XXX|XX|XX|XXX</code>
× STATUS - <code>ON ✅</code>
- - - - - - - - - - - - - - - - - - -
× CREADIT'S CHECK- <code>/credits</code>
× USAGE - <code>/credits check</code>
× STATUS - <code>ON ✅</code>
- - - - - - - - - - - - - - - - - - -
× FAKE ADDRESS - <code>/fake</code>
× USAGE - <code>/fake us</code>
× STATUS - <code>ON ✅</code>
- - - - - - - - - - - - - - - - - - -
× SK CHECKER - <code>/sk</code>
× USAGE - <code>/sk sk_live</code>
× STATUS - <code>ON ✅</code>
- - - - - - - - - - - - - - - - - - -</b>";
  
    // Change this to your video URL
    $videoUrl = "https://t.me/NetfliX_Crcker";

    $inputMediaVideo = json_encode([
        'type' => 'video',
        'media' => $videoUrl,
        'caption' => $toolcmds,
        'parse_mode' => 'HTML'
    ]);

    file_get_contents("https://api.telegram.org/bot$botToken/editMessageMedia?chat_id=$cchatid2&message_id=$cmessage_id2&media=" . urlencode($inputMediaVideo) . "&reply_markup=" . urlencode($toolKeyboard));
}



//=============TOOLS END============//

//=============PRICE===============//
if ($cdata2 == "price") {
    $priceText = "
  ";

    $priceKeyboard = json_encode([
        'inline_keyboard' => [
            [['text' => ' 𝙃𝙤𝙢𝙚 🏡 ', 'callback_data' => 'back2'], ['text' => '[🜲] 𝙊𝙬𝙣𝙚𝙧', 'url' => 'https://t.me/spidey09']]
        ]
    ]);

    // Change this to your video URL
    $videoUrl = "https://t.me/NetfliX_Crcker";

    $inputMediaVideo = json_encode([
        'type' => 'video',
        'media' => $videoUrl,
        'caption' => $priceText,
        'parse_mode' => 'HTML'
    ]);

    file_get_contents("https://api.telegram.org/bot$botToken/editMessageMedia?chat_id=$cchatid2&message_id=$cmessage_id2&media=" . urlencode($inputMediaVideo) . "&reply_markup=" . urlencode($priceKeyboard));
}



//=============PRICE END============//

if ($cdata2 == "finalize") {
    if ($callbackfrom != $callbackuserid) {

    bot('answerCallbackQuery', [
      'callback_query_id' => $callbackid,
      'text' => "spidey09",
      "show_alert" => true
    ]);

  } else {
file_get_contents("https://api.telegram.org/bot$botToken/deleteMessage?chat_id=$cchatid2&message_id=$cmessage_id2");
}
}





//========finalize end=========//
$channel = json_encode([
    'inline_keyboard' => [
        [['text' => "🌧 Owner 🌧 ", 'url' => "https://t.me/spidey09"], ['text' => "💥 𝗖𝗵𝗮𝗻𝗻𝗲𝗹 💥", 'url' => "https://t.me/NetfliX_Crcker"]],
        [['text' => " 𝗕𝗔𝗖𝗞  ", 'callback_data' => 'back2']]
    ]
]);

if ($cdata2 == "channel") {
    $channelText = "<b>𝑱𝒐𝒊𝒏 𝒐𝒖𝒓 𝑶𝒇𝒇𝒊𝒄𝒊𝒂𝒍 𝑮𝒓𝒐𝒖𝒑 𝒂𝒏𝒅 𝑪𝒉𝒂𝒏𝒏𝒆𝒍 🥰</b>";
    
    // Change this to your video URL
    $videoUrl = "https://t.me/NetfliX_Crcker";

    $inputMediaVideo = json_encode([
        'type' => 'video',
        'media' => $videoUrl,
        'caption' => $channelText,
        'parse_mode' => 'HTML'
    ]);

file_get_contents("https://api.telegram.org/bot$botToken/editMessageMedia?chat_id=$cchatid2&message_id=$cmessage_id2&media=" . urlencode($inputMediaVideo) . "&reply_markup=" . urlencode($channel));
}



//==========back and close========//
if ($cdata2 == "back2") {
    $backtxt = ("  
");
    
    // Change this to your video url
    $backVideoUrl = "https://t.me/NetfliX_Crcker"; 

    $keyboard2 = json_encode([
        'inline_keyboard' => [
                              [                                 ["text" => "𝙂𝙖𝙩𝙚𝙬𝙖𝙮𝙨 ⚓", "callback_data" => "gates"],
                                                            ["text" => "𝘾𝙡𝙤𝙨𝙚 🔒", "callback_data" => "price"]
                                                        ],
                                                        [                                     ["text" => "𝙊𝙩𝙝𝙚𝙧 𝙏𝙤𝙤𝙡𝙨 🧰", "callback_data" => "herr"],
                             ['text' => '[🜲] 𝙊𝙬𝙣𝙚𝙧 ', 'url' => 'https://t.me/wowfox9'],
                             ['text' => ' şｐι𝔡ᵉƳ (𝗚𝗨𝗜𝗔)', 'url' => 'https://t.me/NetfliX_Crcker']
                                              ],
                                       ]
                                                ]);


    $mediaArray = json_encode([
        'type' => 'video',
        'media' => $backVideoUrl,
        'caption' => $backtxt,
        'parse_mode' => 'HTML'
    ]);

    file_get_contents("https://api.telegram.org/bot$botToken/editMessageMedia?chat_id=$cchatid2&message_id=$cmessage_id2&media=" . urlencode($mediaArray) . "&reply_markup=$keyboard2");
}


//========back and close end=======//

//=========functions started=========//

///=====Function Sendphoto======//
function sendPhotox($chatId, $photo, $caption, $keyboard = null) {
    global $website;
    $url = $website."/sendPhoto?chat_id=".$chatId."&photo=".$photo."&caption=".$caption."&parse_mode=HTML";
    
    if ($keyboard != null) {
        $url .= "&reply_markup=".$keyboard;
    }

    return file_get_contents($url);
}

///======function sendVideo========///
function sendVideox($chatId, $videoURL, $caption, $keyboard) {
    global $botToken;
    $url = "https://api.telegram.org/bot$botToken/sendVideo?chat_id=$chatId&video=$videoURL&caption=" . urlencode($caption) . "&parse_mode=HTML&reply_markup=$keyboard";
    file_get_contents($url);
}



function reply_tox($chatId,$message_id,$keyboard,$message) {
    global $website;
    $url = $website."/sendMessage?chat_id=".$chatId."&text=".$message."&reply_to_message_id=".$message_id."&parse_mode=HTML&reply_markup=".$keyboard."";
    return file_get_contents($url);
}

function deleteM($chatId,$message_id){
    global $website;
    $url = $website."/deleteMessage?chat_id=".$chatId."&message_id=".$message_id."";
    file_get_contents($url);
}


function edit_message($chatId,$message,$message_id_1) {
  sendChatAction($chatId,"type");
   $url = $GLOBALS['website']."/editMessageText?chat_id=".$chatId."&text=".$message."&message_id=".$message_id."&parse_mode=HTML&disable_web_page_preview=True";
	file_get_contents($url);
}


function multiexplode($delimiters, $string)
{
  $one = str_replace($delimiters, $delimiters[0], $string);
  $two = explode($delimiters[0], $one);
  return $two;
}



function sendMessage ($chatId, $message, $messageId){
  sendChatAction($chatId,"type");
$url = $GLOBALS['website']."/sendMessage?chat_id=".$chatId."&text=".$message."&parse_mode=html&disable_web_page_preview=True";
file_get_contents($url);
  
};
function delMessage ($chatId, $messageId){
$url = $GLOBALS['website']."/deleteMessage?chat_id=".$chatId."&message_id=".$messageId."";
file_get_contents($url);
};

function sendChatAction($chatId, $action)
{
  
$data = array("type" => "typing", "photo" => "upload_photo", "rcvideo" => "record_video", "video" => "upload_video", "rcvoice" => "record_voice", "voice" => "upload_voice", "doc" => "upload_document", "location" => "find_location", "rcvideonote" => "record_video_note", "uvideonote" => "upload_video_note");
$actiontype = $data["$action"];
$url = $GLOBALS['website']."/sendChatAction?chat_id=".$chatId."&action=".$actiontype."&parse_mode=HTML";
file_get_contents($url);
  
}

function answerCallbackQuery($data) {
    global $botToken; // Use the global bot token

    $url = "https://api.telegram.org/bot$botToken/answerCallbackQuery";

    $options = [
        'http' => [
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        ]
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

}

function bot($method, $datas = [])
{
    global $botToken;
    $url = "https://api.telegram.org/bot" . $botToken . "/" . $method;

    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($datas),
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
    ]);

    $response = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);

    if ($error) {
        // Manejar el error de cURL
        return false;
    } else {
        // Decodificar la respuesta
        $result = json_decode($response, true);

        if ($result['ok']) {
            // La solicitud fue exitosa
            return $result['result'];
        } else {
            // Manejar el error de la API de Telegram
            return false;
        }
    }
}

//=========Functions end===========//


foreach (glob("tools/*.php") as $filename)
{
    include $filename;
} 

foreach (glob("function/*.php") as $filename)
{
    include $filename;
} 

foreach (glob("gates/*.php") as $filename)
{
    include $filename;
} 

foreach (glob("admin/*.php") as $filename)
{
    include $filename;
} 



//==========foreach end============//



?>