<header class="scrolled">
    <img src="/static/img/bg.jpg" alt="bg" class="banner" />
    <a href="/home" class="logo">
        <img src="/static/img/logo.png" alt="logo" />
    </a>
    <a href="#" class="scroll_down">
        <img src="/static/img/scrollDown.gif" alt="scroll" />
    </a>

    <nav>
        <ul id="navbar">
            <li> <a href="/home">Strona Główna</a> </li>
            <li class="active"> <a href="/gallery">Galeria</a> </li>
            <li> <a href="/login">Logowanie</a> </li>
            <li>
                <a href="/task/start">Zadanie</a>
                <ul>
                    <li> <a href="/static/login/difficulty/easy.html">Łatwy</a> </li>
                    <li> <a href="/static/login/difficulty/medium.html">Średni</a> </li>
                    <li> <a href="/static/login/difficulty/hard.html">Trudny</a> </li>
                    <li> <a href="/static/login/difficulty/impossible.html">Bardzo Trudny</a> </li>
                </ul>
            </li>
            <li> <a href="/bug">Zgłoś błąd</a> </li>
        </ul>
    </nav>
</header>

<script>
    var elements = document.getElementById("navbar").getElementsByTagName("li");
    for(var i = 0; i < elements.length; i++) {
        var element = elements[i].getElementsByTagName("a")[0];
        if(element.textContent === "<?= $title ?>") {
            element.classList.add("active");
        }
    }
</script>