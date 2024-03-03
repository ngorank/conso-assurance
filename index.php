<?php
session_start();
$login=$_SESSION['login'];
if(empty($login)){
    header('Location:login.php');
}
include('function_connexion.php');
$sql=$conn->query("SELECT * FROM tb_consommation  WHERE login = '$login' ORDER BY annee ASC ");

$sqlpersonne=$conn->query("SELECT * FROM tb_consommation  WHERE login = '$login' ORDER BY annee ASC ");
?>


<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Conso SCAR INTER</title>
    <!-- MDB icon -->
    <link rel="icon" href="img/logo.png" type="image/x-icon" />
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
    <!-- Google Fonts Roboto -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
    />
    <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css" />
  </head>
  <body>

  
    <section class="h-100 gradient-custom">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-lg-10 col-xl-8">
            <div class="card" style="border-radius: 10px;">

            <?php $res=$sqlpersonne->fetch(); ?> 

              <div class="card-header px-4 py-5" style="background-color:#FFBF66">
                <h5 class="text-muted mb-0">Famille <span style="color: #362331;"> <?php echo $res['famille'] ?> </span>!</h5>
              </div>
              <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                  <p class="lead fw-normal mb-0" style="color: #a8729a;">
                  <a href="logout.php">
                  <i class="fas fa-terminal"></i>
                  </a>
                </p>
                  <p class="small text-muted mb-0">Numéro de carte : 1KAU9-84UIL</p>
                </div>

                <?php  ?>

                <?php while($resultat=$sql->fetch()){ ?> 
                <div class="card shadow-0 border mb-4">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-2">
                        <img src="images/profil.jpeg" width='60'
                          class="img-fluid" alt="Phone">
                      </div>
                      <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                        <p class="text-muted mb-0"> 2023 </p>
                      </div>
                      <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                        <p class="text-muted mb-0 small"><?php echo $resultat['type_personne'] ?></p>
                      </div>
                      <!--div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                        <p class="text-muted mb-0 small">Autres : 0</p>
                      </div-->
                      <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                        <p class="text-muted mb-0 small">Effectif: 0</p>
                      </div>
                      <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                        <p class="text-muted mb-0 small">
                            <b>
                            <?php echo strrev(wordwrap(strrev($resultat['consommation']), 3, ' ', true)); ?> F CFA
                            </b>
                                                   
                    </p>
                      </div>
                    </div>
                    <hr class="mb-4" style="background-color: #d71111; opacity: 10;">
                    <div class="row d-flex align-items-center">
                      <div class="col-md-2">
                        <p class="text-muted mb-0 small">Evolution</p>
                      </div>
                      <div class="col-md-10">

                        <div class="progress" style="height: 6px; border-radius: 16px;">
                            <?php 
                            $limiteconsommation=$resultat['limiteconsommation'];
                            $consommation=$resultat['consommation'];
                            $valeurpourcent=( $consommation/$limiteconsommation)*100; 

             
                        if ($valeurpourcent<50) { ?>

                        <div class="progress-bar" role="progressbar"
                            style="width: <?php echo ceil($valeurpourcent); ?>%; border-radius: 16px; background-color: #24D26D;" aria-valuenow="65"
                            aria-valuemin="0" aria-valuemax="100">
                        </div>
                           
                            <?php } elseif($valeurpourcent>50 AND $valeurpourcent<70) {?>

                        <div class="progress-bar" role="progressbar"
                            style="width: <?php echo ceil($valeurpourcent); ?>%; border-radius: 16px; background-color: #FCFE19;" aria-valuenow="65"
                            aria-valuemin="0" aria-valuemax="100">
                        </div>

                        <?php }else {?>

                        <div class="progress-bar" role="progressbar"
                            style="width: <?php echo ceil($valeurpourcent); ?>%; border-radius: 16px; background-color: #BB2D0C;" aria-valuenow="65"
                            aria-valuemin="0" aria-valuemax="100">
                        </div>
                        <?php  } ?>
                        </div>

                        <div class="d-flex justify-content-around mb-1">
                          <p class="text-muted mt-1 mb-0 small ms-xl-5">
                          <?php echo $res['periode'] ?>
                          </p>
                          <p class="text-muted mt-1 mb-0 small ms-xl-5">consommé <?php echo ceil($valeurpourcent); ?>%</p>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
            <?php } ?> 
    
            <p class="fw-bold mb-0">Details</p>
                <?php  
                $sqlannee=$conn->query("SELECT DISTINCT(annee) FROM tb_consommation WHERE login = '$login' ORDER BY annee ASC");
                while($res=$sqlannee->fetch()){ ?>

                <div class="d-flex justify-content-between pt-2">
                    <p class="fw-bold mb-0"> Année : <?php echo $annee=$res['annee'] ?></p>

                <?php  
                $sqlsomme=$conn->query("SELECT SUM(consommation) AS consommation FROM tb_consommation WHERE login = '$login' AND annee='$annee'");
                while($result=$sqlsomme->fetch()) {?>

                    <p class="text-muted mb-0"><span class="fw-bold me-4">Total :</span>
                    <?php echo strrev(wordwrap(strrev($result['consommation']), 3, ' ', true)); ?> FCFA
                
                </p>
                </div>    
               <?php } } ?>


                
    
                <!--div class="d-flex justify-content-between pt-2">
                  <p class="text-muted mb-0">01 Janvier 2022 - 31 Aout 2022 : 788152</p>
                  <p class="text-muted mb-0"><span class="fw-bold me-4">Consommation </span> $19.00</p>
                </div-->
    


              </div>
              <div class="card-footer border-0 px-4 py-5"
                style="background-color: #939597; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                <h5 class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0">Total
                  payé par SCAR INTER : 

                  <?php  
                $sqltotal=$conn->query("SELECT SUM(consommation) AS consommation FROM tb_consommation WHERE login = '$login'");
                while($total=$sqltotal->fetch()) {?>
                    <?php echo strrev(wordwrap(strrev($total['consommation']), 3, ' ', true)); ?>FCFA
                
                </p>
                </div>    
               <?php }  ?>
                </h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>



    <!-- MDB -->
    <script type="text/javascript" src="js/mdb.umd.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
  </body>
</html>
