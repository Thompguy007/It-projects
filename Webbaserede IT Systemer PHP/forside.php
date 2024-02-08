<?php
session_start();
require_once '/var/www/wits.ruc.dk/db.php';

if (!isset($_SESSION['uid'])) {
    header('Location: login.php');
    exit;
}
$uid = $_SESSION['uid'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pid = intval($_POST['pid']);
    $commentContent = $_POST['Kommentar'];
    add_comment($uid, $pid, $commentContent);
}

$pids = get_pids();
?>

<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="UTF-8">
    <title>Forside</title>
</head>
<body>

<h1>Forside</h1>
<div id="time-display">
    <img id="sunmoon" alt="Sun/Moon" />
    <div id="clock"></div>
</div>
<script src="ur.js"></script>
<a href="logout.php">Log ud</a>
<br> <br>
<a href="opret_post.php">Opret nyt indlæg</a>

<?php foreach ($pids as $pid): ?>
    <?php $post = get_post($pid); ?>
    <?php $author = get_user($post['uid']); ?>
    <?php $cids = get_cids_by_pid($pid);?>
    <div>
        <h2><?= htmlspecialchars($post['title']) ?></h2>
        <p>Forfatter: <?= htmlspecialchars($author['firstname'] . ' ' . $author['lastname']) ?></p>
        <p>Oprettet: <?= htmlspecialchars($post['date']) ?></p>
        <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
        <?php if($post['uid']=== $uid) :?>
        <a href="rediger.php?pid=<?=$pid?>">Rediger</a>
        <?php endif;?>

        <h3> Kommentarer:</h3>
        <?php foreach ($cids as $cid):
            $comment= get_comment($cid);
            $commenter = get_user($comment['uid']);
        ?>
        <p><?=htmlspecialchars($commenter['firstname'] . ' ' . $commenter['lastname'])?>:   </p>
        <?php endforeach;?>

        <h3> Skriv en kommentar:</h3>
        <form method = "post">
            <input type = "hidden" name ="pid" value="<?= $pid?>">
            <textarea name="Kommentar" rows="4" cols="50"></textarea>
            <input type="submit" value="Tilføj Kommentar">

        </form>


        <?php $iids = get_iids_by_pid($pid); ?>
        <?php foreach ($iids as $iid): ?>
            <?php $image = get_image($iid); ?>
            <img src="<?= htmlspecialchars($image['path']) ?>" alt="Billede <?= $iid ?>">
        <?php endforeach; ?>

        <?php $cids = get_cids_by_pid($pid); ?>
        <?php foreach ($cids as $cid): ?>
            <?php $comment = get_comment($cid); ?>
            <?php $comment_author = get_user($comment['uid']); ?>
            <div>
                <p><?= htmlspecialchars($comment_author['firstname'] . ' ' . $comment_author['lastname']) ?>: <?= nl2br(htmlspecialchars($comment['content'])) ?></p>
                <p>Kommentar oprettet: <?= htmlspecialchars($comment['date']) ?></p>
                <?php if($comment['uid'] === $uid) : ?>
                    <a href="delete_comment.php?comment_id=<?= $cid ?>">Slet kommentar</a>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endforeach ?>
</body>
</html>
