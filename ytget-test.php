<?php
//Handy dandy little function from stack overfow that gets the page title to use as a song name
function get_title($url){
$str = file_get_contents($url);
  if(strlen($str)>0){
    $str = trim(preg_replace("/\s+/", " ", $str)); 
    preg_match("/\<title\>(.*)\<\/title\>/i",$str,$title);
    return $title[1];
	}
}
$link = $_POST["link"];
$yt_add = "youtu";
$valid_link = strpos($link, $yt_add);
var_dump($link);
var_dump($valid_link);
//Generates the song id
$song_id = "";
        for ($i = 0; $i<10; $i++) 
        {
        $song_id .= mt_rand(0,9);
        }
var_dump($song_id);
if($valid_link === false){
echo "Error invalid link";
}
else{
	//Downloads the song with youtube-dl
	$tmp1 = exec("youtube-dl.exe --no-playlist --extract-audio --audio-format mp3"." ".$link." -o E:\wamp64\www\songs\\".$song_id.".%(ext)s");
    var_dump($tmp1);
	//Checks if the download was successfull
	$dl_exist_name = "E:\wamp64\www\songs\\".$song_id.".mp3";
	$dl_succ = file_exists($dl_exist_name);
if($dl_succ === true){	
    //If so procceeds to proccess the song
	$tmp2 = exec("sox.exe"." "."E:\wamp64\www\songs\\".$song_id.".mp3"." "."E:\wamp64\www\songs_final\\".$song_id.".mp3"." "."speed 0.8 reverb 80 50 100 100 0 0" );
	var_dump($tmp2);
	//Actually gets the page title and sets it as songname
	$file_page = get_title($link);
	$file_name_quot = str_replace(" - YouTube","",$file_page);
	//Sets the songid as cookie (Deprecated but still used by the fallback downloader soo not removing it
setcookie("song_id_str", $song_id);
//Other crap im too lazy to document you can probably understand it
$file_name = str_replace('&quot', "", $file_name_quot);
//makes a text file with the song name (Again deprecated but used by the fallback player so not removing)
file_put_contents("songs_id/".$song_id.".txt", $file_name);
$songexist_name = "E:\wamp64\www\songs_final\\".$song_id.".mp3";
$song_exists = file_exists($songexist_name);
var_dump($file_name);
var_dump($songexist_name);
var_dump($song_exists);
if($song_exists === true){
	//Makes an html page that contains an html5 player as well as download button (?) for the specific song. will incorporate sharing functionality in the future
$playpage_template = file_get_contents("players\\playpage_template.html");	
$playpage = str_replace('SSONGIDD', $song_id, $playpage_template);
file_put_contents("players\\".$song_id.'.html', $playpage);
			//The pinnacle of pajeet coding. Will fix some other time. Was supposed to give cross-vps support (?) but why the fuck even...
			$redir_link = '\players\\'.$song_id.'.html';
			header("Location:".' '.$redir_link);
}
else{
	//If shit goes wrong it sends ya to the error page where u can use the fallback downloader to (hopefully) get the song
    header("Location:/error.html");
}
  }
  else{
	  //This...
	  echo 'Error, the link you provided could not be processed. Make sure the video is not too large and the link is correct';
}     
}

?>