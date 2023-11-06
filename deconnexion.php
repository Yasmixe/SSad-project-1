<?php
// Démarre la session
session_start();

// Déconnecte l'utilisateur en détruisant la session
if(session_destroy()){

// Redirige l'utilisateur vers la page de connexion
header("Location:login.php");

}
?>