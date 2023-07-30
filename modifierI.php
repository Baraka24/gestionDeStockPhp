<?php 
$id=$_GET['id'];
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
              $bdd-> query("UPDATE `inventaire` SET produit='$produit', dates='$date', `stockLogique`='$sld', `stockReel`='$stockReel', `ecart`='$Ecart',`prix`='$prix' WHERE id=$id");
              $msgOk= "Mise en jour prise en compte...";
              header("refresh:5;i.php"); //refresh 5 second and redirect to index.php page
              
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

  <div class="col-lg-6 mb-3">
        <div class="card mt-1">
            <div class="card-body">
                <div class="text-center">
                    <h4 class="header-title text-white text-center bg-noir p-2">METTRE A JOUR INVENTAIRE</h4>
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
                             <?php 
$id=$_GET['id'];
$afficher= $bdd->query("SELECT * FROM inventaire WHERE id='$id' ");
while($tab=$afficher->fetch())
                                       {
?> 
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom01">Stocke réel</label>
                                <input value="<?=$tab[4]?>" type="text" class="form-control" id="validationCustom01" placeholder="reelle" required="" autocomplete="off" name="quantite">
                                                    
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Prix unitaire</label>
                                <input value="<?=$tab[6]?>" type="text" class="form-control" id="validationCustom02" placeholder="Prix unitaire" required="" autocomplete="off" name="prix">
                                                    
                            </div>
                           
                            <?php 
                                        }
                                    ?>                    
                                                
                        </div>

                        <div class="text-center">
                            
                            
                         
                           <a class="btn bg-noir p-1 text-white p-2 " href="i.php">Retour</a>
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
          
        </div>




</div>









    <?php include 'scriptBoot.php'; ?>  
    
    <?php 
 include 'scriptPrint.php';
 ?>
</body>

</html>