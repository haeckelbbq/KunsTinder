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
                <td><a href="index.php?action=profilaendern&area=user">Profil ändern</a></td>
            </tr>

            <tr>
                <td><a href="index.php?action=ausloggen&area=user">Ausloggen</a></td>
            </tr>
        </table>

    </nav>
<aside> <?php include 'module/aside.php'; ?></aside>
<article>
    <h2>Usereingabe</h2>
    <form action="index.php" method="post">
        <input type="hidden" name="action" value="insert">
        <input type="hidden" name="area" value="user">
        <table>
            <tbody>
            <tr>
                <td><label for="user"</label></td>
                <td><input name="user" type="text"></td>
            </tr>
            <tr>
                <td><label for="passwort">Passwort:</label></td>
                <td><input name="passwort" type="passwort" id="passwort"></td>
            </tr>

            <tr>
                <td></td>
                <td><input type="submit" name="submitname" value="OK"></td>
            </tr>
            </tbody>
        </table>

            <?php include 'view/module/htmlend.php'; ?>


    </form>
    <?php
    $users = User::getDataFromDatabase();
    ?>
</article>