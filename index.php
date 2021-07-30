<?php

require "autoload.php";

$argument = preg_split('/[\/].*[?]/', $_SERVER["REQUEST_URI"]);
if (sizeof($argument) === 2) {
    $argument = $argument[1];

    $dsn = "mysql:host=" . env("mysql_address") . ";dbname=" . env("mysql_databse") . ";port=".env("mysql_port").";charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    try {
        $pdo = new PDO($dsn, env("mysql_username"), env("mysql_password"), $options);
        $pdo->exec("use ". env("mysql_database"));
    } catch (PDOException $e) {
        die($e->getMessage()." ".(int)$e->getCode());
    }

    $req = $pdo->prepare("select * from LINKS where id = ?");
    $req->execute([$argument]);

    $row = $req->fetch();
    if (isset($row['original'])) {
        $original = $row['original'];
        $prettier = preg_replace("/^htt(ps|p):\/\//i", "", $original);
        $prettier = preg_replace("/(\/.*)+/i", "", $prettier);

        if (is_curl()) {
            die($row['original']);
        }
        header("refresh:5;url=" . $original);
        add_header();
        ?>
        <center>
            <h1><?= env('title') ?></h1>
            <p>You will be redirected to <code><?= $prettier ?></code> in 5 seconds.</p>
            <a href="<?= $original ?>" class="btn">Impatient?</a>
            <a class="btn" href="javascript:history.back()">Go back</a>
            <small><a class="btn whysusp" href="<?= env('ext_url') ?>/why-susp.php">Why do I see this page ?</a></small>
        </center>
        <?php
    } else {
        add_header();
        ?>
        <div class="center"><h4>This link doesnt exist.</h4></div>
        <a class="btn " href="javascript:history.back()">Go back</a>
        <?php
    }
} else {
    add_header();
    ?>
                    <div class="center"><h1>Transform your link now.</h1></div><br>
                    <form method="post" action="<?= env('ext_url') ?>/link.php">
                        <center>
                            <input placeholder="Original link" type="text" name="link" class="link-form" required>

                            <input id="buttonsend" type="submit" value="Transformation" name="submit" class="btn submit">
                        </center>
                    </form>
    <?php
}

add_footer();
