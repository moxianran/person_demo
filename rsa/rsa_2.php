<?php
//$fp=fopen("rsa_private_key.pem","r"); //你的私钥文件路径
//$private_key=fread($fp,filesize("rsa_private_key.pem"));
//fclose($fp);
//$fp1=fopen("rsa_public_key.pem","r"); //你的公钥文件路径
//$public_key=fread($fp1,8192);
//fclose($fp1);
//echo $private_key;
//echo $public_key;

$aa = $_POST['d'];
$private_key = "-----BEGIN RSA PRIVATE KEY-----
MIICXAIBAAKBgQC/cZt1dgr7PjKyBHbodBZ1Ow765rjZC+LiNf4kWhsPx77wgcMC
EO32WOCreC0IPdFGFXhhxCcDLTMG8XLkyPM+dX5YfKSOPzJdTdmCpE9J9Bq4c28R
jtenGLj1Z00QWVZPGlMu//p9bovPYq7pnDYCSjsniwfMJH8O2H3lDovPyQIDAQAB
AoGBAKvu8fk5/H7Ly2fJTqlRqOG8GqYHFDgJzsfuScKIEgnIEJmbUHHIlo5KH+yf
T4I5UnuoyKa1LXxS2aMAsXj7aEg/UWuLuldRPrVjmni3WgXkhGKMV123V9djcaeG
F4gu+0hugUkjeZ+lBkGKDYMhZPuLe6QbhzS5luqQQXdckzZJAkEA7TKQpvzR++DB
pqpRLI/xsk1LpXqIzVFAZ5oTam5S8W/iGYeZP465Wcgliuo3sdAz9Ccoa/RBcstT
Fl2gM0z+bwJBAM6ekHYJkUHkXUxIC2tmhgc/uVWUhi/LUcG46PckQGi6k8H0ovq3
uoSooi2CQ9gugv42y0DiHQ70tHI1h99iMUcCQDES8BiMYAljo80OmcLFeTTxhwAS
jPElqVSF7RRtBN4MztOHWW5r4e8wWIwYDzPLpqQR4ewL2eqdJHCRKE7U1CMCQF7B
OxDWzGXCe8Lq20nSx651W+JSbcNnY8QKr9P/LQaaYf612TRPo9sIlu916PUwR2Sb
7lSAHcFpGYOy5u/b0SsCQCbLr7yyIHS3glm5JBNGsXHW1QdIILXCV2FOt48tf6BP
9U11scDRawHLlx/bw1c6qO3FGEoZueXqWMS/3cNku10=
-----END RSA PRIVATE KEY-----";


function privateDecrypt($data, $privateKey)
{
    openssl_private_decrypt($data, $decrypted, $privateKey);
    return $decrypted;
}


$aa = base64_decode($aa);

$return = privateDecrypt($aa,$private_key);

var_dump($return);

