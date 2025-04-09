<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//$currentLang = $_SESSION["sel_lan"];
$currentLang = "en"; // TODO: remove static setter
include_once "languages/{$currentLang}.php";
const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASS = '';




const DB_NAME = 'together_way_pzz';

?>