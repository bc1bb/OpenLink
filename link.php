<?php

require "autoload.php";

add_header();

# https://stackoverflow.com/a/31107425/10503297
function random_str(int $length, string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): string {
    if ($length < 1) {
        throw new \RangeException("Length must be a positive integer");
    }
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}

if (isset($_POST["link"])) {
    $link = $_POST["link"];

    if (preg_match("/^(http(s?):\/\/)?(\[(([0-9a-f]{1,4}:){7}[0-9a-f]{1,4}|([0-9a-f]{1,4}:){1,7}:|([0-9a-f]{1,4}:){1,6}:[0-9a-f]{1,4}|([0-9a-f]{1,4}:){1,5}(:[0-9a-f]{1,4}){1,2}|([0-9a-f]{1,4}:){1,4}(:[0-9a-f]{1,4}){1,3}|([0-9a-f]{1,4}:){1,3}(:[0-9a-f]{1,4}){1,4}|([0-9a-f]{1,4}:){1,2}(:[0-9a-f]{1,4}){1,5}|[0-9a-f]{1,4}:((:[0-9a-f]{1,4}){1,6})|:((:[0-9a-f]{1,4}){1,7}|:)|fe80:(:[0-9a-f]{0,4}){0,4}%[0-9a-z]+|::(ffff(:0{1,4})?:)?((25[0-5]|(2[0-4]|1?[0-9])?[0-9])\.){3}(25[0-5]|(2[0-4]|1?[0-9])?[0-9])|([0-9a-f]{1,4}:){1,4}:((25[0-5]|(2[0-4]|1?[0-9])?[0-9])\.){3}(25[0-5]|(2[0-4]|1?[0-9])?[0-9]))\])|(http(s?):\/\/)?(((([a-zA-Z]+)|([0-9]{1,3}))\.)+(([a-zA-Z]+)|([0-9]{1,3})))/i", $link)) {
        # this fucking regexp magic took me so long to do, it detects perfectly IPv6 and less perfectly IPv4 and (sub-)domains
        $valid_url = true;
    } else {
        $valid_url = false;
    }

    if (! stristr($link, 'http')) {
        $link = "https://" . $link;
    }

    if ($valid_url) {
        $dsn = "mysql:host=" . env("mysql_address") . ";dbname=" . env("mysql_database") . ";port=".env("mysql_port").";charset=utf8mb4";
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

        while (true) {
            $id = random_str(env("char_per_id"));
            $req = $pdo->prepare("select * from LINKS where id = ?");
            $req->execute([$id]);

            $row = $req->fetch();
            if (! isset($row['original'])) {
                break;
            }
        }

        # tiny hack to do a unique ID
        $req = $pdo->prepare("insert into LINKS (id, original, time) values (?, ?, ?)");
        $req->execute([$id, $link, time()]);

        $req = $pdo->prepare("select * from LINKS where id = ?");
        $req->execute([$id]);

        $row = $req->fetch();
        if (! isset($row['original']) && ! is_curl()) {
            ?>
            <center>
                <h1>An unknown error happened.</h1>
                <a class="btn" href="<?= env("ext_url") ?>"><input type="button" value="Go Back"></a>
            </center>
            <?php
        } elseif (! isset($row['original']) && is_curl()) {
            echo "error";
        } elseif (isset($row['original']) && ! is_curl()) {
            ?>
            <h1 class="center">Your link is ready.</h4>
            <center>
                <input readonly type="text" id="lien" class="link-form" value="<?= env("ext_url")."/?".$id ?>">
                <a class="btn" href="javascript:copytoclipboard()" ><input type="button" value="Copy"></a>
                <a class="btn" href="javascript:history.back()"><input type="button" value="Go Back"></a>
            </center>
            <?php
        } elseif (isset($row['original']) && is_curl()) {
            echo env("ext_url")."/?".$id;
        }

    } elseif (! $valid_url && ! is_curl()) {
        ?>
        <center>
        <h1>Invalid URL.</h1>
        <a class="btn" href="javascript:history.back()"><input type="button" value="Go Back"></a>
        </center>
        <?php
    } elseif (! $valid_url && is_curl()) {
        echo "error";
    }

} else {
    header("Status: 301 Moved Permanently", false, 301);
    header("Location: https://www.youtube.com/watch?v=dQw4w9WgXcQ");
}

add_footer();