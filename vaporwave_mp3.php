<?php

function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
$conn = mysqli_connect("localhost","root","","vaporwavemaker");
$max_size = 15728640;
$allowed_exts = ['mp3','wav','wma','flac'];
$song_id = 0;
for ($i = 0; $i<10; $i++)
        {
        $song_id .= mt_rand(0,9);
        }
if(isset($_FILES['song'])){
	$song_name = $_FILES['song']['name'];
	$song_type = $_FILES['song']['type'];
	$song_size = $_FILES['song']['size'];
	$song_tmp = $_FILES['song']['tmp_name'];
	$song_error = $_FILES['song']['error'];
	$song_ext = explode('/',$song_type);
	$song_ext = end($song_ext);
  $user_ip = get_client_ip();
	if(in_array($song_ext,$allowed_exts) && $song_size<=$max_size){
    if($conn->query("INSERT INTO songs(song_id,song_name,size,type,user_ip) values('$song_id','$song_name','$song_size','$song_type','$user_ip')")){
      move_uploaded_file($song_tmp,"C:\\wamp64\\tmp\\$song_id.$song_ext");
      $tmp = exec("sox C:\\wamp64\\tmp\\$song_id.$song_ext C:\\wamp64\\www\Songs\\$song_id.mp3 speed 0.8 reverb 80 50 100 100 0 0");
      header("Location:/player.php?song=$song_id");
    }
    echo '<center><h1>Something went wrong. Please try again or come back later...</h1></center>';
}
echo "<center><h1> The format of your song isn't supported or it's too large. Make sure it's an mp3,wav or wma file no larger than 15MB </center></h1>";
}
echo $conn->error;
 ?>
