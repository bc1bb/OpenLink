<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header("Status: 301 Moved Permanently", false, 301);
    header("Location: https://www.youtube.com/watch?v=dQw4w9WgXcQ");
    # if file is called by a browser, rick roll ! :)
    # otherwise, send variables to PHP
} else {
    ?>
                </div>
            </div>
        <br>
        </section>
    </main>
    <footer class="flex flex-col md:flex-row items-start w-full flex-none self-start p-6 font-medium text-xs text-grey-dark md:items-center justify-between">
        <p><span class="copyleft">&copy;</span> 2021 <i>Jus de Patate_</i> | <u><a href="https://github.com/jusdepatate/OpenLink/commit/<?= get_current_git_commit() ?>"><?= get_current_git_commit("master", true) ?></a></u></p>
        <ul class="list-reset flex flex-col md:flex-row items-start md:items-center md:justify-end" >
            <br>
            <li><?= env('title') ?> is a simple link shortening service, free and <u><a href="https://github.com/jusdepatate/OpenLink" target="_blank">open source</a></u>.</li>
        </ul>
    </footer>
</body>
</html>
<?php
}
