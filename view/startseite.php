<?php include 'module/htmlbegin.php'; ?>

<body>

<div id="container">
    <header>
        <h1>Header</h1>
    </header>
    <nav>
        <h2>Navigation</h2>
        <table>
            <tr>
                <a href="index.php?action=ausloggen&area=user"><button>Home</button></a>
            </tr>

            <tr>
                <td><a href=""><button>Profil ändern</button></a></td>
            </tr>

            <tr>
                <td><a href=""><button>Ausloggen</button></a></td>
            </tr>
        </table>

    </nav>
    <aside>
        <h2>Suche</h2>
    </aside>

    <article>
        <h2>Content</h2>
        <table>
        <tr>
            <td>Profilseite anzeige</td>
            <td>Bild anzeigen</td>
            <td>Bildwechseln</td>
        </tr>
        </table>
    </article>
    <footer><h2>besteBilderFürAlle</h2></footer>

    <?php include 'module/htmlend.php'; ?>
