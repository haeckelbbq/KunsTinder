<?php include 'module/htmlbegin.php'; ?>

<body>

<div id="container">
    <header>

    </header>
    <nav>

        <table>
            <tr>
                <td><a href="">Home</a></td>
            </tr>

            <tr>
                <td><a href="">Profil ändern</a></td>
            </tr>

            <tr>
                <td><a href="">Ausloggen</a></td>
            </tr>
        </table>

    </nav>
    <aside>
        <?php include 'module/aside.php'; ?>
    </aside>

    <article>

        <table style="width: 100%">

            <tbody>

            <tr>
                <td align="center">
                    <table>
                        <tr><td>Username</td></tr>
                        <tr><td>Bildtitel</td></tr>
                        <tr><td>Erstelldatum</td></tr>
                        <tr><td>Durchschnittsbewertung</td></tr>
                        <tr><td><a href="">Kommentar</a></td></tr>
                    </table>
                </td>
                <td colspan="2" align="center">
                    <div id="bildanzeige"><img src="img/schoenes500mal500.png"></div>
                </td>
                <td></td>
            </tr>

            <tr>
                <td></td>
                <td align="center"><a href=""><button>TOP</button></a></td>
                <td align="center"><a href=""><button>FLOP</button></a></td>
                <td><a href=""><button>nächstes</button></a></td>
            </tr>
            </tbody>

        </table>
    </article>
    <footer><h2>besteBilderFürAlle</h2></footer>

    <?php include 'module/htmlend.php'; ?>
