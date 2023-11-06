<?php
session_start();
// Vérifie si l'utilisateur est connecté, sinon redirige-le vers la page de connexion
if(!isset($_SESSION["username"])){
    header("Location: ../index.php");
    exit(); 
}
?>
<!--modifier un user-->
<?php
             include 'connect.php';

             $servername = "localhost";
             $dbname = "Cryptotool";
             $username = "root";
             $password = "";
            


             function encryptCesar($text, $shift) {
                $result = "";
                for ($i = 0; $i < strlen($text); $i++) {
                    $char = $text[$i];
                    if (ctype_alpha($char)) {
                        $isLowerCase = ctype_lower($char);
                        $asciiStart = $isLowerCase ? ord('a') : ord('A');
                        $result .= chr(($isLowerCase ? (ord($char) - $asciiStart + $shift) % 26 : (ord($char) - $asciiStart + $shift) % 26) + $asciiStart);
                    } else {
                        $result .= $char;
                    }
                }
                return $result;
            }
            

            
function Cesaruser($text, $cle_cesar) {
    $resultat = "";
    $longueur = strlen($text);
    for ($i = 0; $i < $longueur; $i++) {
        $caractere = $text[$i];
        if (ctype_alpha($caractere)) {
            $decalage = $cle_cesar;
            $minuscule = (ctype_lower($caractere));
  
            $ascii_de_base = ($minuscule) ? ord('a') : ord('A');
            $nouveau_caractere = chr((ord($caractere) - $ascii_de_base + $decalage + 26) % 26 + $ascii_de_base);
 
  
            $resultat .= $nouveau_caractere;
        } else {
            $resultat .= $caractere;
        }
    }
    return $resultat;
  }
  
  function DechiffrementUser($phrase) {
    $mots = explode(" ", $phrase);
    $resultat = [];
    foreach ($mots as $mot) { 
            $resultat[] = Cesaruser($mot,-3);
        } 
    
    return implode(" ", $resultat);
  }
  
  $id = $_GET['modifid'];

  $sql = "SELECT * FROM utilisateurs WHERE id='$id'";
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_assoc($result);
  
  $utilisateur = $row['uname'];
  $motdepasse = $row['psw'];
  $shift=3;
  
  
  
  if (isset($_POST['submit'])) {
      $shift = 3;

      $psw = encryptCesar($_POST['password'], $shift);

      //username chiffrer
      $uname = encryptCesar($_POST['username'], $shift);
       //username de bdd dechiffrer
       $utiliDechiffrer = DechiffrementUser($utilisateur);
      
     //username ecrit nrmlm
      $user = $_POST['username'];
      $sql = "UPDATE utilisateurs SET uname='$uname', psw='$psw' WHERE id='$id'";
      $result = mysqli_query($con, $sql);
      
      if ($result) {
          $sql1 = "UPDATE messages
                   SET sender = '$uname', receiver = '$user'
                   WHERE sender = '$utilisateur' OR receiver = '$utilisateur'";
          $res = mysqli_query($con, $sql1);
      
          if ($res) {
              header('location:user.php');
          } else {
              die(mysqli_error($con));
          }
      } else {
          die(mysqli_error($con));
      }
    }
                    ?>