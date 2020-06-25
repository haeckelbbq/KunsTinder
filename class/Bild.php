<?php


class Bild
{
    private int $id;
    private string $bildtitel;
    private string $erstelldatum;
    private string $bild; // @Lars und Thomas, als string, right?
    private int $user_id;

    /**
     * Bild constructor.
     * @param int $id
     * @param string $bildtitel
     * @param string $erstelldatum
     * @param string $bild
     * @param int $user_id
     */
    public function __construct(int $id, string $bildtitel, string $erstelldatum, string $bild, int $user_id)
    {
        $this->id = $id;
        $this->bildtitel = $bildtitel;
        $this->erstelldatum = $erstelldatum;
        $this->bild = $bild;
        $this->user_id = $user_id;
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
        $bildID = $sth->fetchAll(PDO::FETCH_COLUMN); //@Lars und Thomas, Variable wir dann nicht mehr benutzt. Haben wir einen Denkfehler gehabt?
        do{
            $zufallsBildId = random(1, $bildID[0]); // @Lars und Thomas, ist mir nicht klar was wir da machen. Stimmt es so?
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

// TO DO:
//Methode bildAnzeigen fehlt
//Methode bildHochladen fehlt
//Bild Vorschau
}