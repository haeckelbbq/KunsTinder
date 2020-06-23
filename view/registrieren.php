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
                <td><a href="">Einloggen</a></td>
            </tr>


        </table>

    </nav>
    <aside>
        <?php include 'module/aside.php'; ?>
    </aside>

    <article>
        <h1> Anmelden </h1>
        <form action= "index.php" method="post">
            <input type="hidden" name="action" value="registrierenueberpruefen">
            <table>
                <thead>
                <tbody>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="name"></td>
                </tr>
                <tr>
                    <td>Vorname:</td>
                    <td><input type="text" name="vorname"></td>
                </tr>
                <tr>
                    <td>Nachname:</td>
                    <td><input type="text" name="nachname"></td>
                </tr>
                <tr>
                    <td>Plz:</td>
                    <td><input type="text" name="plz"></td>
                </tr>
                <tr>
                    <td>Ort:</td>
                    <td><input type="text" name="ort"></td>
                </tr>
                <tr>
                    <td>Strasse und Hausnr:</td>
                    <td><input type="text" name="strasseundhausnummer"></td>
                </tr>
                <tr>
                    <td>Passwort:</td>
                    <td><input type="passwort" name="passwort"></td>
                </tr>
                <tr>
                    <td>Passwort wiederholen:</td>
                    <td><input type="passwort" name="passwort2"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="reset"> <input type="submit" name="" value="Registrieren"></td>
                </tr>

<!--                --><?php //echo $fehlermeldung; ?>


        </form>
    </article>
    <footer><h2>besteBilderFürAlle</h2></footer>

    <?php include 'module/htmlend.php'; ?>
