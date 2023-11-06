<?php

?>
<?php
include 'connect.php';
?>


<!DOCTYPE html>
<html>

    <head>
        <title>SSAD</title>
        <!-- <link rel="icon" href="logonav-removebg-preview.png">-->
        <style>
         
         *{
            margin :0;
            padding:0;
            font-family:sans-serif;
            }
            body{
                background-color:rgb(216, 216, 216);/*rgba(242,242,242,.98)*/
                height:max-content;
            }

            
            header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding:0;
            background-color: #0f578d;
            color: #000000;
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            z-index: 2;
            }
            .navbar{
             
             width: 85%;
             height: 30px;
             margin:  auto;
             padding: 20px 0 15px 0;
             display: flex;
            /* align-items:center;*/
             justify-content:space-between;
             }

           
             .profile-dropdown{
                position:absolute;
                width:fit-content;
                float:right;
                margin: 0 78%;
                top:15px;

             }
             .dropdown-btn{
             display:flex;
             width:100px;
             height:40px;
             padding-left:25px;
             align-items: center;
             margin:0 auto;
             padding-top:2px;
             margin-top:-4px;
             border:1px solid  #de7f34;
             border-radius:50px;
             cursor: pointer;
             justify-content: space-between;
             background-color: #de7f34;
             color:#fff;
             font-size: 1rem;
             font-weight: 150;
             transition:box-shadow .2s, background-color 0.2s;
             
             }
            
             .dropdown-btn:hover{
             background-color: #de7e34b8;
             }
            
           
             .profile-dropdown-list{ 
              position:relative;
              top:20px;
              width:220px;
              right:30px;
              background-color:#fff;
              border-radius:10px;
              list-style: none;
              max-height: 0;
              overflow:hidden;
              
             } 
             .profile-dropdown-list.open{
                max-height: 400px;
             }

             .profile-items{
                padding:1rem;
                transition:  background-color 0.2s,padding-left 0.2s;
             }
             .profile-items:hover{
               padding-left:1.7rem;
               background-color:#de7e349a;
               border-radius:8px;
               }
               
             .profile-items a{
                display:flex;
                align-items: center;
                text-decoration: none;
                font-size:1.1rem;
                color:#000000;
             }
             .menu{
               
                align-content: center;
             }
           
             .menu ul li{
                top:5px;
                list-style:none;
               display:inline-block;
               margin:0 500px;
		       position: relative;
	     }
	     .menu ul li a {
           
	     text-decoration:none;
		 color: #E6EBED;
         font-size: 1rem;
		 
	     }
	     .menu ul li::after{
	 	 content:'';
		 height: 3px;
		 width:0;
		 background: #de7f34;
		 position:absolute;
		left:0;
		 bottom:-10px;
		 transition:0.3s;	
	     }
	     .menu ul li:hover::after{
	 	 width:100%;
	     }

         .container{
            position:absolute;
            background-color: #fff;
            border-radius: 10px;
            width:70%;
            height:150px;
            top:180px;
            margin-left:120px;
            text-align: center;
            padding:40px 30px;
           
         }
         p{
            text-align: center;
            text-decoration: #000000 double;
         }
         .btn-choix{

            background-color: #de7f34;
            text-decoration: none;
            border:none;
            font-size: 16px;
            font-weight: 300;
            width:20%;
            height:40px;
            border-radius: 5px;
            padding:10px;
            margin:50px 50px;
           z-index: 2;
         }
         .btn-choix:hover{
            background-color: #de7e34c9; 
            border: 2px double #de7f34 ;
         }

         a{ /*  l'ecriture des bouttons  */
            text-decoration:none;
            color:white;
         }

  
         </style>
     <div class="banner">
    <header>
        <div class ="navbar">
           
           
        <div class="profile-dropdown">
                    <div class="dropdown-btn">
                        <p onclick="window.location.href='deconnexion.php'">Déconnexion</p>
                    </div>
                </div>
            <nav class="menu">

                  <ul>
                     <li><a href="#" onclick="window.location.href='homepage.php'"> Accueil</a></li>
                        
                    </ul>
          </nav>
             </div>
            
           
        </div>
    </header>

 </div>
 
</head>
<body>

<div class="container">
        
        <button class="btn-choix"><a href="user.php">utilisateurs</a></button>

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