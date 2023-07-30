<?php 
session_start();
if (empty($_SESSION['id'] )) 
{
  header("Location: index.php");
}
 include 'connexion.php';


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








  <div class="col-lg-12 mt-2">
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