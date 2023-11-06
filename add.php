<?php
session_start();
// Vérifie si l'utilisateur est connecté, sinon redirige-le vers la page de connexion
if(!isset($_SESSION["username"])){
    if($_SESSION['username'] == 'bdvvplqh'){
    header("Location: ../login.php");}
    exit(); 
}
?>
<!--ajouter un user-->
<?php
             
             $servername = "localhost";
             $dbname = "Cryptotool";
             $username = "root";
             $password = "";
             $shift=3;

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

            
function testpassword($mdp)	{ // $mdp le mot de passe passé en paramètre
    $point = 0;
    $point_min = 0;
    $point_maj = 0;
    $point_chiffre = 0;
    $point_caracteres = 0;
    // On récupère la longueur du mot de passe	
    $longueur = strlen($mdp);
    $point=0;
    // On fait une boucle pour lire chaque lettre
    for($i = 0; $i < $longueur; $i++) 	{
     
        // On sélectionne une à une chaque lettre
        // $i étant à 0 lors du premier passage de la boucle
        $lettre = $mdp[$i];
     
        if ($lettre>='a' && $lettre<='z'){
            // On ajoute 1 point pour une minuscule
            $point = $point + 1;
     
            // On rajoute le bonus pour une minuscule
            $point_min = 1;
        }
        else if ($lettre>='A' && $lettre <='Z'){
            // On ajoute 2 points pour une majuscule
            $point = $point + 2;
     
            // On rajoute le bonus pour une majuscule
            $point_maj = 2;
        }
        else if ($lettre>='0' && $lettre<='9'){
            // On ajoute 3 points pour un chiffre
            $point = $point + 3;
     
            // On rajoute le bonus pour un chiffre
            $point_chiffre = 3;
        }
        else {
            // On ajoute 5 points pour un caractère autre
            $point = $point + 5;
     
            // On rajoute le bonus pour un caractère autre
            $point_caracteres = 5;
        }
    }
     
    // Calcul du coefficient points/longueur
    $etape1 = ($longueur > 0) ? $point / $longueur : 0;
     
    // Calcul du coefficient de la diversité des types de caractères...
    $etape2 = $point_min + $point_maj + $point_chiffre + $point_caracteres;
     
    // Multiplication du coefficient de diversité avec celui de la longueur
    $resultat = $etape1 * $etape2;
     
    // Multiplication du résultat par la longueur de la chaîne
    $final = $resultat * $longueur;
     
    return $final;
     
    }
            
            
             
             try {
                 $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             } catch (PDOException $e) {
                 echo "Erreur de connexion : " . $e->getMessage();
                 if(!$conn){
                     die(mysqli_error($con));
                     
                  }
             }
             
            
             if(isset($_POST['submit'])){
                $username=$_POST['username'];
                $password=$_POST['password'];
              

    // Check if the role is valid
                

    $Password = encryptCesar($password, $shift);
    $Username = encryptCesar($username, $shift);

// Vérifier si le nom d'utilisateur existe
$stmt_check_username = $conn->prepare("SELECT COUNT(*) AS count FROM Utilisateurs WHERE uname = :username");
$stmt_check_username->bindParam(':username', $Username);
$stmt_check_username->execute();
$result_check_username = $stmt_check_username->fetch(PDO::FETCH_ASSOC);

// Vérifier si le mot de passe existe
$stmt_check_password = $conn->prepare("SELECT COUNT(*) AS count FROM Utilisateurs WHERE psw = :password");
$stmt_check_password->bindParam(':password', $Password);
$stmt_check_password->execute();
$result_check_password = $stmt_check_password->fetch(PDO::FETCH_ASSOC);

if ($result_check_username['count'] > 0) {
    // Le nom d'utilisateur existe déjà
    echo '<script>alert("Le nom d\'utilisateur existe déjà dans la base de données");</script>';
} elseif ($result_check_password['count'] > 0) {
    // Le mot de passe existe déjà
    echo '<script>alert("Le mot de passe existe déjà dans la base de données");</script>';
} else {
        $indice = testpassword($password);
        if ($indice > 90) {
            $stmt = $conn->prepare("INSERT INTO Utilisateurs (uname, psw) VALUES (:username, :password)");
            $stmt->bindParam(':username', $Username);
            $stmt->bindParam(':password', $Password);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                // Insertion réussie
                header('location:user.php');
            } else {
                // Échec de l'insertion
                echo "Erreur lors de l'insertion des données.";
            }
        }else{
            echo '<script>alert("Le mot de passe n\'est pas assez fort!");</script>';

        }
    }
}

                    ?>
