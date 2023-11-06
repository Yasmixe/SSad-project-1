<?php


session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
$loggedInUser = $_SESSION['username'];


include 'connect.php';



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
    foreach ($mots as $mot) { // Supprimer le préfixe "C"
            $resultat[] = CesarUser($mot, -3);
        } 
    
    return implode(" ", $resultat);
  }



function pgcd($a, $b) {
  while ($b) {
      $temp = $b;
      $b = $a % $b;
      $a = $temp;
  }
  return $a;
}

function mod_inverse($a, $n) {
  for ($x = 1; $x < $n; $x++) {
      if (($a * $x) % $n == 1) {
          return $x;
      }
  }
  return null;
}

//fonction a utilise
function dechiffrement_affine($message_chiffre, $a, $b) {
  $message_dechiffre = "";
  $n = 26;  // Taille de l'alphabet

  if (pgcd($a, $n) != 1) {
      throw new Exception("La clé 'a' doit être choisie de telle sorte que pgcd(a, 26) = 1");
  }

  $a_inverse = mod_inverse($a, $n);
  if ($a_inverse === null) {
      throw new Exception("La clé 'a' n'a pas d'inverse modulo 26");
  }

  for ($i = 1; $i < strlen($message_chiffre); $i++) {
      $char = $message_chiffre[$i];
      if (ctype_alpha($char)) {  // Vérifiez si la lettre est alphabétique
          $decalage = (ctype_upper($char)) ? 65 : 97;
          $lettre_dechiffree = chr((($a_inverse * (ord($char) - $decalage - $b + $n)) % $n) + $decalage);
          $message_dechiffre .= $lettre_dechiffree;
      } else {
          $message_dechiffre .= $char;  // On ne déchiffre pas les symboles et caractères spéciaux
      }
  }
  return $message_dechiffre;
}


// decryptage  cesar et miroir
function est_palindrome($word)
{
  return $word === strrev($word);
}

function miroir($word)
{
  return strrev($word);
}

//
function cesar($text, $key, $action)
{
  $resultat = "";
  for ($i = 0; $i < strlen($text); $i++) {
      $char = $text[$i];
      if (ctype_alpha($char)) {
          $décalage = $key;
          if ($action === "déchiffrement") {
              $décalage = -$décalage;
          }
          $ascii_offset = ctype_lower($char) ? ord('a') : ord('A');
          $new_char = chr((ord($char) - $ascii_offset + $décalage + 26) % 26 + $ascii_offset);
          $resultat .= $new_char;
      } else {
          $resultat .= $char;
      }
  }
  return $resultat;
}

function cryptage($text, $key, $action)
{
  $resultat = "";
  for ($i = 0; $i < strlen($text); $i++) {
      $char = $text[$i];
      if (ctype_alpha($char)) {
          $décalage = $key;
          if ($action === "déchiffrement") {
              $décalage = -$décalage;
          }
          $ascii_offset = ctype_lower($char) ? ord('a') : ord('A');
          $new_char = chr((ord($char) - $ascii_offset + $décalage + 26) % 26 + $ascii_offset);
          $resultat .= $new_char;
      } else {
          $resultat .= $char;
      }
  }
  return $resultat;
}

function cryptage_miroir($mot, $action)
{
  if ($action === "chiffrement") {
      return strrev($mot);
  } elseif ($action === "déchiffrement") {
      return strrev($mot);
  }
}

function cryptage_mot($mot, $action)
{
  if (est_palindrome($mot)) {
      return cesar($mot, strlen($mot), $action);
  } else {
      return cryptage_miroir($mot, $action);
  }
}
// dechyffrement miroir
function dechiffrementMiroir($phrase_chiffree)
{
  $phrase_inv = $phrase_chiffree;
  $words = explode(" ", $phrase_inv);
  $original_phrase = implode(" ", array_reverse($words));
  $mots = explode(" ", $original_phrase);
  $mot_décrypté = array_map(function ($mot) {
      return cryptage_mot($mot, "déchiffrement");
  }, $mots);
  return implode(" ", $mot_décrypté);
}

