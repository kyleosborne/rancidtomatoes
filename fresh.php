<!-- Kyle Osborne
Rancid Tomatoes - movie review website
-->
<?php 
	$movie = $_REQUEST["film"];
	$info = file("$movie/info.txt");
	$name = $info[0];
	$year = $info[1];
	$score = $info[2];
	$img = "https://mathlab.utsc.utoronto.ca/courses/cscb20w17/osborn75/A2/$movie/overview.png";
	$overview = file("$movie/overview.txt");
	$reviews = glob("$movie/review*.txt");
	$i = 0;
?>
<!DOCTYPE html>
<html lang="en">
	<!-- CSCB20 Assignment 2: Fresh Tomatoes Web page -->
	<head>
	<link rel="icon" type="image/gif" href="fresh.gif">
	<link rel="stylesheet" type="text/css" href="https://mathlab.utsc.utoronto.ca/courses/cscb20w17/osborn75/A2/fresh.css">
		<title> <?=$name?> - Fresh Tomatoes</title>
		<meta charset="utf-8" />
		<!-- this "base" element allows all image references below to be "relative",
		     meaning that you the image name, such as "overview.png", is appended
		     to this base URL.  NOTE however, that the same behavior will apply
		     to any other URL's below, and so those will have to be replaced with
		     absolute URL's written as "https://mathlab.../path_to_your_files".-->
		<base href="https://mathlab.utsc.utoronto.ca/courses/cscb20w17/bretsche/assignments/a2/img/"">
	</head>
	<body>
		<div class='banner'>
			<img src="banner.png" alt="Rancid Tomatoes"/>
		</div>
		<h1 class="title"><b><?=$name?>(<?=$year?>)</b></h1>	
<main>
	<div class='overview'>
		<div>
			<img class ='overimg' src="<?=$img?>" alt="general overview"/>
		</div>
		<dl>
			<?php foreach ($overview as $line){
				$data = explode(':', $line);
				$title = $data[0];
				?>
				<dt><b><?=$title?></b></dt>
				<?php 
					$info = explode(',', $data[1]);
					foreach ($info as $piece){
				?>
				<dd><?=$piece?><br></dd>
				<?php }?>
			<?php }?>
		</dl>
	</div>
<div class="rating">
	<img class = 'tomato' src="freshbig.png" alt="Fresh"/>
		<b><?=$score?></b>
</div>
<div class="reviews">
	<div class='columns'>
		<?php 
		foreach ($reviews as $file) {
		$reviewData = file_get_contents($file);
		$reviewInfo = explode(".", $reviewData);
		$review = $reviewInfo[0];
		$otherInfo = explode("\n", $reviewInfo[1]);
			if (in_array('FRESH', $otherInfo)) {
				$rating = 'fresh.gif';
			} elseif (in_array('ROTTEN', $otherInfo)) {
				$rating = 'rotten.gif';
			}
		$author = $otherInfo[1];
		$source = $otherInfo[2];
		$i += 1;
		?>
		<?php 
			if ($i < sizeof($reviews)/2):
		?>
		<div class = 'reviews1'>
		<div class="review">
		<p>
			<img src=<?=$rating?> alt="Rotten">
			<q><?=$review?></q>
		</p>

		</div>
		<p>
			<img src="critic.gif" alt="Critic">
			<?=$author?> <br>
			<?=$source?>
		</p>
		</div>
		<?php 
			elseif ($i >= sizeof($reviews)/2):
		?>
			<div class = 'reviews2'>
		<div class="review">
		<p>
			<img src=<?=$rating?> alt="Rotten">
			<q><?=$review?></q>
		</p>
		</div>
		<p>
			<img src="critic.gif" alt="Critic">
			<?=$author?> <br>
			<?=$source?>
		</p>
		</div>
		<?php endif;?>
		<?php }?>
		</div>
	</div>
</div>
<div class="end">
		<p class="page">(1-<?=sizeof($reviews)?>) of <?=sizeof($reviews)?></p>
		<div class="validator">
			<p>
      <a href="http://validator.w3.org/check?uri=referer"><img
          src="http://www.w3.org/Icons/valid-xhtml10"
          alt="Valid XHTML 1.0!" height="31" width="88" /></a>
    		</p>
		<a href="../../css_validator.php"><img src="w3c-css.png" alt="Valid CSS" /></a>
</div>
</div>
</main>
	</body>
</html>
