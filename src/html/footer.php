<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header("Status: 301 Moved Permanently", false, 301);
    header("Location: https://www.youtube.com/watch?v=dQw4w9WgXcQ");
    # if file is called by a browser, rick roll ! :)
    # otherwise, send variables to PHP
} else {
    ?>
    <footer>
        <small class="grey"><span class="copyleft">&copy;</span> 2021 - Jus de Patate_ - <a href="https://github.com/jusdepatate/openlongr/commit/<?= get_current_git_commit() ?>"><?= get_current_git_commit("master", true) ?></a></small>
    </footer>
</body>
</html>
<?php
}
