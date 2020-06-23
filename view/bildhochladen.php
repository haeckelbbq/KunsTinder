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
    <aside>
        <?php include 'module/aside.php'; ?>
    </aside>

    <article>

        <table style="width: 100%">

            <tbody>

            <tr>
                <td>Das Bild soll maximal 500px * 500px haben, bis 2Mb gross sein und muß im Format JPG, JPEG, PNG oder
                    GIF vorliegen.
                </td>
            </tr>
            <tr>
                <td>
                    <form action="view/upload.php" method="post" enctype="multipart/form-data">
                        <input type="file" name="datei"><br>
                        <input type="submit" value="Hochladen">
                    </form>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="Titelbild">Titelbild</label>
                    <input id="Titelbild">
                </td>
            </tr>

            <tr>
                <td>
                    <label for="Erstelldatum">Erstelldatum</label>
                <td><input name="erstelldatum" type="date">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="Kategorie">Kategorie</label>
                    <?php echo Html::getPullDown(Kategorietyp::getDataFromDatabase(), 'kategorietypen'); ?>
                </td>
            </tr>


            <tr>

            </tr>
            </tbody>

        </table>
    </article>
    <footer><h2>besteBilderFürAlle</h2></footer>

    <?php include 'module/htmlend.php'; ?>
