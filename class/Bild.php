<?php


class Bild
{
    private int $id;
    private string $bildtitel;
    private string $erstelldatum;
    private string $bild; // @Lars und Thomas, als string, right?
    private int $user_id;
    private string $vorschau;

    /**
     * Bild constructor.
     * @param int $id
     * @param string $bildtitel
     * @param string $erstelldatum
     * @param string $bild
     * @param int $user_id
     * @param string $vorschau
     */
    public function __construct(int $id, string $bildtitel, string $erstelldatum, string $bild, int $user_id, string $vorschau)
    {
        $this->id = $id;
        $this->bildtitel = $bildtitel;
        $this->erstelldatum = $erstelldatum;
        $this->bild = $bild;
        $this->user_id = $user_id;
        $this->vorschau = $vorschau;
    }

    /**
     * @return string
     */
    public function getVorschau(): string
    {
        return $this->vorschau;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getBildtitel(): string
    {
        return $this->bildtitel;
    }

    /**
     * @param string $bildtitel
     */
    public function setBildtitel(string $bildtitel): void
    {
        $this->bildtitel = $bildtitel;
    }

    /**
     * @return string
     */
    public function getErstelldatum(): string
    {
        return $this->erstelldatum;
    }

    /**
     * @param string $erstelldatum
     */
    public function setErstelldatum(string $erstelldatum): void
    {
        $this->erstelldatum = $erstelldatum;
    }

    /**
     * @return string
     */
    public function getBild(): string
    {
        return $this->bild;
    }

    /**
     * @param string $bild
     */
    public function setBild(string $bild): void
    {
        $this->bild = $bild;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

//Bild löschen kann sowohl von Admin als auch von User benutzt werden
public static function bildLoeschen(string $bildtitel):void
{
    try {
        $dbh = Db::getConnection();
        $sql = 'DELETE FROM bild WHERE bildtitel = :bildtitel ';
        $sth = $dbh->prepare($sql);
        $sth->bindParam('bildtitel', $bildtitel, PDO::PARAM_STR);
        $sth->execute();
    } catch (PDOException $e)
    {
        echo 'Connection failed: ' . $e->getMessage();
    }
}

//Bild Wechseln, wenn button next gedrückt wird in View
public static function bildWechseln() : array
{
    try {
        $dbh = Db::getConnection();
        $sql = 'SELECT * FROM bild
                    WHERE id > :id'; //@Lars und Thomas, soll grösste Id raus holen. stimmt so?
        $sth = $dbh->prepare($sql); //$sh für PDOStatement (prepared Statement)
        $sth->execute();
        $bildID = $sth->fetchAll(PDO::FETCH_COLUMN); //@Lars und Thomas, Variable haben wir dann nicht mehr benutzt. Haben wir einen Denkfehler gehabt?
        do{
            $zufallsBildId = random(1, $bildID[0]);
            $sql = 'DELETE FROM bild WHERE id = :id ';
            $sth = $dbh->prepare($sql);
            $sth->bindParam('zufallsBildId', $zufallsBildId, PDO::PARAM_STR);
            $sth->execute();
            $zufallsBild = $sth->fetchAll(PDO::FETCH_FUNC);
        }
        while(count($zufallsBild === 0));
        bildAnzeigen($zufallsBild[0]); // Methode noch nicht geplant
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
}

    //Daten suchen, von aside in View, was der User unter bildtitel, Künstler und Kategorie suchen kann
    public static function datenSuchen($kategorie, $username, $bildtitel) : array
    {
        try {
            $dbh = Db::getConnection();
            //DB abfragen
            $sql = "SELECT * FROM bild
                    WHERE kategorie LIKE '%:kategorie%' AND  username LIKE '%:username%' AND bildtitel LIKE '%:bildtitel' ";
            $sth = $dbh->prepare($sql);
            $sth->bindParam('kategorie', $kategorie, PDO::PARAM_STR);
            $sth->bindParam('username', $username, PDO::PARAM_STR);
            $sth->bindParam('bildtitel', $bildtitel, PDO::PARAM_STR);
            $sth->execute();
            $suchDaten = $sth->fetchAll(PDO::FETCH_FUNC, 'Bild::buildFromPDO');
            return $suchDaten;
        } catch (PDOException $e)
        {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    //Tabellen anzeigen
    //getVorschau() prüfen
    public static function tabelleAnzeigen($seite, $bildtitel, $kategorie, $username) : string
    {
        $ausgabe = '';
        $startpunkt = 0;
        $area= $_REQUEST['area'] ?? 'anonymous';
        $rolle= $_REQUEST['rolle'] ?? '';
        if ($seite > 1)
        {
            $startpunkt = $seite * 10 - 10;
        }
        $suchDaten[ ] = self::datenSuchen($kategorie, $username, $bildtitel);
        if ($suchDaten -> Length < 10)
		{
            $anzahlEinträge = $suchDaten -> Length;
		}
		else
		{
            $anzahlEinträge = 10;
        }
		if ($area!= 'anonymous')
        {
            if ($rolle === 'admin')
            {
                $ausgabe == $ausgabe.
                '
                <th>Kunstwerk</th>
				<th></th>
				<th>Vorschau</th>
				<th>Kategorie</th>
				<th>Künstler</th>
				<th></th>
				<th></th>';
				for ( $i = $startpunkt; $i <= $startpunkt + $anzahlEinträge-1 ; $i += (1))
				{
                    $ausgabe == $ausgabe.
				    '
                    <tr>
                    <td>$suchDaten[i] -> getBildtitel()</td>
					<td><a href ="index.php?action=bildloeschen&area=user">Bild löschen</a></td> 
					<td>$suchDaten[i] -> getVorschau()</td> 
					<td>$suchDaten[i] -> getKategorie()</td>
					<td>$suchDaten[i] -> getUsername()</td>
					<td><a href ="index.php?action=usersperren&area=user">Benutzer sperren</a></td>
					<td><a href ="index.php?action=userloeschen&area=user">Benutzer löschen</a></td>
					</tr>';
				}
			}
            else
            {
                $ausgabe == $ausgabe.
                '
                <th>Kunstwerk</th>
				<th>Vorschau</th>
				<th>Kategorie</th>
				<th>Künstler</th>';
				for ($i = $startpunkt; $i <= $startpunkt + $anzahlEinträge-1; $i += (1))
				{
                    $ausgabe == $ausgabe.
                    '
                    <tr>
                    <td>$suchDaten[i] -> getBildtitel()</td>
					<td>$suchDaten[i] -> getVorschau()</td> 
					<td>$suchDaten[i] -> getKategorie()</td>
					<td>$suchDaten[i] -> getUsername()</td>
					</tr>';
				}
			}
        }
        else
        {
            $ausgabe == $ausgabe.
            '
            <th>Kunstwerk</th>
			<th>Vorschau</th>
			<th>Kategorie</th>
			<th>Künstler</th>';
			for ($i = $startpunkt; $i <= $startpunkt + $anzahlEinträge-1; $i += (1))
			{
                $ausgabe == $ausgabe.
                '
                <tr>
                <td>$suchDaten[i] -> getBildtitel()</td>
				<td>$suchDaten[i] -> getVorschau()</td>
				<td>$suchDaten[i] -> getKategorie()</td>
				<td>$suchDaten[i] -> getUsername()</td>
				</tr>';

			}
		}
		return $ausgabe;
	}


    public static function buildFromPDO(int $id, string $bildtitel, string $erstelldatum, string $bild, int $user_id) : Bild // @Lars und Thomas ist $bild ein string???
    {
        return new Bild($id, $bildtitel, $erstelldatum, $bild, $user_id);
    }
// TO DO:
//Methode bildAnzeigen fehlt
//Methode bildHochladen fehlt
//Tabelle anzeigen
//Bild Vorschau
}