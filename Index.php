
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acceuil</title>
     <?php 
        include "lient.php";
      ?>

    <style>
        .c1{
            
            background-image: linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5 )), url("image/1669738296851.jpg");
            background-size: cover;
            background-position: center;
        }
    </style>

    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>

</head>

<body style="background: #F1F1F1;">


<div id="preloader">
        <div class="loader"></div>
    </div>
    <?php 

include "navBar.php";
 ?>

   <div class="row mt-2">
        <div class="col-lg-12 mt-5">
        <div class="card c1">
            <div class="card-body">
                <h1 class="text-white my-3">Gestion Stock Produits</h1>
               

                <div class="col-lg-8 mt-5">
                        <div class="card">
                            <div class="card-body">
                                
                                <h5>Objectif visé...</h5>
                                <p> Le but d'une application de:
                                    <ol>
                                        <li>faire le suivi des quantités entrées et sorties de stock;</li>
                                        <li>gérer les inventaires valorisées selon plusieurs méthodes pour tous les articles;</li>
                                        <li>prévoire le budget de réapprovisionnement.</li>
                                    </ol>
                                </p>

                                <!-- Button trigger modal -->
                                <a href="login.php" style="border-radius: 10px;" class="btn bg-noir text-white btn-flat btn-lg mt-3 "  >Se connecter</a>
                                
                            </div>
                        </div>
                    </div>
                
            </div>
        </div>
    </div>
   </div>
    <div class="col-lg-12 mt-3">
        <footer class="d-flex flex-wrap p-5 text-white justify-content-between align-items-center py-3 bg-noir  my-4 border-top">
    <ul class="nav col-md-4 justify-content-end text-center">
      <li class="nav-item"><a href="#" class="nav-link px-3  " style="color: white;">Accueil</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-3  " style="color: white;">Contacts</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-3  " style="color: white;">A propos</a></li>
     
    </ul><br>
     <p class="col-md-4 mb-0  text-center" style="color: white;">&copy; 2022 Company, by Kahambu Lukogho Abigaël.</p>
  </footer>
    </div>


    <?php include 'scriptBoot.php'; ?>  
</body>

</html>