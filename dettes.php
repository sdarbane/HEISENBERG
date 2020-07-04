<?php 
include("includes/header.php"); 
include("includes/navbar.php"); 
include("includes/action.php"); 
include("affichage/fonction_affichage.php");
?>

<div class="jumbotron">
  <h1 class="display-4">
    <center>Mes dettes et créances</center>
  </h1>
</div>
<?php 
    if (isset($_GET['vue'])){
      $vue = $_GET['vue'];
    }else{
      $vue = 0;
    }
    if ($vue == 1){
      ?>
      <div class="card-deck">
        <div class="card">
            <li class="list-group-item"><center>Total de mes créances : 
            <?php  echo creance_moi($mon_id); ?>€
            </center></li>
            <?php affichage_creance($mysqli,'rembourse',$mon_id,$vue); ?>
        </div>
        <div class="card">
            <li class="list-group-item"><center>Total de mes dettes : 
            <?php echo dette_moi($mon_id); ?>€
            </center></li>
            <?php affichage_dette($mysqli,'rembourse',$mon_id,$vue); ?>
        </div>
      </div>
<?php } if ($vue == 2){ ?>
      <div class="card-deck">
        <div class="card">
            <li class="list-group-item"><center>Total de mes créances : 
            <?php echo creance_moi($mon_id); ?>€
            </center></li>
            <?php affichage_creance($mysqli,'annule',$mon_id,$vue); ?>
        </div>
        <div class="card">
            <li class="list-group-item"><center>Total de mes dettes : 
            <?php echo dette_moi($mon_id); ?>€
            </center></li>
            <?php affichage_dette($mysqli,'annule',$mon_id,$vue); ?>
        </div>
      </div>
<?php } if ($vue == 3){ ?>
      <div class="card-deck">
        <div class="card">
            <li class="list-group-item"><center>Total de mes créances : 
            <?php echo creance_moi($mon_id); ?>€
            </center></li>
            <table class="table">
              <?php
              $requete = mysqli_query($mysqli, "SELECT * FROM transactions");
              while ($donnees = mysqli_fetch_assoc($requete)){ ?>
                <tbody>
                <?php 
                if($donnees['id_dest'] == $mon_id && $donnees['id_groupe'] == NULL){ ?>
                  <tr class="bg-success">
                    <td>
                      <?php echo $donnees['montant_t']; ?> €
                    </td>
                    <td>
                      <?php
                        $id_transaction = $donnees['id_t'];
                        $id_ami=$donnees['id_src'];
                        echo nom_m_avec_id_m($donnees['id_src']);
                        echo "\n";
                        echo prenom_m_avec_id_m($donnees['id_src']);
                      ?>
                    </td>
                    <td>
                      <?php echo $donnees['description_t']; ?>
                    </td>
                    <td>
                      <?php echo $donnees['date_t']; ?>
                    </td>
                    <td>
                      <?php include("affichage/statut_transaction.php"); ?>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              <?php } ?>
            </table>
        </div>
        <div class="card">
            <li class="list-group-item"><center>Total de mes dettes : 
            <?php echo dette_moi($mon_id); ?>€
            </center></li>
            <table class="table">
              <?php
              $requete = mysqli_query($mysqli, "SELECT * FROM transactions");
              while ($donnees = mysqli_fetch_assoc($requete)){?>
                <tbody>
                <?php if($donnees['id_src'] == $mon_id && $donnees['id_groupe'] == NULL) { ?>
                  <tr class="bg-danger">
                    <td>
                      <?php echo $donnees['montant_t']; ?> €
                    </td>
                    <td>
                      <?php 
                        $id_transaction = $donnees['id_t'];
                        $id_ami=$donnees['id_dest'];
                        echo nom_m_avec_id_m($donnees['id_dest']);
                        echo "\n";
                        echo prenom_m_avec_id_m($donnees['id_dest']); ?>
                    </td>
                    <td>
                      <?php echo $donnees['description_t']; ?>
                    </td>
                    <td>
                      <?php echo $donnees['date_t']; ?>
                    </td>
                    <td>
                      <?php include("affichage/statut_transaction.php"); ?>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              <?php } ?>
            </table>
        </div>
      </div>
<?php } if($vue == 0){ ?>
      <div class="card-deck">
        <div class="card">
            <li class="list-group-item"><center>Total de mes créances : 
            <?php echo creance_moi($mon_id); ?>€
            </center></li>
            <?php affichage_creance($mysqli,'ouvert',$mon_id,$vue); ?>
        </div>
        <div class="card">
            <li class="list-group-item"><center>Total de mes dettes : 
            <?php echo dette_moi($mon_id); ?>€
            </center></li>
            <?php affichage_dette($mysqli,'ouvert',$mon_id,$vue); ?>
        </div>
      </div>
<?php } ?>
<br>
      <div class="card-deck">
        <div class="card">
            <li class="list-group-item"><center>
              Dépenses de groupes
            </center></li>
            <?php 
            echo "<table class=\"table\">";
            if($vue==1){
              affichage_groupe_creance($mysqli,'rembourse',$mon_id,$vue);
              affichage_groupe_dette($mysqli,'rembourse',$mon_id,$vue);
            }elseif($vue==2){
              affichage_groupe_creance($mysqli,'annule',$mon_id,$vue);
              affichage_groupe_dette($mysqli,'annule',$mon_id,$vue);
            }elseif($vue==0){
              affichage_groupe_creance($mysqli,'ouvert',$mon_id,$vue);
              affichage_groupe_dette($mysqli,'ouvert',$mon_id,$vue);
            }else{
              affichage_groupe_creance_toute($mysqli,$mon_id,$vue);
              affichage_groupe_dette_toute($mysqli,$mon_id,$vue);            
            }
            echo "</table>";
            ?>
        </div>
      </div>
<hr>
<?php include("affichage/buton_vue_dette.php"); ?>

<?php include("includes/footer.php"); ?>