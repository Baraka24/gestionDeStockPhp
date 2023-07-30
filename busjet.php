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
             $libelle=htmlspecialchars($_POST['libelle']);
             $monnaie=htmlspecialchars($_POST['monnaie']);
             $periode=htmlspecialchars($_POST['periode']);
             if (is_numeric($monnaie)) 
             {
               $bdd-> query("INSERT INTO budjet VALUES (null, '$produit', '$periode', '$libelle', '$monnaie')");
              $msgsuc= "L'enregistrement réussi !";
             }
             else
             {
                $msgsuc="Untité monétaire doit être un nombre";
             }
                       
              


        }

 ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Budget</title>
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
    
   

    <div class="col-lg-4">
        <div class="card ">
            <div class="card-body">
                <div class="text-center">
                    <h4 class="header-title text-white text-center bg-noir p-2">Ajouter un budget</h4>
                </div>
                                        
                <form class="needs-validation " novalidate="" method="POST">
                    <div class="form-row">
                         <div class="col-md-6 mb-3">
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
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Periode</label>
                                <input type="text" class="form-control" id="validationCustom01" placeholder="Periode" required="" autocomplete="off" name="periode">
                                                    
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom02">libelle</label>
                                <input type="text" class="form-control" id="validationCustom02" placeholder="libelle" required="" autocomplete="off" name="libelle">
                                                    
                            </div>
                           
                             <div class="col-md-6 mb-3">
                                <label for="validationCustom02">Untité monétaire</label>
                                <input type="text" class="form-control" id="validationCustom02" placeholder="Untité monétaire " required="" autocomplete="off" name="monnaie">
                                                    
                            </div>


                          
                           
                                                
                        </div>

                        <div class="text-center">
                           <?php 
                                if(isset($msgsuc))
                                {
                                  ?>
                                      <div class="alert alert-success" role="alert">
                                            <strong>Alerte!</strong> <?=$msgsuc; ?>
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







  <div class="col-lg-8 mt-2">
                <div class="data_table">
                <h4 class="header-title text-center">Liste des budjets</h4>

                <div class="table-responsive">
                  
                    <table id="example" class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                            <th scope="col">N°</th>
                                    <th scope="col">Produit</th>
                                    
                                    <th scope="col">Période</th>
                                    <th scope="col">Libellé</th>
                                    <th scope="col">Unité monétaire</th>
                                    <th scope="col">Action </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                               $affichercat5= $bdd->query("SELECT budjet.id, produit.designation, budjet.periode, budjet.libelle, budjet.uniteMonetaire FROM budjet, produit WHERE produit.id=budjet.idProduit order by budjet.id desc ");
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
                                            <td><?=$tab[4];?></td>
                                            <td>
                                                <a class="btn bg-noir text-white" href="modifBudget.php?id=<?=$tab[0]; ?>">Modifier</a>

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