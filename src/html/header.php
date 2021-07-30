<?php

if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header("Status: 301 Moved Permanently", false, 301);
    header("Location: https://www.youtube.com/watch?v=dQw4w9WgXcQ");
    # if file is called by a browser, rick roll ! :)
    # otherwise, send variables to PHP
} else {
    ?>
<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
    <!-- javascript -->
    <script src="<?= env('ext_url') ?>/src/js/clipboard.js"></script>
    <script src="<?= env('ext_url') ?>/src/js/main.js"></script>

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="<?= env('ext_url') ?>/src/css/main.css" />

    <!-- meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="alternate" hreflang="en" href="<?= env('ext_url') ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1,maximum-scale=1,minimum-scale=1">
    <meta name="application-name" content="<?= env('title') ?>">
    <meta name="msapplication-tooltip" content="<?= env('title') ?>"/>
    <meta name="description" content="<?= env('title') ?> - Link shortening service.">
    <link rel="author" href="<?= env('ext_url') ?>/humans.txt" />

    <meta property="og:url" content="<?= env('ext_url') ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= env('title') ?>">
    <meta property="og:image" content="<?= env('ext_url') ?>/src/img/logo.png">
    <meta property="og:image:alt" content="<?= env('title') ?> - Link shortening service.">
    <meta property="og:description" content="<?= env('title') ?> - Link shortening service.">
    <meta property="og:site_name" content="<?= env('title') ?>">
    <meta property="og:locale" content="fr_FR">

    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@jusdepatate">
    <meta name="twitter:creator" content="@jusdepatate">
    <meta name="twitter:url" content="<?= env('ext_url') ?>">
    <meta name="twitter:title" content="<?= env('title') ?>">
    <meta name="twitter:description" content="<?= env('title') ?> - Link shortening service.">
    <meta name="twitter:image" content="<?= env('ext_url') ?>/src/img/logo.png">
    <meta name="twitter:image:alt" content="<?= env('title') ?> - Link shortening service.">
    <meta name="twitter:dnt" content="on">

    <title><?= env('title') ?></title>

    <?php
    if (env("matomo") == true) {
        ?>
        <!-- Matomo -->
        <script type="text/javascript">
            var _paq = window._paq || [];
            /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
            _paq.push(["setDocumentTitle", document.domain + "/" + document.title]);
            _paq.push(['trackPageView']);
            _paq.push(['enableLinkTracking']);
            (function() {
                var u="<?= env('matomo_url') ?>";
                _paq.push(['setTrackerUrl', u+'matomo.php']);
                _paq.push(['setSiteId', '<?= env('matomo_siteid') ?>']);
                var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
                g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
            })();
        </script>
        <noscript><p><img src="<?= env('matomo_url') ?>matomo.php?idsite=<?= env('matomo_siteid') ?>&amp;rec=1" style="border:0;" alt="" /></p></noscript>
        <!-- End Matomo Code -->
        <?php
    }
    ?>
</head>
<body>
<div><a class="name grey" href="<?= env('ext_url') ?>">OpenLink</a></div>
    <?php
}
