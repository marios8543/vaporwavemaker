<?php
$sexy_cookie = $_COOKIE['song_id_str'];
$file2dl = 'E:\wamp64\www\songs_final\\'.$sexy_cookie.'.mp3';
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


?>