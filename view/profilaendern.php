<?php include 'module/htmlbegin.php'; ?>

<body>

<div id="container">
    <header>

    </header>
    <nav>

        <table>
            <tr>
                <td><a href="">Profil bearbeiten</a></td>
            </tr>

            <tr>
                <td><a href="">Home</a></td>
            </tr>
            <tr>
                <td><a href="">Ausloggen</a></td>
            </tr>


        </table>

    </nav>
    <aside>
        <?php include 'module/aside.php'; ?>
    </aside>
    <form action="index.php" method="post">
        <input type="hidden" name="action" value="updaten">
        <input type="hidden" name="area" value="user">
        <input type="hidden" name="id" value="<?php echo $user->getId() ?>">
        <table>
            <thead>
            <tbody>
            <tr>
                <td>Username:</td>
                <td><input name="name" type="text" value="<?php echo $user->getName(); ?>"
                        <?php if(isset($user_id) && User::getById($user_id)->getRolle() === 'reguser') {echo 'readonly';}?> ></td>
            </tr>
            <tr>
                <td>PLZ:</td>
                <td><input name="plz" type="text" value="<?php echo $user->getPlz(); ?>"
                        <?php if(isset($user_id ) && User::getById($user_id)->getRolle() === 'reguser')?>></td>
            </tr>
            <tr>
                <td>Ort:</td>
                <td><input name="ort" type="text" value="<?php echo $user->getOrt(); ?>"
                        <?php if(isset($user_id) && User::getById($user_id)->getRolle() === 'reguser')?>></td>
            </tr>
            <tr>
                <td>Strasse, Hausnummer:</td>
                <td><input name="strassehausnummer" type="text" value="<?php echo $user->getStrassehausnummer(); ?>"
                        <?php if(isset($user_id) && User::getById($user_id)->getRolle() === 'reguser')?>>
                </td>
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
                <td>Passwort:</td>
                <td><input name="passwort" type="text" value="<?php echo $user->getpasswort(); ?>"
                        <?php if(isset($user_id) && User::getById($user_id)->getRolle() === 'reguser')?>></td>
            </tr>
            <tr>
                <td><button type="submit" name="submitbutton" value="OK">Daten speichern</button></td>
            </tr>






            <?php
            if(isset($user_id) && User::getById($user_id)->getRolle() === 'reguser')
            {
                ?>

                <?php
            }
            ?>



            <tr>
                <td></td>
                <td><input type="submit" name="submitname" value="Ändern"></td>
            </tr>
            <thead>

    </form>
    </article>
</div>
    <footer><h2>besteBilderFürAlle</h2></footer>

<?php include 'module/htmlend.php'; ?>