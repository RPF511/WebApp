<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Music Library</title>
		<meta charset="utf-8" />
		<link href="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/5/music.jpg" type="image/jpeg" rel="shortcut icon" />
		<link href="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/labResources/music.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<h1>My Music Page</h1>
		<p>
			<?php $song_count = 5678;?>
			I love music.
			I have <?php print "$song_count"?> total songs,
			which is over <?php $hour_temp = intdiv($song_count,10); print "$hour_temp";?> hours of music!
		</p>


		<div class="section">
			<h2>Billboard News</h2>
		
			<ol>
				<?php //$newspages=5;
				$max = 5;
				if(isset($_GET["newspages"])){
					$max = (int) $_GET["newspages"];
				}
				for($max;$max>0;$max--){
					$month = 11 - (5-$max);
					if($month < 10){
						$month = "0".$month;
					}
					?>
					<li><a href="https://www.billboard.com/archive/article/<?= $month?>">2019-<?= $month?></a></li>
				<?php }?>
			</ol>
		</div>

		<div class="section">
			<h2>My Favorite Artists</h2>
			<?php $artists = array();
			$artists = array("Guns N' Roses","Green Day","Blink 182","The Cranberries","Bruno Mars","Amy Winehouse","Jason Mraz"); ?>
			<ol>
			<?php foreach($artists as $artist_tmp){ 
				$replaced = str_replace(' ', '_', $artist_tmp);
				?>
				<li><a href="http://en.wikipedia.org/wiki/<?= $replaced?>"><?php print "$artist_tmp"?></a></li>
				<?php }?>
			</ol>
		</div>

		<div class="section">
			<h2>My Music and Playlists</h2>

			<ul id="musiclist">
			<?php
				$music_array = glob("lab5/musicPHP/songs/*.mp3");
				$filesize = array();
				for($index=0; $index<count($music_array); $index++){
					$filesize[$index] = intdiv(filesize($music_array[$index]),1024);
				}
				array_multisort($filesize, SORT_DESC, $music_array);
				for($index=0; $index<count($music_array); $index++){?>
				<li class="mp3item">
					<a href="<?= $music_array[$index]?>"><?= substr($music_array[$index],20)?></a>(<?= $filesize[$index]?>kb)
				</li>
				<?php }?>
				<?php 
				$playlist = glob("lab5/musicPHP/songs/*.m3u");
				array_multisort($playlist,SORT_STRING,SORT_DESC);
				foreach($playlist as $filelist){?>
				<li class="playlistitem"><?= substr($filelist,20)?>:
					<ul>
						<?php
						$inm3u = file($filelist);
						shuffle($inm3u);
						foreach($inm3u as $listsong){
							if(strpos($listsong,"#") === false){?>
								<li><?= $listsong?></li>
							<?php }?>
						<?php }?>

					</ul>
				<?php }?>
			</ul>
		</div>

		<div>
			<a href="https://validator.w3.org/check/referer">
				<img src="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/w3c-html.png" alt="Valid HTML5" />
			</a>
			<a href="https://jigsaw.w3.org/css-validator/check/referer">
				<img src="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/w3c-css.png" alt="Valid CSS" />
			</a>
		</div>
	</body>
</html>