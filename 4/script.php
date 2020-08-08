<?php
include_once 'classes/Parsing.php';
if(isset($_POST['submit'])){
    $teamName = $_POST['teamName'];
    $message = Parsing::allParse($teamName);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="styles/materialize.min.css">
    <link rel="stylesheet" href="styles/styles.min.css">
</head>
<body>

    <ul class="collection">
        <li class="collection-item"><?php echo $message; ?></li>
      </ul>

<script src="scripts/materialize.min.js"></script>
<script src="scripts/scripts.js"></script>
</body>
</html>