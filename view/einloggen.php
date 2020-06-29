<?php include 'module/htmlbegin.php'; ?>

<body>

<div id="container">
    <header>

    </header>
    <nav>

        <table>
            <tr>
                <td><a href="index.php?action=startseite&area=user">Home</a></td>
            </tr>

            <tr>
                <td><a href="index.php?action=registrieren&area=user">Registrieren</a></td>
            </tr>


        </table>

    </nav>
    <aside>
        <?php include 'module/aside.php'; ?>
    </aside>

    <article>

        <br>einloggenanzeige</br>


        <form action="index.php" method="post">
            <input type="hidden" name="action" value="einloggenueberpruefen">

            <table>

                <tbody>
                <tr>
                    <td>Username:</td>
                    <td><input name="username" type="text" ></td>
                </tr>
                <tr>
                    <td>Passwort:</td>
                    <td><input name="passwort" type="password" ></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="submitname" value="senden"></td>
                </tr>
                </tbody>
            </table>

        </form>
        <?php echo $fehlermeldung; ?>
    </article>
    <footer><h2>besteBilderFürAlle</h2></footer>

    <?php include 'module/htmlend.php'; ?>
