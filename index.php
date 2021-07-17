<?php 

    $conn = new mysqli("localhost","root","","ezvote");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>QR Code Generator</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>QR Code Generator</h2>
  <form action="/action_page.php" method="POST">
    <div class="form-group">
      <label for="name">Candidate Name :</label>
      <input type="text" class="form-control" id="name" placeholder="Enter Candidate Name" name="name">
    </div>
    <div class="form-group">
      <label for="party">Candidate Party :</label>
      <input type="text" class="form-control" id="party" placeholder="Enter Candidate Party" name="party">
    </div>
    <button type="submit" class="btn btn-primary">Generate QR</button>
  </form>
</div>

</body>
</html>
