<?php


class User
{
    private int $id;
    private string $vorname;
    private string $nachname;
    private string $plz;
    private string $ort;
    private string $strassehausnummer;
    private string $username;
    private string $passwort;
    private string $rolle;
    private string $status;

    /**
     * User constructor.
     * @param int $id
     * @param string $vorname
     * @param string $nachname
     * @param string $plz
     * @param string $ort
     * @param string $strassehausnummer
     * @param string $username
     * @param string $passwort
     * @param string $rolle
     * @param string $status
     */
    public function __construct($id, $vorname, $nachname, $plz, $ort, $strassehausnummer, $username, $passwort, $rolle, $status)
    {
        $this->id = $id;
        $this->vorname = $vorname;
        $this->nachname = $nachname;
        $this->plz = $plz;
        $this->ort = $ort;
        $this->strassehausnummer = $strassehausnummer;
        $this->username = $username;
        $this->passwort = $passwort;
        $this->rolle = $rolle;
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getVorname()
    {
        return $this->vorname;
    }

    /**
     * @param string $vorname
     */
    public function setVorname($vorname)
    {
        $this->vorname = $vorname;
    }

    /**
     * @return string
     */
    public function getNachname()
    {
        return $this->nachname;
    }

    /**
     * @param string $nachname
     */
    public function setNachname($nachname)
    {
        $this->nachname = $nachname;
    }

    /**
     * @return string
     */
    public function getPlz()
    {
        return $this->plz;
    }

    /**
     * @param string $plz
     */
    public function setPlz($plz)
    {
        $this->plz = $plz;
    }

    /**
     * @return string
     */
    public function getOrt()
    {
        return $this->ort;
    }

    /**
     * @param string $ort
     */
    public function setOrt($ort)
    {
        $this->ort = $ort;
    }

    /**
     * @return string
     */
    public function getStrassehausnummer()
    {
        return $this->strassehausnummer;
    }

    /**
     * @param string $strassehausnummer
     */
    public function setStrassehausnummer($strassehausnummer)
    {
        $this->strassehausnummer = $strassehausnummer;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPasswort()
    {
        return $this->passwort;
    }

    /**
     * @param string $passwort
     */
    public function setPasswort($passwort)
    {
        $this->passwort = $passwort;
    }

    /**
     * @return string
     */
    public function getRolle()
    {
        return $this->rolle;
    }

    /**
     * @param string $rolle
     */
    public function setRolle($rolle)
    {
        $this->rolle = $rolle;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }


    //Username Überprüfen für Registrierung
    public static function usernamenUeberpruefen ($username): bool
    {
        try {
            $dbh = Db::getConnection();
            //DB abfragen
            $sql = 'SELECT * FROM user
                    WHERE username = :username';
            $sth = $dbh->prepare($sql); //$sh für PDOStatement (prepared Statement)
            $sth->bindParam('username', $username, PDO::PARAM_STR);
            $sth->execute();
            $name = $sth->fetchAll(PDO::FETCH_COLUMN);
            if(count($name)===1){
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

    //Passwort überprüfen für Registrierung und Einloggen
    public static function passwortUeberpruefen($passwort1, $passwort2): bool
    {
        if($passwort1 != ''){
            if($passwort1===$passwort2){
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }

    //User Registrierung
    public static function userRegistrieren($username, $vorname, $nachname, $plz, $ort, $strassehausnummer, $passwort) : bool
    {
      if(self::usernamenUeberpruefen($username)){
          if(self::passwortUeberpruefen($passwort)){
              try {
                  $dbh = Db::getConnection();
                  //DB abfragen
                  $sql = 'INSERT INTO user(username, vorname, nachname, plz, ort, strassehausnummer, passwort, rolle, status)
                        VALUES(:username, :vorname, :nachname, :plz, :ort, :strassehausnummer, SHA(:passwort), "regUser", "aktiv")';
                  $sth = $dbh->prepare($sql); //$sh für PDOStatement (prepared Statement)
                  $sth->bindParam('username', $username, PDO::PARAM_STR);
                  $sth->bindParam('vorname', $vorname, PDO::PARAM_STR);
                  $sth->bindParam('nachname', $nachname, PDO::PARAM_STR);
                  $sth->bindParam('plz', $plz, PDO::PARAM_STR);
                  $sth->bindParam('ort', $ort, PDO::PARAM_STR);
                  $sth->bindParam('strassehausnummer', $strassehausnummer, PDO::PARAM_STR);
                  $sth->bindParam('passwort', $passwort, PDO::PARAM_STR);
                  $sth->execute();
                  return 'Sie haben sich erfolgreich registriert, willkommen!';
              } catch (PDOException $e)
              {
                  echo 'Connection failed: ' . $e->getMessage();
              }
          }else{
              return 'Die Passwörter stimmen nicht überein';
          }
      }
    }

    //Daten von User holen fürs Einloggen
    public static function userDatenHolen($username): string
    {
        try {
            $dbh = Db::getConnection();
            //DB abfragen
            $sql = 'SELECT * FROM user
                    WHERE username = :username';
            $sth = $dbh->prepare($sql); //$sh für PDOStatement (prepared Statement)
            $sth->bindParam('username', $username, PDO::PARAM_STR);
            $sth->execute();
            $holeDaten = $sth->fetchAll(PDO::FETCH_COLUMN);
           return $holeDaten;
        } catch (PDOException $e)
        {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    //User Einloggen
    //@Lars und Thomas, habe nicht so gut verstanden mit den Arrays hier... sollten nochmal zusammen schauen
    public static function userEinloggen($username, $passwort) : bool
    {
        //Abweichung von Struktogram! @Lars und Thomas, Bitte kontrollieren
        $userdaten[]='';
        $userdaten<-self::userDatenHolen($username) ;
        $loginPruefen = '';
        $loginPruefen<-$userdaten[0]->row[1];
        $passwortPruefen = '';
        $passwortPruefen<- $userdaten[0]->row[1];
        $userId=0;
        $userId<-$userdaten[0] ->row[0];

        if($loginPruefen===$username){
            if($passwortPruefen===$passwort){
            session_start();
            $_SESSION['userId'] = $userId;
            return 'Login erfolgreich';
            }
            else{
                return 'Das Passwort ist falsch';
            }
        }
        else{
            return 'Der Username existiert nicht';
        }

    }

    //Profil Ändern von User vom User
    public static function profilAendern($vorname, $nachname, $plz, $ort,$strassehausnummer, $passwort): void
    {
        try {
            $dbh = Db::getConnection();

            //DB abfragen
            $sql = 'UPDATE user
                    SET vorname = :vorname, nachname = :nachname, plz = :plz, ort = :ort, strassehausnummer = : strassehausnummer, passwort = SHA(:passwort)
                    WHERE username = :username';
            $sth = $dbh->prepare($sql); //$sh für PDOStatement (prepared Statement)
            $sth->bindParam('vorname', $vorname, PDO::PARAM_STR);
            $sth->bindParam('nachname', $nachname, PDO::PARAM_STR);
            $sth->bindParam('plz', $plz, PDO::PARAM_STR);
            $sth->bindParam('ort', $ort, PDO::PARAM_STR);
            $sth->bindParam('strassehausnummer', $strassehausnummer, PDO::PARAM_STR);
            $sth->bindParam('passwort', $passwort, PDO::PARAM_STR);
            $sth->execute();
        }catch (PDOException $e)
        {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    //User sperren vom Admin
    public static function userSperren($username, $status): void
    {
        try {
            $dbh = Db::getConnection();

            //DB abfragen
            $sql = 'UPDATE user
                    SET username = :username, status = :status
                    WHERE username = :username';
            $sth = $dbh->prepare($sql); //$sh für PDOStatement (prepared Statement)
            $sth->bindParam('username', $username, PDO::PARAM_STR);
            $sth->bindParam('status', $status, PDO::PARAM_STR);
            $sth->execute();
        }catch (PDOException $e)
        {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    //Status von User abfragen. Ist er aktiv oder nicht? Beeinflusst was gesehen wird oder nicht
    public static function userStatusAbfragen($username, $status) : string
    {
        try {
            $dbh = Db::getConnection();
            //DB abfragen
            $sql = 'SELECT status = :status FROM user
                    WHERE username = :username';
            $sth = $dbh->prepare($sql); //$sh für PDOStatement (prepared Statement)
            $sth->bindParam('username', $username, PDO::PARAM_STR);
            $sth->bindParam('status', $status, PDO::PARAM_STR);
            $sth->execute();
            $status = $sth->fetchColumn(PDO::FETCH_COLUMN); //@Lars und Thomas, richtige Schreibweise?
            return $status;
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

        //User löschen vom Admin aus
        //war kein Struktogram! @Lars und Thomas, bitte genau prüfen
        public static function userLoeschen($username) : void
    {
        try {
            $dbh = Db::getConnection();
            $sql = 'DELETE FROM user WHERE username = :username ';
            $sth = $dbh->prepare($sql);
            $sth->bindParam('username', $username, PDO::PARAM_STR);
            $sth->execute();
        } catch (PDOException $e)
        {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }
}