<?php 

include 'connexion.php';
session_start();
if (empty($_SESSION['id'] )) 
{
  header("Location: index.php");
}
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
           $bdd-> query("INSERT INTO entrees VALUES (null, now(), '$produit', '$quantite', '$mesure',  '$description')");
           $msg= "L'enregistrement réussi !";
       }
       else
       {
          $msg= "la mesure doit etre un nombre";
       }
   }
   else
   {
      $msg= "la quantite doit etre un nombre";
   }

}
 ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Entrées</title>
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


<?php 

include "navBar.php";
 ?>

    <!-- KKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKK -->

   <div class="container">
       






<div class="row ">
    


    <div class="col-lg-6">
        <div class="card  mb-3">
            <div class="card-body">
                <div class="text-center">
                     <h4 class="header-title text-white text-center bg-noir p-2 ">Entrées en stock</h4>
                </div>
                                        
                <form class="needs-validation " novalidate="" method="POST">
                    <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom02">Produit</label>
                                <select  class="form-control p-1"  required="" id="validationCustom02" name="produit">
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
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom02">Qauntité</label>
                                <input type="text" class="form-control" id="validationCustom02" placeholder=" Qauntité" required="" name="quantite" autocomplete="off">
                                                    
                            </div>


                           <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Unité de mesure</label>
                                <input type="text" class="form-control" id="validationCustom01" placeholder="Unité de mesure" required="" name="description" autocomplete="off">
                                                    
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Prix unitaire</label>
                                <input type="text" class="form-control" id="validationCustom01" placeholder="Prix unitaire" required="" name="mesure" autocomplete="off">
                                                    
                            </div>
                                                
                        </div>

                        <div class="text-center">
                            <p class="text-success"><?php if(isset($msg))echo $msg; ?></p>
                            <a class="btn bg-noir  p-2 text-white  p-1" href="Admin.php">Retour</a>
                            <button class="btn bg-noir p-2 text-white w-50 p-1" type="submit" name="envoyer">Enregistrer</button>
                        </div>
                                            
                </form>
            </div>
         </div>
    </div>

</div>



<div class="row">
            <div class="col-12">
                <div class="data_table">
                <h4 class="header-title text-center">Liste des entrées</h4>
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered">
                    <caption>
                        <table>
                            <?php
                            $affichercat= $bdd->query("SELECT  SUM(entrees.quantite*prix) FROM entrees ");
                            $SommeEntrees=0;
                             while($tab=$affichercat->fetch())
                             {
                                 $SommeEntrees=$tab[0];             
                             }
                            ?>
                          
                          <?= 'La valeur monétaire totale des entrées est de :'.$SommeEntrees;

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
                               $affichercat5= $bdd->query("SELECT entrees.id, entrees.dates, produit.designation , entrees.description, entrees.quantite, entrees.prix, (entrees.quantite*entrees.prix) FROM entrees, produit WHERE entrees.idProduit=produit.id order by entrees.id desc ");
                                $num=0;
                                while($tab=$affichercat5->fetch())
                                {
                                    $num+=1;
                                    ?> 
                                        <tr>
                                            <th scope="row"><?=$num;?></th>
                                             <td><?=$tab[1];?></td>
                                            <td><?=$tab[2];?></td>
                                            <td><?=$tab[4];?></td>
                                            <td><?=$tab[3];?></td>
                                            <td><?=$tab[5];?></td>
                                            <td><?=$tab[6];?></td>

                                            <td>
                                                <a class="btn bg-noir text-white" href="modifEntrees.php?id=<?=$tab[0]; ?>">Modifier</a>

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