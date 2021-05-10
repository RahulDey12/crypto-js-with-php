<?php
function getJsonPayload($payload) {
    $payload = json_decode(base64_decode($payload), true);
    
    return $payload;
}
  
  $password = '1234';
  
  // The Encrypted Value from Javascript
  $encrypion_payload = "eyJjdCI6Ijh3RlJyUEhteCtrZ1hGWHZVc3hhZEE9PSIsIml2IjoiMGY4YjU4MGUwMzBiNWVjNDkwZjIyOTIxODM1OGFhZmEiLCJzIjoiYmIxNGM0MDdmZjU0NTdhZSJ9";
  
  $payload = getJsonPayload($encrypion_payload);
  
  $salt = hex2bin($payload['s']);
  $iv = hex2bin($payload['iv']);
  $ct = base64_decode($payload['ct']);
  
  $concatedPassphrase = $password . $salt;
  $md5 = [];
  $md5[0] = md5($concatedPassphrase, true);
  $result = $md5[0];
  
  for ($i = 1; $i < 3; $i++) {
      $md5[$i] = md5($md5[$i - 1] . $concatedPassphrase, true);
      $result .= $md5[$i];
  }
  
  $key = substr($result, 0, 32);
  $data = openssl_decrypt($ct, 'aes-256-cbc', $key, true, $iv);
    