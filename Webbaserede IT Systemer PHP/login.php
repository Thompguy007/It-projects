<?php
session_start();
require_once '/var/www/wits.ruc.dk/db.php';

$error = false;

if (isset($_POST['login'])) {
    $uid = $_POST['uid'];
    $password = $_POST['password'];

    if (login($uid, $password)) {
        $_SESSION['uid'] = $uid;
        header('Location: forside.php');
        exit;
    } else {
        $error = true;
    }
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        $uid = $_POST['uid'];
        $password = $_POST['password'];
        if (login($uid, $password)) {
            $_SESSION['uid'] = $uid;
            header('Location: forside.php');
            exit;
        } else {
            $error = 'Forkert brugernavn eller adgangskode.';
        }
    } elseif (isset($_POST['signup'])) {
        $uid = $_POST['uid'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $password = $_POST['password'];
        if (empty($uid) || empty($firstname) || empty($password)) {
            $error = 'Brugernavn, fornavn og adgangskode er påkrævet.';
        } elseif (strlen($password) < 8) {
            $error = 'Adgangskoden skal være mindst 8 tegn lang.';
        } else {
            $user = get_user($uid);
            if ($user) {
                $error = 'Brugernavn er allerede taget.';
            } else {
                add_user($uid, $firstname, $lastname, $password);
                $_SESSION['uid'] = $uid;
                header('Location: forside.php');
                exit;
            }
        }
    }
}

}
?>

<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            background-color: white;
        }

        .container {
            background-color: #0077b5;
            margin: auto;
            padding: 20px;
            width: 100%;
        }
        .bottom {
            background-color: #0077B5;
            margin: auto;
            padding: 20px;
            width: 100%;
            position: fixed;
            bottom: 0;

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #0077b5;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
        }

    </style>
</head>
<body>

<div id="time-display">

        <img id="sunmoon" alt="Sun/Moon" />
        <div id="clock"></div>

</div>

<script src="ur.js"></script>

<h1>Login</h1>
<?php if ($error) : ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>
<form method="post">
    <label for="uid">Brugernavn:</label>
    <input type="text" name="uid" id="uid" required><br>
    <label for="password">Adgangskode:</label>
    <input type="password" name="password" id="password" required><br>
    <input type="submit" name="login" value="Login">
</form>
<hr>
<h1>Registrer</h1>
<form method="post">
    <label for="uid_signup">Brugernavn:</label>
    <input type="text" name="uid" id="uid_signup" required><br>
    <label for="firstname">Fornavn:</label>
    <input type="text" name="firstname" id="firstname" required><br>
    <label for="lastname">Efternavn:</label>
    <input type="text" name="lastname" id="lastname"><br>
    <label for="password_signup">Adgangskode:</label>
    <input type="password" name="password" id="password_signup" minlength="8" required><br>
    <input type="submit" name="signup" value="Registrer">
</form>
</body>
</html>
</div>
<div class="bottom">
    <br>
    <br>
    <br>
</div>

<img id="sunmoon" src="" alt="Sun or Moon" />

</body>



<style>
    #sunmoon{
        position: absolute;
        top: 130px;
        right: 10px;
    }
    #clock {
        position: absolute;
        top: 10px;
        right: 10px;
    }

</style>



</html>