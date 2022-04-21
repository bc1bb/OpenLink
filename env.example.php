<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header("Status: 301 Moved Permanently", false, 301);
    header("Location: https://www.youtube.com/watch?v=dQw4w9WgXcQ");
    # if file is called by a browser, rick roll ! :)
    # otherwise, send variables to PHP
} else {
    # https://medium.com/@hfally/how-to-create-an-environment-variable-file-like-laravel-symphonys-env-37c20fc23e72
    $variables = [
        #<general>
        'title' => 'OpenLink', # site name
        'ext_url' => 'http://127.0.0.1/OpenLink', # External URL !!! Don't put '/' at the end
        'char_per_id' => 8, # Number of characters to use per link ID
        'warn_on_redirect' => false, # Should we warn user that he's going to get redirected to a URL ?
        #</general>

        #<matomo>
        'matomo' => false,
        'matomo_siteid' => 0,
        'matomo_url' => null,
        #</matomo>

        #<MySQL>
        'mysql_address' => '127.0.0.1',
        'mysql_port' => '3306',
        'mysql_database' => 'openlink',
        'mysql_username' => 'openlink',
        'mysql_password' => 'openlink'
        #</MySQL>
    ];
    foreach ($variables as $key => $value) {
        putenv("$key=$value");
    }
}
