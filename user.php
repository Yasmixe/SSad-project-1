<!-- page des users-->
<?php


session_start();
// Vérifie si l'utilisateur est connecté, sinon redirige-le vers la page de connexion
if(!isset($_SESSION["username"])){
    header("Location: ../login.php");
    exit(); 
}
?>
<?php
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
   foreach ($mots as $mot) { 
           $resultat[] = Cesaruser($mot,-3);
       } 
   
   return implode(" ", $resultat);
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


        .container {
      margin-top: 100px;
      margin-left:50px;
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
            margin-bottom:10px;
            margin-left:90px;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,
            border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
    
    .btn-primary {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 5px;
        }

        .btn-primary:hover {
            color: #fff;
            background-color: #0069d9;
            border-color: #0062cc;
        }
    table {
      width: 80%;
      border-collapse: collapse;
      margin-left:90px;
      margin-top:10px;
      background-color: #fff;
     border-radius:10px;
    
    }
   
    th, td {
      padding:20px 20px 20px 20px;
      text-align: center;
      border-radius:10px;
     
    }
    th {
      background-color: #fff;
      border-radius:10px;
      
      
    }
   

     
     </style>
     <div class="banner">
     <header class="top">
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
<div class="container">

    <button class="  btn btn-primary" >
      <a href="add.php" style="text-decoration: none; color: #fff;">Add user</a>
    </button>
    <table>
      <thead>
        <tr>
          <th>ID</th>
         
          <th>crypted username</th>
          <th>crypted psw</th>
         <th>username</th>
       <th>password</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
         <?php
         include 'connect.php';

        $sql="select * from `utilisateurs`";
        $result=mysqli_query($con,$sql);
        if($result){
         while($row=mysqli_fetch_assoc($result)){
            $id=$row['id'];
            $cryptedusername=$row['uname'];
            $cryptedpsw=$row['psw'];
            
            $username = $row['uname'];
            $psw = $row['psw'];

            echo '<tr>
            <th >'.$id.' </th>
            <td>'.$cryptedusername.'</td>
            <td>'.$cryptedpsw.'</td>

            <td>'.DechiffrementUser($username).'</td>
            <td>'.DechiffrementUser($psw).'</td>
           
            <td>
            
            <button  style="background-color: #538d47; padding: 5px 0px; margin-right:8px; border:none; border-radius: 5px; cursor: pointer; font-size: 16px;"><a style="text-decoration:none; color: white;" href="update.php? modifid='.$id.'S">edit</a></button>
            <button  onclick="showConfirmation()" style="background-color:#dc2525; color:white; padding: 5px 0px; margin-left:0px;  border:none; border-radius: 5px; cursor: pointer; font-size: 16px;"><a style="text-decoration:none; color: white;" href="delete.php? deleteid='.$id.'">delete</a></button>
      </td>
          </tr>';
         }
        }
         ?>
         
       
      </tbody>
    </table>
  </div>
        </body>
        <script>
               let ProfileDropdownList = document.querySelector(".profile-dropdown-list");
                 let btn = document.querySelector(".dropdown-btn");

                  const toggle = () => {
                  ProfileDropdownList.classList.toggle("open");
                  };

                    btn.addEventListener("click", toggle);


                    function showConfirmation() {
                     if (confirm("Êtes-vous sûr de vouloir supprimer cet élément ?")) {
                    // Appeler la fonction de suppression en PHP
                   window.location.href = "delete.php? deleteid='.$id.'"; // Remplacez XXX par l'ID de l'élément à supprimer
                      }
                       }    

            </script>
        </html>


            