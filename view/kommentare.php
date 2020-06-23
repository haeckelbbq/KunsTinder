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

    <article>

        <table style="width: 100%">
<thead>
<th>Datum</th>
<th>Username</th>
<th>Kommentar</th>
</thead>
            <tbody>
            <tr>

                <?php if (isset($user_id) && User::getById($user_id)->getRolle() === 'reguser') {
                    echo '<th>bisherige Bewertung</th>';
                } ?>
                <?php if (isset($user_id) && User::getById($user_id)->getRolle() === 'admin') {
                    echo '';
                } ?>

            </tr>
            <?php
            for ($i = 0; $i < count($kommentare); $i++) {
            ?>
            <tr>
                <td><?php echo $kommentare[$i]->getDatum(); ?></td>
                <td><?php echo $kommentare[$i]->getUsername(); ?></td>
                <td><?php echo $kommentare[$i]->getKommentar(); ?></td>
            </tr>

                <tr>
                    <?php if (isset($user_id) && User::getById($user_id)->getRolle() === 'reguser') {
                        if (User::getRestaurantbewertung($restaurants[$i]->getId(), $user_id) == 0) {
                            $id = $restaurants[$i]->getId();
                            echo '<td><a href="index.php?action=zeigeaendern&area=restaurant&id=' ?><?php echo $id; ?><?php echo '"><button>bewerten</button></a></td>';

                        } else {

                            echo '<td>' . User::getRestaurantbewertung($restaurants[$i]->getId(), $user_id) . '</td>';
                        }
                    }
                    if (isset($user_id) && User::getById($user_id)->getRolle() === 'admin') {
                        echo '<td><a href="index.php?action=loeschen&area=restaurant&id=' . $restaurants[$i]->getId() . '"><button>Löschen</button></a></td>';
                    }
                    ?>
                </tr>
                <td>
                    <?php
                    if (Bewertung_Restaurant_User::getKommentar($user[$i]->getId(), $user_id) === '-' && ($user_id != 0)) {
                        echo '<a href="index.php?action=zeigeaendern&area=restaurant&id=' ?><?php echo $id; ?><?php echo '" ><button>kommentieren</button></a>';
                    } else {
                        echo Bewertung_Restaurant_User::getKommentar($restaurants[$i]->getId(), $user_id);
                    }
                    ?></td>

            <?php
            }
            ?>

            <tr>

            </tr>
            </tbody>

        </table>
    </article>
    <footer><h2>besteBilderFürAlle</h2></footer>

    <?php include 'module/htmlend.php'; ?>
