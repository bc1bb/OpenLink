const copy = (document) => {
    const element = document.getElementById("link");

    if (! navigator.clipboard) {
        // Old and deprecated way
        element.select();
        element.setSelectionRange(0, 99999);

        document.execCommand("copy");
        return;
    }

    navigator.clipboard.writeText(element.value).then()
}