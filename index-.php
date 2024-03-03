<?php
 session_start();
$login=$_SESSION['login'];
if(empty($login)){
    header('Location:login.php');
}
include('function_connexion.php');
$sql=$conn->query("SELECT * FROM tb_consommation WHERE login = '$login' ORDER BY annee ASC ");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consommation</title>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css
">
</head>
<body>
    

<div class="jumbotron">
<div class="row w-100">
<?php while($resultat=$sql->fetch()){ ?> 
        <div class="col-md-3">
        <div class="text-default text-center mt-3"><h4>Famille d </h4></div>
            <div class="card border-warning mx-sm-1 p-3">
                <div class="card border-default shadow text-default p-3 my-card" ><span class="fa fa-inbox" aria-hidden="true"></span>
                <?php  
                    echo  $annee=$resultat['periode'];
                   echo '<br>';
                    echo  $annee=$resultat['annee'];
                ?> 
                 </div>
                <div class="text-default text-center mt-3"><h4><?php echo $resultat['famille'] ?> </h4></div>
                <div class="text-primary text-center mt-2"><h1><?php echo strrev(wordwrap(strrev($resultat['consommation']), 3, ' ', true));?> </h1></div>
            </div>
            <hr/>
            
        </div>

        <?php } ?> 
     </div>
  <?php
  
    $sqlannee=$conn->query("SELECT DISTINCT(annee) FROM tb_consommation WHERE login = '$login' ORDER BY annee ASC");
    while($res=$sqlannee->fetch()){
   echo '<br>';
   echo $annee=$res['annee']. ' : ' ;
   $sqlsomme=$conn->query("SELECT SUM(consommation) AS consommation FROM tb_consommation WHERE login = '$login' AND annee='$annee'");
   while($result=$sqlsomme->fetch()){
    echo strrev(wordwrap(strrev($result['consommation']), 3, ' ', true));
   }

   echo '<br>';

  }
  ?>

</div>
</body>
</html>

