<?php
$sexy_cookie = $_COOKIE['song_id_str'];
$notexists = empty($sexy_cookie);
if($notexists === true){
	echo "Sorry but I can't find your song :(";
}
else{
$file_id = 'E:\wamp64\www\songs_id\\'.$sexy_cookie.'.txt';
$ident = fopen($file_id, "r");
$file_alphaname = fread($ident, filesize($file_id));
$file_dir = 'E:\wamp64\www\songs_final\\'.$sexy_cookie.'.mp3';
var_dump($file_dir);
var_dump($file_alphaname);
copy($file_dir, 'E:\wamp64\www\songs_renamed\\'.$file_alphaname.'.mp3');
$file2dl = 'E:\wamp64\www\songs_renamed\\'.$file_alphaname.'.mp3';
$file = $file2dl;
var_dump($file);
if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
}
}


?>