//dechiffrement cesar 
function Cesarpour($text, $cle_cesar) {
  $resultat = "";
  $longueur = strlen($text);
  for ($i = 0; $i < $longueur; $i++) {
      $caractere = $text[$i];
      if (ctype_alpha($caractere)) {
          $decalage = $cle_cesar;
          $minuscule = (ctype_lower($caractere));

          $ascii_de_base = ($minuscule) ? ord('a') : ord('A');
          $nouveau_caractere = chr((ord($caractere) - $ascii_de_base + $decalage) % 26 + $ascii_de_base);

          $resultat .= $nouveau_caractere;
      } else {
          $resultat .= $caractere;
      }
  }
  return $resultat;
}
function Dechiffrementcesar($phrase, $cle_cesar) {
  $mots = explode("_", $phrase);
  $resultat = [];
  foreach ($mots as $mot) {
      if (strpos($mot, "C") === 0) {
          $mot = substr($mot, 1);  
          if (!empty($cle_cesar)) {  
              $resultat[] = Cesarpour($mot, -$cle_cesar);
          } else {
              
              $resultat[] = "Erreur : clé Cesar vide";
          }
      } 
  }
  return implode(" ", $resultat);
}




 
$id_message='';
$type='';
$servername = "localhost";
$dbname = "Cryptotool";
$username = "root";
$password = "";


if(isset($_GET['id_message'])){
  $id_message = $_GET['id_message'];

  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT * FROM messages WHERE id_message = :id_message";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id_message', $id_message); 
  $stmt->execute();

  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $message = $row['message'];
  
  $mots = explode("_",  $message);
  $type = '';
foreach ($mots as $mot) {
    if (strpos($mot, "C") === 0) {
      $type = 'cesar';

    }else if(strpos($mot, "A") === 0){
      $type = 'affine';
    }else{
      $type = 'miroir';
    }
}
 // Afficher le formulaire si le paramètre 'showform' est défini à true
 $showForm = isset($_GET['showform']) && $_GET['showform'] === 'true';
  

}
        

 
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>main page</title>
    <link rel="stylesheet" href="style3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
  </head>
  <body>
  <?php if($_SESSION['username'] =='bdvplqh'){
echo ' <header class="top">
<div class="navbar">
    <div class="logo"><a href="#"></a>CryptoTool</div>
    <ul class="links">
    <li><a href= "../SSAD_FINAL/admin/user.php">Users </a></li>
      <li><a href= "index.php">Send messages </a></li>
      <li><a href= "mailbox.php">mailbox </a></li>
      <li><a href="login.php" class="logout_btn">log out </a></li>
    </ul>
    
</div>

</header>';


    }else{
        echo '<header class="top">
        <div class="navbar">
            <div class="logo"><a href="#"></a>CryptoTool</div>
            <ul class="links">
            
              <li><a href= "index.php">Send messages </a></li>
              <li><a href= "mailbox.php">mailbox </a></li>
              <li><a href="login.php" class="logout_btn">log out </a></li>
            </ul>
            
        </div>
        
      </header>';
    }
     ?>
    <div class="container">
        <div class="table_container">
           <h2>your messages</h2>
            <table class="center">
                <tr>
                    <th>Sender</th>
                    <th>Crypted Message</th>
                    <th>Action</th>
                    <th>Decrypted Message</th>
                </tr>
                <?php
                $servername = "localhost";
                $dbname = "Cryptotool";
                $username = "root";
                $password = "";

                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $loggedInUser = DechiffrementUser($_SESSION['username']);

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if (isset($_POST['decrypt'])) {
                        $selectedAlgo = $_POST['types'];
                        $messageId = $_POST['id_message'];
                        $message = $_POST['message'];

                        if ($selectedAlgo === 'cesar') {
                            $cle = $_POST['cle'];
                            $decryptedMessage = Dechiffrementcesar($message, $cle);
                        } elseif ($selectedAlgo === 'miroir') {
                            $decryptedMessage = dechiffrementMiroir($message);
                        } elseif ($selectedAlgo === 'affine') {
                            $a = $_POST['a'];
                            $b = $_POST['b'];
                            $decryptedMessage = dechiffrement_affine($message, $a, $b);
                        } else {
                            echo 'Type de chiffrement non pris en charge';
                        }
                    }
                }
                
                $sql = "SELECT * FROM messages WHERE receiver = :receiver";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':receiver', $loggedInUser);
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $message = $row['message'];
                    $encryptionType = $row['type_chiffrement']; 
                ?>
                <tr>
                    <td><?php echo DechiffrementUser($row['sender']); ?></td>
                    <td><?php echo $message; ?></td>
                    <td>
                    <button onclick="openForm(<?php echo $row['id_message']; ?>, '<?php echo $message; ?>', '<?php echo $encryptionType; ?>')">Déchiffrer</button> </td>
                    <td>
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($decryptedMessage) && $_POST['id_message'] == $row['id_message']) {
                            echo $decryptedMessage;
                        }
                        ?>
                    </td>
                </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
    



