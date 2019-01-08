<html>
<body>

<?php
	$dir = '.';
	$filesarr = scandir($dir);

	foreach ($filesarr as $value) {
		// Check extension to hide other files
		$ext = pathinfo($value, PATHINFO_EXTENSION);
		if ($ext == "md") {
			$dot = strpos($value, '.');
			$text = substr($value, 0, $dot);
			echo("<a href=\"index.php?page=$value\">$text</a><br/>");
		}
	}
?>

<hr/>

<?php
	include 'Parsedown.php';

	if (isset($_GET["page"]))
	{
		// Check extension to prevent loading other files
		$ext = pathinfo($_GET["page"], PATHINFO_EXTENSION);
		if ($ext == "md") {
			$Parsedown = new Parsedown();

			$myfile = fopen($_GET["page"], "r") or die("Unable to open page");
			$content = fread($myfile, filesize($_GET["page"]));
			fclose($myfile);

			echo($Parsedown->text($content));
		}
	} else {
		echo("Hi! Please click on a link to visit.");
	}
?>

</body>
</html>