<!DOCTYPE html>
<html>

    <head>
        <title>SSAD</title>
        <!-- <link rel="icon" href="logonav-removebg-preview.png">-->
        <style>
        *{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
  color: #000;
}

body{
  min-height: 120vh;
  background-size: cover;
  background-color:rgb(216, 216, 216);
}
.top{
  display: flex;
  align-items: center;
  justify-content: center;
  
}

.logo{
  color: white;
  font-size: 1.9rem;
  margin-right: 30px;
}
.navbar{
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 20px;
  background-color: #065ad8;
  color: white;
  width: 80%;
  border-radius: 7px;
  height: 60px;
  box-shadow: 0 3px 2px -2px rgba(0, 0, 0, 0.437);
  margin-left:10%;
}
.li{
  list-style-type: none;
  color:black ;
  text-decoration: none;

}
.top{
  margin-bottom: 100px;
}
a{
  text-decoration: none;
  font-size: 1rem ;
  color: white;
  font-weight:510;
  margin-left: 40px;
  margin-right: 40px;

}
h3{
  margin-bottom: 20px;
  color: #0582E3;
}
ul{
  display: flex;
  justify-content: space-between;
  text-decoration: none;
  list-style-type: none;

}
  .logout_btn{
    background-color:#fff;
    color: #0582E3;
    padding: 0.5rem 1rem;
    border: none;
    outline: none;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: bold;
    cursor: pointer;
  }



             .container{
                
                display: inline-block;
                width:80% ;
                margin-left:60px;
                padding-left:40px;
                padding-right:30px;
                margin-bottom: 60px;
                margin-top:100px;
                border: 2px solid #fff;
                background-color: #fff;
                border-radius: 10px;
                padding-top:25px;
                padding-bottom: 30px;
                
             }
            
             .form-group {
            margin-bottom: 1rem;
            width: 50%;
            
            
        }


        .form-control {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .form-text {
            display: block;
            margin-top: 0.25rem;
        }

        .form-check {
            
            position: relative;
            display: block;
            padding-left: 2px;
            margin-bottom: 2px;
        }

        .form-check-input {
            position: absolute;
            margin-top: 0.3rem;
            margin-left: -1.25rem;
            width:50%;
            height: 1rem;
            opacity: 0;
        }

     

        .btn {
            display: inline-block;
            font-weight: 400;
            color: #212529;
            text-align: center;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,
            border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .btn-primary {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary a{
            color:white;
            text-decoration: none;
        }

        .btn-primary:hover {
            color: #fff;
            background-color: #0069d9;
            border-color: #0062cc;
        }
    </style>
     
             </style>
             <div class="banner">
            <header>
            <div class="navbar">
    <div class="logo"><a href="#"></a>CryptoTool</div>
    <ul class="links">
    <li><a href= "../admin/user.php">Users </a></li>
      <li><a href= "../index.php">Send messages </a></li>
      <li><a href= "../mailbox.php">mailbox </a></li>
      <li><a href="../login.php" class="logout_btn">log out </a></li>
    </ul>
    
</div>
            </header>

         </div>
    </head>
    <body>
       
                    
                    
                   
             
    <div class="container" >
        <form method="POST">
            
           
            <div class="form-group">
                <label >username</label>
                <input type="text" class="form-control"
                    placeholder="insert username" name="username"  autocomplete="off">
                
            </div>

            <div class="form-group">
                <label >password</label>
                <input type="password" class="form-control"
                    placeholder="insert  password" name="password"  autocomplete="off">
                
            </div>
            <div class="form-group">
                <label >role</label>
                <select type="text" class="form-control"
                    placeholder="" name="role"  autocomplete="off">
                <option value="admin">admin</option>
                <option value="user">user</option>
            </select>
                
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Envoyer</button>
            <button type="submit" class="btn btn-primary" name="submit"><a href="user.php">annuler</a></button>
        </form>
    </div>
</body>
            <script>
               let ProfileDropdownList = document.querySelector(".profile-dropdown-list");
                 let btn = document.querySelector(".dropdown-btn");

                  const toggle = () => {
                  ProfileDropdownList.classList.toggle("open");
                  };

                    btn.addEventListener("click", toggle);

            </script>
          
           
</html>

