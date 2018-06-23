<?
$gamma .= sha1($passw . $gamma);
function strcode($str, $passw="")
{
   $salt = "Dn8*#2n!9j";
   $len = strlen($str);
   $gamma = '';
   $n = $len>100 ? 8 : 2;
   while( strlen($gamma)<$len )
   {
      $gamma .= substr(pack('H*', sha1($passw.$gamma.$salt)), 0, $n);
   }
   return $str^$gamma;
}
function entext($str){
$txt = base64_encode(strcode($str, 'mypassword'));
return $txt;
}
function detext($str){
$txt = strcode(base64_decode($str), 'mypassword');
return $txt;
}
?>