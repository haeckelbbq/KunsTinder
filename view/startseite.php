<?php include 'module/htmlbegin.php'; ?>
<input type="hidden" name="area" value="kunstinder">

<?php $user_id = $_SESSION['user_id'] ?? null; ?>
<body>

<div id="container">
    <header>

    </header>
    <nav>

        <table>

            <?php
            if (isset($user_id)){

                echo '<tr><td><a href="index.php?action=startseite&area=user">Home</a></td></tr>';
                echo '<tr><td><a href="index.php?action=profilaendern&area=user">Profil ändern</a></td></tr>';
                echo '<tr><td><a href="index.php?action=ausloggen&area=user">Ausloggen</a></td></tr>';
            } else {
                echo '<tr><td><a href="index.php?action=startseite&area=user">Home</a></td></tr>';
                echo '<tr><td><a href="index.php?action=registrieren&area=user">registrieren</a></td></tr>';
                echo '<tr><td><a href="index.php?action=einloggen&area=user">Einloggen</a></td></tr>';
            }
            ?>

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
                        <tr><td><a href="index.php?action=kommentieren&area=user">Kommentar</a></td></tr>
                    </table>
                </td>
                <td colspan="2" align="center">
                    <div id="bildanzeige"><img src="img/schoenes500mal500.png"></div>
                </td>
                <td></td>
            </tr>

            <tr>
                <td></td>
                <td align="center"><a href="index.php?action=bewerten&area=user&bewertung=top"><button>TOP</button></a></td>
                <td align="center"><a href="index.php?action=bewerten&area=user&bewertung=flop"><button>FLOP</button></a></td>
                <td><a href=""><button>nächstes</button></a></td>
            </tr>
            </tbody>

        </table>
    </article>
    <footer><h2>besteBilderFürAlle</h2></footer>

    <?php include 'module/htmlend.php'; ?>
