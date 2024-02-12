<?php


$users = file_get_contents('Database/free.txt');
$freeusers = explode("\n", $users);
//=========START END========//
if (preg_match('/^(\/start|\.cmds|!cmds)/', $text)) {
  
    $videoUrl = "https://t.me/NetfliX_Crcker"; 

    $keyboard2 = json_encode([
        'inline_keyboard' => [
           [                                 ["text" => "𝙂𝙖𝙩𝙚𝙬𝙖𝙮𝙨 ⚓", "callback_data" => "gates"],
                                         ["text" => "𝘾𝙡𝙤𝙨𝙚 🔒", "callback_data" => "price"]
                                     ],
                                     [                                     ["text" => "𝙊𝙩𝙝𝙚𝙧 𝙏𝙤𝙤𝙡𝙨 🧰", "callback_data" => "herr"],
                             ['text' => '[🜲] 𝙊𝙬𝙣𝙚𝙧', 'url' => 'https://t.me/spidey09'],

                              ['text' => ' şｐι𝔡ᵉƳ (spidey) ', 'url' => 'https://t.me/NetfliX_Crcker'],
                           ]
                    ]
                             ]);

    $caption = "𝐇𝐞𝐥𝐥𝐨, 𝐓𝐨 𝐤𝐧𝐨𝐰 𝐦𝐲 𝐜𝐨𝐦𝐦𝐚𝐧𝐝𝐬 𝐩𝐫𝐞𝐬𝐬 𝐚𝐧𝐲 𝐨𝐟 𝐭𝐡𝐞 𝐛𝐮𝐭𝐭𝐨𝐧𝐬❗ ";
    file_get_contents("https://api.telegram.org/bot$botToken/deleteMessage?chat_id=$chatId&message_id=$messageId");

    // Using sendVideo endpoint instead of sendPhoto
    file_get_contents("https://api.telegram.org/bot$botToken/sendVideo?chat_id=$chatId&video=$videoUrl&caption=" . urlencode($caption) . "&parse_mode=HTML&reply_markup=$keyboard2");
}