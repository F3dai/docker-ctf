<?php

// Error reporting enabled to give attacker understanding
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// assert_options(ASSERT_BAIL, 1);

$directory = "words/";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['show'])) {
                $show = base64_decode($_POST['show']);
                assert("strpos('$show', '..') === false") or die("<p>uh oh :(<p>");
                if (!is_file($directory . $show)) {
                        echo "<p>This doesn't exist in the temple</p>";
                } else {
                        $file =  $directory . $show;
                        $lines = file($file, FILE_IGNORE_NEW_LINES);
                        $wc = count(file($file));
                        for ($x = 0; $x < 20; $x++) {
                                echo $lines[rand(0, $wc-1)] . " ";
                        }

                }
        }
}

?>

<!DOCTYPE html>
<html>
<head>
<style type="text/css">

html, body {
  height: 100%;
  cursor:url(media/cur.png), auto;
}

html {
  display: table;
  margin: auto;
}

body {
  vertical-align: middle;
  width: 850px;
  height: 100%;
  text-align: center;

  border: 15px solid transparent;
  padding: 15px;
  border-image-source: url(media/cur.png);
  border-image-repeat: round;
  border-image-slice: 100;
}

.splitter {
  width: 700px;
  height: 50px;
  text-align: center;
}

</style>


<embed src="media/music.mp3" loop="true" autostart="true" style="display:none">

</head>

<body>

<!-- Note: -->

<!-- Announce website on Sunday -->

<br>

<img src="media/cur.png"><h1 style="display:inline-block">Welcome to the Temple</h1><img src="media/cur.png"></span>

<p>This is a sacred place, please respect yourself and others.</p>

<p>Allow audio autoplay on this page for a better experience.</p>

<img src="media/split.png" class="splitter">

<br>
<input type="button" value="Upload" class="homebutton" id="btnHome" onClick="document.location.href='upload.php'" />

<form method="post" style="display: inline-block; padding:10px">
  <input type="text" name="show" value="d29yZHMudHh0" hidden>
  <input type="submit" value="Godwords">
</form>

<img src="media/split.png" class="splitter">

<p>Terry A. Davis (1969 - 2018). Rest in peace!</p>


</body>
</html>
