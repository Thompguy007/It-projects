<?php
session_start();
require_once '/var/www/wits.ruc.dk/db.php';

if (!isset($_SESSION['uid'])) {
    header('Location: login.php');
    exit;
}

$uid = $_SESSION['uid'];

if (isset($_GET['comment_id'])) {
    $cid = $_GET['comment_id'];
    $comment = get_comment($cid);

    if ($comment['uid'] === $uid) {
        delete_comment($cid);
    }
}

header('Location: forside.php');
exit;
