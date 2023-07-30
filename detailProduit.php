<?php 

include 'connexion.php';
session_start();
if (empty($_SESSION['id'] )) 
{
  header("Location: index.php");
}

$id=$_GET['id'];


 ?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Détail d'un produit</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php 
        include "lient.php";
      ?>

    <style >
        .bg-noir
        {
            background-color: #333;
        }
    </style>


    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body style="background: #F1F1F1;  ">

    <div class="container">
        <div class="row ">
            <div class="col-lg-6  align-items-center justify-content-center">
        <div class="card mt-3 mb-5">
            <div class="card-body text-center">
                <h4 class="header-title text-center"><a class="btn bg-noir mb-2 text-white " href="produit.php" style="float: left;">Retour</a>Détail</h4> 
            <?php 
                 $affichercat= $bdd->query("SELECT produit.id, produit.designation, produit.stockSecurite, produit.image,categorie.categorie  FROM produit , categorie WHERE produit.idcategorie=categorie.id AND  produit.id='$id'");
                 if($tab=$affichercat->fetch())
                  {
                        ?> 
               <img  src="photos/<?=$tab[3];?>"><br><br>
               <th scope="col">Description : <?=$tab[1];?></th><br>
               <th scope="col">Catégorie : <?=$tab[4];?></th><br>
               <th scope="col">Stock sécurité : <?=$tab[2];?></th>
                        <?php 
                   }
             ?>
            </div>
        </div>
    </div>
   


        </div>
    </div>


<?php include 'scriptBoot.php'; ?>  
</body>

</html>