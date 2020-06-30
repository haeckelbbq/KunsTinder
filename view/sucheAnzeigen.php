<?php include 'module/htmlbegin.php'; ?>

    <body>

<div id="container">
    <header>
    </header>
    <nav>
        <table>
            <?php
            include 'module/navStartseite' . $area . '.php';
            ?>
        </table>
    </nav>
    <aside>
        <?php include 'module/aside.php'; ?>
    </aside>
    <article>
        <br>Suchergebnisse</br>
            <table>
                <tbody>
                <?php echo bild::tabelleAnzeigen($bildtitel, $kategorie, $username)?>
                </tbody>
            </table>
    </article>
    <footer><h2>besteBilderFürAlle</h2></footer>

<?php include 'module/htmlend.php'; ?>