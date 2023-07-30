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
 ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Produits</title>
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
</head>

<body style="background: #F1F1F1;">

  <!--  barre de navigation -->

<?php 

include "navBar.php";
 ?>

    <!-- KKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKK -->

   <div class="container">

 <div class="row">
             <div class="col-lg-12 mt-3 mb-3">
                <div class="data_table">
                   <div class="text-center">
                    <h4 class="header-title text-white text-center bg-noir p-2">Les produits</h4>
                </div>
                 <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered">
                    
                        <thead class="table-dark">
                            <tr class="text-white">
                                    <th scope="col">N°</th>
                                    <th scope="col">Designation</th>
                                    <th scope="col">Stock sécurité</th>
                                    <th scope="col">Catégorie</th>
                                     <th scope="col">Photo</th>
                                     <th scope="col">Action</th>
                                    
                                </tr>
                        </thead>
                        <tbody>
                       
                         <?php 
                               $affichercat= $bdd->query("SELECT produit.id, produit.designation, produit.stockSecurite, produit.image,categorie.categorie  FROM produit , categorie WHERE produit.idcategorie=categorie.id ");
                                $num=0;
                                while($tab=$affichercat->fetch())
                                {
                                    $num+=1;
                                    ?> 
                                        <tr>
                                            <th scope="row"><?=$num;?></th>
                                            <td><?=$tab[1];?></td>
                                            <td><?=$tab[2];?></td>
                                            <td><?=$tab[4];?></td>
                                            <td><a href="detailProduit.php?id=<?=$tab[0];?>"><img style="width: 80px; height: 50px;" src="photos/<?=$tab[3];?>"></a></td>

                                            <td>

                                                <a class="btn p-2 bg-noir text-white" href="fiche.php?id=<?=$tab[0]; ?>&&produit=<?=$tab[1]; ?>">Fiche</a>
                                            </td>
                                               
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


        <div class="row">
             <div class="col-lg-12 mt-3">
                <div class="data_table">
                   <div class="text-center">
                    <h4 class="header-title text-white text-center bg-noir p-2">INVENTAIRE</h4>
                </div>
                 <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered">
                    
                        <thead class="table-dark">
                            <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Date</th>
                            <th scope="col">Produit</th>
                                    <th scope="col">Stock logique </th>
                                    <th scope="col">Stock réel</th>
                                    <th scope="col">Ecart</th>
                                    <th scope="col">Prix unitaire</th>
                                    <th scope="col">Unités monétaires</th>
                            </tr>
                        </thead>
                        <tbody>
                       
                         <?php 
                               $afficherI= $bdd->query("SELECT `inventaire`.`id`, `inventaire`.`produit`, `inventaire`.`dates`, `inventaire`.`stockLogique`, `inventaire`.`stockReel`, `inventaire`.`ecart`, `inventaire`.`prix`,produit.designation,(`ecart`*prix) FROM `inventaire`,produit WHERE produit.id=inventaire.produit ");
                                $num=0;
                                while($tab=$afficherI->fetch())
                                {
                                    $num+=1;
                                    ?> 
                                        <tr>
                                            <th scope="row"><?=$num;?></th>
                                             <td><?=$tab[2];?></td>
                                            <td><?=$tab[7];?></td>
                                             <td><?=$tab[3];?></td>
                                             <td><?=$tab[4];?></td>
                                            <td><?php
                                             if ($tab[5]>0) {
                                                echo $tab[5]." Manquant";
                                            }
                                            else if ($tab[5]<0) {
                                                echo $tab[5]." Surplus";
                                            }
                                             else if ($tab[5]==0)
                                            {
                                              echo $tab[5]." Equilibre";
                                            }
                                            ?>
                                            </td>
                                            
                                            <td><?=$tab[6];?></td>
                                            <td><?=$tab[8];?></td>

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
</body>

</html>