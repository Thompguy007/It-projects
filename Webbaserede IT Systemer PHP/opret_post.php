<?php
session_start();
require_once '/var/www/wits.ruc.dk/db.php';

if (!isset($_SESSION['uid'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $pid = add_post($_SESSION['uid'], $title, $content);

    if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
        $temp_path = $_FILES['image']['tmp_name'];
        $type = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $iid = add_image($temp_path, $type);
        add_attachment($pid, $iid);
    }

    header('Location: forside.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="UTF-8">
    <title>Opret Indlæg</title>
</head>
<body>
<h1>Opret Indlæg</h1>
<div id="time-display">
    <img id="sunmoon" alt="Sun/Moon" />
    <div id="clock"></div>
</div>
<script src="ur.js"></script>

<a href="forside.php">Tilbage til forside</a>
<form action="opret_post.php" method="post" enctype="multipart/form-data">
    <label for="title">Titel:</label>
    <input type="text" name="title" id="title" required>
    <br>
    <label for="content">Indhold:</label>
    <textarea name="content" id="content" rows="5" required></textarea>
    <br>
    <label for="image">Billede (valgfrit):</label>
    <input type="file" name="image" id="image" accept=".jpg,.jpeg,.png,.gif,.svg">
    <br>
    <input type="submit" value="Opret indlæg">
</form>
</body>
</html>

