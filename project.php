<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>File Uploader</title>
</head>
<body>
  <h1>File Uploader</h1>
  <form action="upload.php" method="post" enctype="multipart/form-data">
    <select name="filetype">
      <option value="pdf">PDF</option>
      <option value="doc">Word</option>
      <option value="jpg">JPG</option>
      <option value="ppt">PowerPoint</option>
    </select>
    <input type="file" name="file">
    <input type="submit" value="Upload">
  </form>
  <?php
      $servername = "localhost";
      $username = "root";    
      $password = ""; 
      $dbname = "project_x";  
      // Create connection
      $conn = mysqli_connect($servername, $username, $password, $dbname);

      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      echo "Connected successfully";

      mysqli_close($conn);
      ?>
<?php
    if (isset($_FILES['file'])) {
      $file = $_FILES['file'];
      $filename = $file['name'];
      $filetype = $file['type'];
      $filesize = $file['size'];
      $filetmp = $file['tmp_name'];

      $allowedTypes = array('pdf', 'doc', 'jpg', 'ppt');
      if (!in_array($filetype, $allowedTypes)) {
        echo 'Invalid file type';
      } else {
        if ($filesize > 1048576) {
          echo 'File too large';
        } else {
          $filepath = 'uploads/' . $filename;
          move_uploaded_file($filetmp, $filepath);

          if ($filetype == 'pdf') {
            echo '<embed src="' . $filepath . '" width="100%" height="500">';
          } else if ($filetype == 'doc') {
            echo '<iframe src="' . $filepath . '" width="100%" height="500"></iframe>';
          } else if ($filetype == 'jpg') {
            echo '<img src="' . $filepath . '" width="500">';
          } else if ($filetype == 'ppt') {
            echo '<iframe src="' . $filepath . '" width="100%" height="500"></iframe>';
          }
        }
      }
    }
  ?>
</body>
</html>
