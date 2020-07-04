<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>

<?php for_logged(); ?>

<?php include("includes/action.php"); 

include("affichage/fonction_affichage.php");?>

<div class="jumbotron">
  <h1 class="display-4">
    <center>
    <?php 
    $image = image_m_avec_id_m($id_ami);
    echo "<img src=$image class='demo-avatar'>";
    echo "\n";
    echo prenom_m_avec_id_m($id_ami);
    echo "\n";
    echo nom_m_avec_id_m($id_ami); 
    ?>
    </center>
  </h1>
</div>

<?php 
  if (isset($_GET['vue'])){
    $vue = $_GET['vue'];
    if ($vue == 1){ ?>
      <div class="card-deck">
        <div class="card">
            <li class="list-group-item"><center>
              Créances remboursées
            </center></li>
            <?php fonction_affichage($mysqli,'rembourse',$id_ami,$mon_id,$vue,1); ?>
        </div>
        <div class="card">
            <li class="list-group-item"><center>
              Dettes remboursées
            </center></li>
            <?php fonction_affichage($mysqli,'rembourse',$mon_id,$id_ami,$vue,0); ?>
        </div>
      </div>
      <?php
      }
      if ($vue == 2){ ?>
      <div class="card-deck">
        <div class="card">
            <li class="list-group-item"><center>
              Créances annulées
            </center></li>
            <?php fonction_affichage($mysqli,'annule',$id_ami,$mon_id,$vue,1); ?>
        </div>
        <div class="card">
            <li class="list-group-item"><center>
              Dettes annulées
            </center></li>
            <?php fonction_affichage($mysqli,'annule',$mon_id,$id_ami,$vue,0); ?>
        </div>
      </div>
  <?php } 
  if ($vue == 3){ ?>
      <div class="card-deck">
        <div class="card">
            <li class="list-group-item"><center>Total des créances : 
            <?php echo creance_ami($mon_id, $id_ami); ?>€
            </center></li>
            <table class="table">
              <?php
              $requete = mysqli_query($mysqli, "SELECT * FROM transactions");
              while ($donnees = mysqli_fetch_assoc($requete)) { ?>
                <tbody>
                <?php 
                if  ($donnees['id_src'] == $id_ami && $donnees['id_dest'] == $mon_id && $donnees['id_groupe'] == NULL){ ?>
                  <tr class="bg-success">
                    <td>
                      <?php 
                        $id_transaction = $donnees['id_t'];
                        echo $donnees['montant_t']; ?> €
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
            <li class="list-group-item"><center>Total des dettes : 
            <?php echo dette_ami($mon_id, $id_ami); ?> €
            </center></li>
            <table class="table">
              <?php
              $requete = mysqli_query($mysqli, "SELECT * FROM transactions");
              while ($donnees = mysqli_fetch_assoc($requete)) { ?>
                <tbody>
                <?php 
                if ($donnees['id_src'] == $mon_id && $donnees['id_dest'] == $id_ami && $donnees['id_groupe'] == NULL) { ?>
                  <tr class="bg-danger">
                    <td>
                      <?php 
                        $id_transaction = $donnees['id_t'];
                        echo $donnees['montant_t']; ?> €
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
  <?php } 
 } 
  if($vue == 0) {?>  
      <div class="card-deck">
        <div class="card">
            <li class="list-group-item"><center>Total des créances : 
            <?php echo creance_ami($mon_id, $id_ami); ?>€
            </center></li>
            <?php fonction_affichage($mysqli,'ouvert',$id_ami,$mon_id,$vue,1); ?>
        </div>
        <div class="card">
            <li class="list-group-item"><center>Total des dettes : 
            <?php 
            echo dette_ami($mon_id, $id_ami);
            ?>€
            </center></li>
            <?php fonction_affichage($mysqli,'ouvert',$mon_id,$id_ami,$vue,0); ?>
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
              affichage_groupe_amis_creance($mysqli,'rembourse',$mon_id,$id_ami,$vue);
              affichage_groupe_amis_dette($mysqli,'rembourse',$id_ami,$mon_id,$vue);
            }elseif($vue==2){
              affichage_groupe_amis_creance($mysqli,'annule',$mon_id,$id_ami,$vue);
              affichage_groupe_amis_dette($mysqli,'annule',$id_ami,$mon_id,$vue);
            }elseif($vue==0){
              affichage_groupe_amis_creance($mysqli,'ouvert',$mon_id,$id_ami,$vue);
              affichage_groupe_amis_dette($mysqli,'ouvert',$id_ami,$mon_id,$vue);
            }else{
              affichage_groupe_amis_creance_toute($mysqli,$mon_id,$id_ami,$vue);
              affichage_groupe_amis_dette_toute($mysqli,$id_ami,$mon_id,$vue);            
            }
            echo "</table>";
            ?>
        </div>
      </div>
<hr>

<?php include("affichage/buton_vue.php"); ?>

<?php include("includes/footer.php"); ?>