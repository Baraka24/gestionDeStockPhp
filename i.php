<?php 
 include 'connexion.php';
 session_start();
if (empty($_SESSION['id'] )) 
{
  header("Location: index.php");
}
if (isset($_POST['verifier'])) {

    $produit=htmlspecialchars($_POST['produit']);
     $affichercat= $bdd->query("SELECT  SUM(entrees.quantite) FROM `entrees`,produit WHERE produit.id=entrees.idProduit AND produit.id='$produit'  ");
             $quantiteEnSock=0;
              $stockSecurite=0;
              while($tab=$affichercat->fetch())
              {
                  $quantiteEnSock=$tab[0];  
                              
              }

            $affichercat= $bdd->query("SELECT SUM(sorties.quantite), produit.designation FROM produit, sorties WHERE produit.id=sorties.idProduit AND produit.id='$produit'  ");
             $quantiteSortie=0;
             $nomProd="";
              while($tab=$affichercat->fetch())
              {
                  $quantiteSortie=$tab[0]; 
                  $nomProd=$tab['1']; 
                 
              }
              $sld=0;
              $Ecart=0;
              $com="";
              $EcartTolal=0;
              $Umonétaire=0;
              $stockReel=htmlspecialchars($_POST['quantite']);
              $produit=htmlspecialchars($_POST['produit']);
              $prix=htmlspecialchars($_POST['prix']);
              $date=date('Y-m-d');
              if (is_numeric($stockReel))
               {
                if (is_numeric($prix)) 
                {
                  $sld=$quantiteEnSock-$quantiteSortie;


              $Ecart=$sld-$stockReel;
              $bdd-> query("INSERT INTO `inventaire` VALUES (null, '$produit', '$date', '$sld', '$stockReel','$Ecart','$prix')");
              $msgOk= "Inventaire prise en compte...";
              
              $u=" UM.";

              if ($Ecart>0) {
                  $com=" Manquant";
              }
              else if ($Ecart<0) {
                  $com=" Surplus";
              }
               else if ($Ecart==0)
              {
                $com=" Equilibre";
              }

              
              if ($Ecart<0) {
                    $EcartTolal=$Ecart*(-1);
                    $Umonétaire=$EcartTolal*$prix;
                 
              }
              else
              {
                 $EcartTolal=$Ecart;
                  $Umonétaire=$EcartTolal*$prix;
                  
              }
                }

                else{
                       $msg="Le prix doit être un nombre";
                        $EcartTolal="";
                       $Umonétaire="";
                       $stockReel="";
                       $sld="";
                       $nomProd="";
                       $u="";
                   }
                }
              
              else{
                       $msg="Le stock réel doit être un nombre";
                       $EcartTolal="";
                       $Umonétaire="";
                       $stockReel="";
                       $sld="";
                       $nomProd="";
                       $u="";
                   }
              
                
}

 ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Inventaire</title>
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

  <div class="col-lg-4 mb-3">
        <div class="card mt-1">
            <div class="card-body">
                <div class="text-center">
                    <h4 class="header-title text-white text-center bg-noir p-2">INVENTAIRE</h4>
                </div>
                                        
                <form class="needs-validation " novalidate="" method="POST">
                    <div class="form-row">
                         <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Produit</label>
                                <select class="form-control p-1"  required="" id="validationCustom02" name="produit">
                                  <?php 
                                      $affichercat= $bdd->query("SELECT * FROM produit ");
                                      while($tab=$affichercat->fetch())
                                       {
                                           ?>              
                                    <option value="<?=$tab[0];?>"><?=$tab[1];?></option>
                                            <?php 
                                        }
                                    ?>
                                </select>
                    
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom01">Stocke réel</label>
                                <input type="text" class="form-control" id="validationCustom01" placeholder="reelle" required="" autocomplete="off" name="quantite">
                                                    
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Prix unitaire</label>
                                <input type="text" class="form-control" id="validationCustom02" placeholder="Prix unitaire" required="" autocomplete="off" name="prix">
                                                    
                            </div>
                           
                           
                                                
                        </div>

                        <div class="text-center">
                            
                            
                         
                           <a class="btn bg-noir p-1 text-white p-2 " href="Admin.php">Retour</a>
                            <button class="btn bg-noir text-white p-2 p-1 w-50" type="submit" name="verifier">Appliquer</button> <br>
                            <?php
                            if (isset($msg)) {
                                

                            ?>
                            <div class="alert alert-danger" role="alert">
                                            <strong>Alerte!</strong> <?php
                            echo "Vous devez réapprovisionné le stock pour ce produit!"; 
                            ?>
                            </div>
                            <?php
                            }
                            ?>
                            <?php
                            if (isset($msgOk)) {
                                

                            ?>
                            <div class="alert alert-success" role="alert">
                                            <strong>Alerte!</strong> 
                            <?=$msgOk?>
                            
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                                            
                </form>
            </div>
         </div>
    </div>
            <div class="col-lg-8">
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
                                    <th scope="col">Actions</th>
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

                                            <td>
                                                <a class="btn bg-noir text-white" href="modifierI.php?id=<?=$tab[0]; ?>">Modifier</a>

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




</div>









    <?php include 'scriptBoot.php'; ?>  
    
    <?php 
 include 'scriptPrint.php';
 ?>
</body>

</html>