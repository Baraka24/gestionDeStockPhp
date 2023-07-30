<?php 
session_start();
if (empty($_SESSION['id'] )) 
{
  header("Location: index.php");
}
 include 'connexion.php';
        if (isset($_POST['envoyer'])) 
        {
             $produit=htmlspecialchars($_POST['produit']);
             $quantite=htmlspecialchars($_POST['quantite']);
             $prix=htmlspecialchars($_POST['prix']);
             $description=htmlspecialchars($_POST['description']);
             $date=htmlspecialchars($_POST['date']);
             $affichercat= $bdd->query("SELECT  SUM(entrees.quantite), produit.stockSecurite FROM `entrees`,produit WHERE produit.id=entrees.idProduit AND produit.id='$produit'  ");
             $quantiteEnSock=0;
              $stockSecurite=0;
              while($tab=$affichercat->fetch())
              {
                  $quantiteEnSock=$tab[0];  
                  $stockSecurite=$tab[1]; 
                              
              }

            $affichercat= $bdd->query("SELECT SUM(sorties.quantite), produit.designation FROM produit, sorties WHERE produit.id=sorties.idProduit AND produit.id='$produit'  ");
             $quantiteSortie=0;
             $nomProd="";
              while($tab=$affichercat->fetch())
              {
                  $quantiteSortie=$tab[0]; 
                  $nomProd=$tab['1']; 
                 
              }
             
               $solde=$quantiteEnSock-$quantiteSortie;
               
               
                
                    if (is_numeric($prix)) 
                    {
                        if (is_numeric($quantite)) 
                        {
                             if ($quantite>$solde) 
                                {
                                    $msg="La quantité à sortir doit être inférieure ou égale à la quantité en stock!";
                                     $nomProd="";
                                    $nomProd1="";
                                    $quantiteEnSock1="";
                                    $quantiteSortie1="";
                                    $stockSecurite1="";
                                    $solde1=$solde; 
                                }
                                else
                                {

                                 
                                    $bdd-> query("INSERT INTO sorties VALUES (null, '$date', '$produit', '$quantite', '$prix', '$description')");
                                     $msgsuc= "L'enregistrement réussi !";


                                     $affichercat= $bdd->query("SELECT  SUM(entrees.quantite), produit.stockSecurite FROM `entrees`,produit WHERE produit.id=entrees.idProduit AND produit.id='$produit'  ");
                                         $quantiteEnSock1=0;
                                          $stockSecurite1=0;
                                          while($tab=$affichercat->fetch())
                                          {
                                              $quantiteEnSock1=$tab[0];  
                                              $stockSecurite1=$tab[1]; 
                                                          
                                          }

                                        $affichercat= $bdd->query("SELECT SUM(sorties.quantite), produit.designation FROM produit, sorties WHERE produit.id=sorties.idProduit AND produit.id='$produit'  ");
                                         $quantiteSortie1=0;
                                         $nomProd1="";
                                          while($tab=$affichercat->fetch())
                                          {
                                              $quantiteSortie1=$tab[0]; 
                                              $nomProd1=$tab['1']; 
                                             
                                          }
                                         
                                           $solde1=$quantiteEnSock1-$quantiteSortie1;


                                }
                            
                        }
                        else
                        {
                            $msg="Le quantité doit être un nombre !";
                             $nomProd="";
                                    $nomProd1="";
                                    $quantiteEnSock1="";
                                    $quantiteSortie1="";
                                    $stockSecurite1="";
                                    $solde1=$solde; 
                        }
                    }
                    else
                    {
                        $msg="Le prix doit être un nombre !";
                         $nomProd="";
                                    $nomProd1="";
                                    $quantiteEnSock1="";
                                    $quantiteSortie1="";
                                    $stockSecurite1="";
                                    $solde1=$solde; 
                    }
                



        }

 ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Sorties</title>
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
    
   

    <div class="col-lg-6">
        <div class="card ">
            <div class="card-body">
                <div class="text-center">
                    <h4 class="header-title text-white text-center bg-noir p-2">Sorties de stock</h4>
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
                                <label for="validationCustom01">Quantité</label>
                                <input type="text" class="form-control" id="validationCustom01" placeholder="Quantité" required="" autocomplete="off" name="quantite">
                                                    
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Prix unitaire</label>
                                <input type="text" class="form-control" id="validationCustom02" placeholder="Prix unitaire" required="" autocomplete="off" name="prix">
                                                    
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom02">Date</label>
                                <input value="<?=date('Y-m-d'); ?>" type="date" class="form-control" id="validationCustom02" placeholder="Description " required="" autocomplete="off" name="date">
                                                    
                            </div>
                             <div class="col-md-6 mb-3">
                                <label for="validationCustom02">Unité de mesure</label>
                                <input type="text" class="form-control" id="validationCustom02" placeholder="Unité de mesure" required="" autocomplete="off" name="description">
                                                    
                            </div>


                          
                           
                                                
                        </div>

                        <div class="text-center">
                            <?php if(isset($msg))
                            {
                            ?>
                            <div class="alert alert-danger" role="alert">
                                            <strong>Alerte!</strong> <?php
                            echo $msg; 
                            ?>
                            </div>
                            <?php
                            }
                            ?>

                            <?php if(isset($msgsuc))
                            {
                            ?>
                            <div class="alert alert-success" role="alert">
                                            <strong>Alerte!</strong> <?php
                            echo $msgsuc; 
                            ?>
                            </div>
                            <?php
                            }
                            ?>
                            
                         
                             <a class="btn bg-noir p-2 text-white " href="Admin.php">Retour</a>
                            <button class="btn bg-noir p-2 text-white w-50" type="submit" name="envoyer">Enregistrer</button>
                        </div>
                                            
                </form>
            </div>
         </div>
    </div>

    <div class="col-lg-6 mt-2 mb-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title text-center">Statistiques</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead class="text-uppercase bg-noir">
                                <tr class="text-white">
                                    <th scope="col">Produit</th>
                                    <th scope="col">Entrées </th>
                                    <th scope="col">Sorties</th>
                                    <th scope="col">Solde</th>
                                    <th scope="col">Sock securité</th>
                                     
                                    
                                </tr>
                            </thead>

          

                     <tbody>
                        <?php 
                                if (isset($_POST['envoyer'])) {
                                    ?>
                                         <tr>
                                                
                                                 <td><?=$nomProd1; ?></td>
                                                 <td><?=$quantiteEnSock1; ?></td>
                                                 <td><?=$quantiteSortie1; ?></td>
                                                 <td><?=$solde1; ?></td>
                                                 <td><?=$stockSecurite1; ?></td>
                                                
                               
                                   
                                         </tr>
                                    <?php 
                                }
                         ?>
                           
                        </tbody>





                        <?php
                            if (isset($_POST['envoyer'])) {
                                if($solde1>$stockSecurite1)
                            {
                            }
                            else
                            {

                            ?>
                            <div class="alert alert-danger" role="alert">
                                            <strong>Alerte!</strong> <?php
                            echo "Vous devez réapprovisionné le stock pour ce produit!"; 
                            ?>
                            </div>
                            <?php
                            }
                            }

                         
                            ?>
            
                           
                               


                           
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<div class="row">
  <div class="col-12 mt-2">
                <div class="data_table">
                <h4 class="header-title text-center">Liste des sorties</h4>

                <div class="table-responsive">
                  
                    <table id="example" class="table table-striped table-bordered">
                    <caption>
                        <table>
                            <?php
                           $affichercat= $bdd->query("SELECT SUM(sorties.quantite*prix) FROM sorties  ");
                           $SommeSorties=0;
                            while($tab=$affichercat->fetch())
                            {
                                $SommeSorties=$tab[0];            
                            }
                            ?>
                          
                          <?= 'La valeur monétaire totale des sorties est de :'.$SommeSorties;

                           ?>
                        </td>
                        </table>
                      </caption>
                        <thead class="table-dark">
                            <tr>
                            <th scope="col">N°</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Produit</th>
                                    
                                    <th scope="col">Quantité</th>
                                    <th scope="col">Unité de mesure</th>
                                    <th scope="col">Prix unitaire</th>
                                    <th scope="col">Prix total</th>
                                    
                                    <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                               $affichercat5= $bdd->query("SELECT sorties.id, sorties.dates, produit.designation, sorties.quantite, sorties.prix, (sorties.quantite*sorties.prix) as total, sorties.description FROM sorties, produit WHERE sorties.idProduit=produit.id order by sorties.id desc ");
                                $num=0;
                                while($tab=$affichercat5->fetch())
                                {
                                    $num+=1;
                                    ?> 
                                        <tr>
                                            <th scope="row"><?=$num;?></th>
                                             <td><?=$tab[1];?></td>
                                            <td><?=$tab[2];?></td>
                                             <td><?=$tab[3];?></td>
                                            <td><?=$tab[6];?></td>
                                            <td><?=$tab[4];?></td>
                                            <td><?=$tab[5];?></td>
                                           

                                            <td>
                                                <a class="btn bg-noir text-white" href="modifsortiet.php?id=<?=$tab[0]; ?>">Modifier</a>

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
     <!-- ============ Java Script Files  ================== -->
    <?php
    include 'scriptPrint.php';
    ?>
    <!-- ============ Java Script Files  ================== -->
</body>

</html>