<div class="form-popup" id="myForm">
    <form action="mailbox.php" method="post" class="form-container">
        <div class="center">
            <label for="types">Choose encryption type:</label>
            <select id="types" name="types">
                <option value="miroir">Miroir</option>
                <option value="cesar">Cesar</option>
                <option value="affine">Affine</option>
            </select>
        </div>
        <div id="cesar-key" style="display: none;">
            <label for="cle">Enter the Cesar key:</label>
            <input type="number" id="cle" name="cle" max="10">
        </div>
        <div id="affine" style="display: none;">
            <label for="a">Enter parameter 'a'</label>
            <input type="text" id="a" name="a">
            <label for "b">Enter parameter 'b'</label>
            <input type="text" id="b" name="b">
        </div>
        <input type="hidden" name="message" id="message" value="">
        <input type="hidden" name="id_message" id="id_message" value="">
        <div class="bou">
            <button type="submit" name="decrypt" class="btn">Déchiffrer</button>
            <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
        </div>
    </form>
</div>
    <script>
    
  
    function openForm(id, message, allowedAlgorithm) {
    document.querySelector("#id_message").value = id;
    document.querySelector("#message").value = message;

    document.querySelector(".form-popup").style.display = "block";


    var algorithmSelect = document.querySelector("#types");
    var options = algorithmSelect.querySelectorAll("option");

    for (var i = 0; i < options.length; i++) {
        if (options[i].value === allowedAlgorithm) {
            options[i].disabled = false;
        } else {
            options[i].disabled = true;
        }
    }

       
        if (allowedAlgorithm === "cesar") {
        document.getElementById("cesar-key").style.display = "block";
    } else {
        document.getElementById("cesar-key").style.display = "none";
    }

       if (allowedAlgorithm === "affine") {
        document.getElementById("affine").style.display = "flex";
    } else {
        document.getElementById("affine").style.display = "none";
    }
}



    
    function closeForm() {
        document.getElementById("myForm").style.display = "none";
    }

    document.getElementById("types").addEventListener("change", function () {
    var selectedOption = this.value;
    var cesarKey = document.getElementById("cesar-key");
    var affineParams = document.getElementById("affine");

    if (selectedOption === "cesar") {
        cesarKey.style.display = "block";
        affineParams.style.display = "none";
    } else if (selectedOption === "affine") {
        cesarKey.style.display = "none";
        affineParams.style.display = "flex";
        affineParams.style.flexDirection = "column";
    } else {
        cesarKey.style.display = "none";
        affineParams.style.display = "none";
    }
});

</script>


  </body>
  </html>