<?php


class Bewertung
{
    private int $id;
    private int $bewertung;
    private int $user_id;
    private int $bild_id;

    /**
     * Bewertung constructor.
     * @param int $id
     * @param int $bewertung
     * @param int $user_id
     * @param int $bild_id
     */
    public function __construct(int $id, int $bewertung, int $user_id, int $bild_id)
    {
        $this->id = $id;
        $this->bewertung = $bewertung;
        $this->user_id = $user_id;
        $this->bild_id = $bild_id;
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
     * @return int
     */
    public function getBewertung(): int
    {
        return $this->bewertung;
    }

    /**
     * @param int $bewertung
     */
    public function setBewertung(int $bewertung): void
    {
        $this->bewertung = $bewertung;
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

    /**
     * @return int
     */
    public function getBildId(): int
    {
        return $this->bild_id;
    }

    /**
     * @param int $bild_id
     */
    public function setBildId(int $bild_id): void
    {
        $this->bild_id = $bild_id;
    }

    //Bild bewerten für den User
    public static function bildBewerten(int $userId, int $bildId, int $bewertung) : void
    {
        try {
            $dbh = Db::getConnection();
            //DB abfragen
            $sql = 'INSERT INTO bewertung (user_id, bild_id, bewertung)
                        VALUES(:user_id, :bild_id, :bewertung)';
            $sth = $dbh->prepare($sql);
            $sth->bindParam('user_id', $userId, PDO::PARAM_INT);
            $sth->bindParam('bild_id', $bildId, PDO::PARAM_INT);
            $sth->bindParam('bewertung', $bewertung, PDO::PARAM_INT);
            $sth->execute();
        } catch (PDOException $e)
        {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    //Bewertungsstatus überprüfen. Ist eine Bewertung schon abgegeben, kann der User nicht mehr bewerten
    public static function pruefeBewertungsstatus(int $userId, int $bildId) : bool
    {
        try {
            $dbh = Db::getConnection();
            //DB abfragen
            $sql = 'SELECT * FROM bewertung WHERE user_id = :userId AND bild_id = :bildId';
            $sth = $dbh->prepare($sql);
            $sth->bindParam('userId', $userId, PDO::PARAM_INT);
            $sth->bindParam('bildId', $bildId, PDO::PARAM_INT);
            $sth->execute();
            $holeDaten = $sth->fetchAll();
            if(count($holeDaten) > 0){
                return true;
            }
            else{
                return false;
            }
        } catch (PDOException $e)
        {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    //bewertung löschen
    //Methode ohne Struktogramm, @Lars und Thomas, bitte prüfen
    public static function bewertungLoeschen(int $id):void
    {
        try {
            $dbh = Db::getConnection();
            $sql = 'DELETE FROM bewertung WHERE id = :id ';
            $sth = $dbh->prepare($sql);
            $sth->bindParam('id', $id, PDO::PARAM_INT);
            $sth->execute();
        } catch (PDOException $e)
        {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    //Durchschnitt rechnen
    //@Lars und Thomas, Funtion ohne Struktogramm erstellt, bitte genau prüfen, thx
    public static function durchschnittNote(Bild $bild): int
    {
        //alle -1, 1 der Spalte bewertung in der Tabelle bewertung zusammen rechnen
        try {
            $bild_id = $bild->getId();
            $dbh = Db::getConnection();
            //DB abfragen
            $sql = 'SELECT SUM(bewertung) FROM bewertung
                    WHERE bild_id = :bild_id';
            $sth = $dbh->prepare($sql); //$sh für PDOStatement (prepared Statement)
            $sth->bindParam('bild_id', $bild_id, PDO::PARAM_INT);
            $sth->execute();
            $summeBewertung = $sth->fetchAll();
            return $summeBewertung[0][0];
        } catch (PDOException $e)
        {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public static function buildFromPDO(int $id, int $bewertung, int $user_id, int $bild_id) : Bewertung
    {
        return new Bewertung($id, $bewertung, $user_id, $bild_id);
    }


    //TO DO:
    //Methode für Update nötig?
}