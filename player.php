<center>
<font size="6"><font color="4afafc"><h1 style="background-color:#ff67f2">G E T &nbsp Y O U R &nbsp A E S T H E T I C S</h1></font>
<body background="watervap.jpg" bgproperties="fixed"></body>
<?php

$song_id = $_GET["songid"];
$play_dir = "songs_final/".$song_id.".mp3";
$song_name = file_get_contents("songs_id/".$song_id.".txt");
$song_exists = file_exists($play_dir);
$share_link = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

if($song_exists === true) { 
$download_name = 'songs_renamed/'.$song_name.'.mp3';
copy($play_dir, $download_name);
?>
	<audio controls><source src="<?php echo $play_dir; ?>" type="audio/mpeg"></audio>
    <p><a href="<?php echo $download_name; ?>" download><img src="download-button.png" alt="Download" style="width:145px;height:57px"></a>
    <p><a href="<?php echo $play_dir; ?>" download>If everything fucks up you can always use the fallback downloader to salvage your song ;)</a>
	<p>
<center>
<div class="a2a_kit a2a_kit_size_32 a2a_default_style">
<a class="a2a_dd" href="https://www.addtoany.com/share"></a>
<a class="a2a_button_facebook"></a>
<a class="a2a_button_twitter"></a>
<a class="a2a_button_google_plus"></a>
<a class="a2a_button_tumblr"></a>
</div>
<script>
var a2a_config = a2a_config || {};
a2a_config.linkurl = "";
</script>
<script async src="https://static.addtoany.com/menu/page.js"></script>
</center>
<?php 
}
else { ?>
<h1> :( </h1>
<h2> Oops couldn't find your song...are you sure the link is correct ? </h2>
	
    <?php }
	?>

    
    