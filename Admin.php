<?php 
include 'connexion.php';
session_start();
if (empty($_SESSION['id'] )) 
{
  header("Location: index.php");
}

 $id=$_SESSION['id'];
 ?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Menu principal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php 
        include "lient.php";
      ?>
    <style>
        .c1{
            height: 60vh;
            background-image: linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5 )), url("image/ggggggggg.jpg");
        }
        .size
        {
            font-size: 1.5em;
        }
    </style>
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body style="background: #F1F1F1;">

  <!--  barre de navigation -->

<?php 

include "navBar.php";
 ?>

    <!-- KKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKK -->

   <div class="container">
       
<div class="row mt-4">

<div class="col-lg-4 mt-5 ">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title text-white text-center bg-noir p-2 ">Profil</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table text-center">
                     <tbody>
                          <?php 
                          $affichercat= $bdd->query("SELECT * FROM utilisateur WHERE id='$id' ");
                          if($tab=$affichercat->fetch())
                           {
                              ?> 
                        <tr>
                            <p class="text-center mb-3">
                                <img style="width: 160px; height: 160px; border-radius: 50%;"  src="image/<?=$tab[5];?>">
                            </p>


                            
                        </tr>
                         
                            <tr>
       
                                 <td > Nom : <?=$tab[1];?></td>
                                
                            </tr>
                            <tr>
                                 

                                 <td> Prénom : <?=$tab[2];?></td>
                            </tr>
                            <tr>

                                 <td>Genre : <?=$tab[3];?></td>
                                 
                            </tr>
                                 <?php 
                        }
                            ?>

                            <tr><td> <a class="btn bg-danger text-white  w-100" href="index.php">Déconnexion</a></td></tr>
                        </tbody>
                           
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-6 mt-5 mb-3">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title text-white text-center bg-noir p-2 ">Menus</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table text-center">
                     <tbody>
                            <tr>
                                 <td> <a class="btn bg-noir size text-white p-4 w-100 fa fa-group" href="AdAdmin.php"> Utilisateurs</a></td>
                                 <td> <a class="btn bg-noir  size text-white p-4 w-100 far fa-dashboard" href="produit.php">Produits</a></td>
                            </tr>
                            <tr>
                                <td> <a class="btn bg-noir size text-white p-4 fa fa-download w-100" href="entrees.php">Entrées</a></td>
                                 <td> <a class="btn bg-noir size text-white p-4 fa fa-upload w-100" href="sorties.php">Sorties</a>
                                 </td>
                                
                            </tr>

                             <tr>
                                <td> <a class="btn bg-noir size text-white fa fa-book p-4 w-100" href="i.php">Inventaire</a></td>
                                 <td> <a class="btn bg-noir size text-white p-4 fa fa-gift w-100" href="busjet.php">Budget</a>
                                 </td>

                            </tr>
                            <tr>
                                     <td colspan="2"> <a class="btn bg-noir size fa fa-server text-white p-4 w-100" href="ficheStock.php">Fiche de stock</a>
                                     </td>
                           </tr>

                        </tbody>
                           
                        </table>

                        <table>
                           
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

 

</div>









   <?php include 'scriptBoot.php'; ?>  
</body>

</html>