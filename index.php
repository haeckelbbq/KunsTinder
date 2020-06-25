<?php
include 'config.php';

spl_autoload_register(function ($class)
{
    include 'class/' . $class . '.php';
});

$action = $_REQUEST['action'] ?? 'startseite';
$area = $_REQUEST['area'] ?? 'anonymous';
$username = $_REQUEST['username'] ?? '';
$rolle = $_REQUEST['rolle'] ?? '';


$nachname = $_POST['nachname'] ?? '';
$vorname = $_POST['vorname'] ?? '';
$passwort = $_POST['passwort'] ?? '';
$passwort2 = $_POST['passwort2'] ?? '';
$plz = $_POST['plz'] ?? '';
$ort = $_POST['ort'] ?? '';
$strassehausnummer = $_POST['strassehausnummer'] ?? '';
$bildttitel = $_POST['bildtitel'] ?? '';
$kategorie = $_POST['kategorie'] ?? '';
$bewertung = $_POST['bewertung'] ?? '';
$fehlermeldung = $_POST['fehlermeldung'] ?? '';


if ($action === 'startseite')
{
    include 'view/startseite.php';
}
elseif($action === 'einloggen')
{
    include 'view/einloggen.php';
}
elseif($action === 'einloggenueberpruefen')
{
    $fehlermeldung = User::userEinloggen($username,$passwort);
    include 'view/einloggen.php';
}
elseif($action === 'registrieren')
{
    include 'view/registrieren.php';
//    echo '<pre>';
//    echo $action;
//    echo '</pre>';
}
elseif($action === 'registrierenueberpruefen')
{
    $fehlermeldung = User::userRegistrieren($username, $vorname, $nachname, $plz, $ort, $strassehausnummer, $passwort, $passwort2);
    include 'view/registrieren.php';
}

elseif($action === 'usersperren')
{

}
elseif($action === 'userloeschen')
{

}
elseif($action === 'bildloeschen')
{

}



?>


