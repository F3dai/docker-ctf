<?php
$target_dir = "/tmp/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check mime type
$mimetype = mime_content_type($_FILES['fileToUpload']['tmp_name']);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (in_array($mimetype, array('image/jpeg','image/gif','image/png', 'image/jpg'))){
  move_uploaded_file($_FILES['file']['tmp_name'], $target_dir..$_FILES['file']['name']);
  $uploadOk = 1;
} else {
  die("None of that please <br />");
}

// Check if file already exists
if (file_exists($target_file)) {
  die("Sorry, file already exists. <br />");
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  die("Sorry, your file is too large. <br />");
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  die("Sorry, only JPG, JPEG, PNG & GIF files are allowed. <br />");
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo("Sorry, your file was not uploaded.");
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    echo( "Sorry, there was an error uploading your file.");
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

<body>

<h1>Upload section</h1>

<form action="" method="post" enctype="multipart/form-data">
  <p>Select <strong>image</strong> to upload:</p>
  <input type="file" name="fileToUpload" id="fileToUpload"><br /><br />
  <input type="submit" value="Upload Image" name="submit">
</form>
</body>
