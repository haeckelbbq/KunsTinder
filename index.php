<?php
include 'config.php';

spl_autoload_register(function ($class)
{
    include 'class/' . $class . '.php';
});

$action = $_REQUEST['action'] ?? 'startseite';
$area = $_REQUEST['area'] ?? '';
$username = $_REQUEST['username'] ?? '';


$nachname = $_POST['name'] ?? '';
$vorname = $_POST['vorname'] ?? '';
$passwort = $_POST['passwort'] ?? '';
$passwort2 = $_POST['passwort2'] ?? '';
$plz = $_POST['plz'] ?? '';
$ort = $_POST['ort'] ?? '';
$strassehausnummer = $_POST['strassehausnummer'] ?? '';
$bewertung = $_POST['name'] ?? '';
$fehlermeldung = $_POST['name'] ?? '';


if ($action === 'startseite')
{
    include 'view/startseite.php';
}

?>


