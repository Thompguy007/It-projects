<?php
session_start();
require_once '/var/www/wits.ruc.dk/db.php';

if (!isset($_SESSION['uid'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_GET['pid'])) {
    header('Location: forside.php');
    exit;
}

$pid = intval($_GET['pid']);
$post = get_post($pid);

if ($post['uid'] !== $_SESSION['uid']) {
    header('Location: forside.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    modify_post($pid, $title, $content);

    header('Location: forside.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="UTF-8">
    <title>Rediger Indlæg</title>
</head>
<body>
<h1>Rediger Indlæg</h1>
<a href="forside.php">Tilbage til forside</a>
<form action="rediger.php?pid=<?= $pid ?>" method="post">
    <label for="title">Titel:</label>
    <input type="text" name="title" id="title" value="<?= htmlspecialchars($post['title']) ?>" required>
    <br>
    <label for="content">Indhold:</label>
    <textarea name="content" id="content" rows="5" required><?= htmlspecialchars($post['content']) ?></textarea>
    <br>
    <input type="submit" value="Gem ændringer">
</form>
</body>
</html>

