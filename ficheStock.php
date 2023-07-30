<?php 
session_start();
if (empty($_SESSION['id'] )) 
{
  header("Location: index.php");
}
include 'connexion.php';

            $affichercat= $bdd->query("SELECT  SUM(entrees.quantite*prix) FROM entrees ");
             $SommeEntrees=0;
              while($tab=$affichercat->fetch())
              {
                  $SommeEntrees=$tab[0];             
              }

            $affichercat= $bdd->query("SELECT SUM(sorties.quantite*prix) FROM sorties  ");
             $SommeSorties=0;
              while($tab=$affichercat->fetch())
              {
                  $SommeSorties=$tab[0];            
              }

              $affichercat= $bdd->query("SELECT COUNT(*) FROM entrees ");
             $LigneEntrees=0;
              while($tab=$affichercat->fetch())
              {
                  $LigneEntrees=$tab[0];             
              }

            $affichercat= $bdd->query("SELECT COUNT(*) FROM sorties  ");
             $LigneSorties=0;
              while($tab=$affichercat->fetch())
              {
                  $LigneSorties=$tab[0];            
              }

              $solde=$SommeEntrees-$SommeSorties;
              $Ligne=$LigneEntrees+$LigneSorties;
             


if (isset($_POST['envoyer'])) {
   $produit=htmlspecialchars($_POST['produit']);
   $quantite=htmlspecialchars($_POST['quantite']);
   $description = htmlspecialchars($_POST['description']);
   $mesure=htmlspecialchars($_POST['mesure']);

   if (is_numeric($quantite)   ) 
   {
       if (is_numeric($mesure))
       {
           $mesureTotal=$quantite*$mesure;
           $bdd-> query("INSERT INTO entrees VALUES (null, now(), '$produit', '$quantite', '$mesure', '$mesureTotal', '$description')");
           $msg= "L'enregistrement réussi !";
       }
       else
       {
          $msg= "La mesure doit être un nombre";
       }
   }
   else
   {
      $msg= "La quantité doit être un nombre";
   }

}
 ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Fiche de stock</title>
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
    <!-- Baraka Kinywa code -->
    <?php
    include 'style.php';
    ?>
     <!-- Baraka Kinywa code -->
</head>

<body style="background: #F1F1F1;">

  <!--  barre de navigation -->

<?php 

include "navBar.php";
 ?>

    <!-- KKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKK -->

   <div class="container">
       








<div class="row">
            <div class="col-12">
                <div class="data_table">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered">
                      <caption>
                        <table>
                          
                          <?= 'La valeur monétaire totale des entrées est de ('.$SommeEntrees."), La valeur monétaire totale des sorties est de (".$SommeSorties.") avec un solde de: ".$solde;

                           ?>
                        </td>
                        </table>
                      </caption>
                    <h4 class=" text-center "> Fiche de stock</h4>
                        <thead class="table-dark">
                         
                            <tr>
                            <th scope="col">N°</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Opération</th>
                                    <th scope="col">Produit</th>
                                    <th scope="col">Quantité</th>
                                    <th scope="col">Unité de mesure</th>
                                    <th scope="col">Prix unitaire</th>
                                    <th scope="col">Total</th>
                                    
                                    
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                               $affichercat5= $bdd->query("SELECT entrees.*, (entrees.quantite*entrees.prix), produit.designation,'entree' FROM `entrees`, produit WHERE produit.id=entrees.idProduit
                              UNION SELECT sorties.*, (sorties.quantite*sorties.prix), produit.designation, 'sortie' FROM sorties, produit  WHERE produit.id=sorties.idProduit ");
                                $num=0;
                                while($tab=$affichercat5->fetch())
                                {
                                    $num+=1;
                                    ?> 
                                        <tr>
                                            <th scope="row"><?=$num;?></th>
                                             <td><?=$tab[1];?></td>
                                            <td><?=$tab[8];?></td>
                                            <td><?=$tab[7];?></td>
                                            <td><?=$tab[3];?></td>
                                            <td><?=$tab[5];?></td>
                                            <td><?=$tab[4];?></td>
                                            <td><?=$tab[6];?></td>
                                            

                                        
                                               
                                        </tr>
                                         <?php 
                                }
                         ?>
                           
                            
                        </tbody>
                    </table>

                </div>
                </div>
            </div>
        </div>



</div>









    <?php include 'scriptBoot.php'; ?>  

    <!-- ============ Java Script Files  ================== -->
    <?php
    include 'scriptPrint.php';
    ?>
    <!-- ============ Java Script Files  ================== -->
</body>

</html>