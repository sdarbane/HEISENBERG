<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>

<?php for_logged(); 
$mon_id = get_session_id();
?>



<div class="jumbotron">
  <h1 class="display-4">Bonjour, <?php echo prenom_m_avec_id_m($mon_id) ; ?> </h1>
  <hr class="my-4"></hr>
  <?php
       $date = strftime("%A %d %B");
    $heure = date("H:i");
		echo "<h3>";
		echo "Nous sommes le <b> $date </b> et il est <b> $heure </b>.	";
		echo "</h3>"
?>
</div>



<div class="card-deck">
  <div class="card">
    
    <div class="card-body">
      <h3 class="card-title">Solde </h3>
      <ul>
      <li class="card-text" style="font-size:20px;">On vous doit : <?php 
      echo '<B>';
      echo creance_moi($mon_id);
      echo '€</B>'
      ?></li>
      <li class="card-text" style="font-size:20px;">Vous devez : <?php 
      echo '<B>';
      echo dette_moi($mon_id);
      echo '€</B>';
      ?></li>
      <li class="card-text" style="font-size:20px;">Solde : <?php 
      echo '<B>';
      echo creance_moi($mon_id)-dette_moi($mon_id);
      echo '€</B>';
      ?></li>
      </ul>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <h3 class="card-title">Transactions</h3>
      <p class="card-text">
      <ul>
      <?php 
      $transactions = liste_transaction($id);
      if (sizeof($transactions) != 0) {
      for ($i = 0; $i < sizeof($transactions); $i++) {
              echo '<li style="font-size:18px;">';
              echo description_t_avec_id_t($transactions[$i]);
              echo " - ";
              echo '<a style="font-size:15px">';
              echo date_t_avec_id_t($transactions[$i]);
              echo '</a>';
              echo " - <B>";
              echo montant_t_avec_id_t($transactions[$i]);
              echo "€</B><br>";
              echo '</li>';
      }
      }
      else 
      {
          echo '<a style="font-size:15px">';
          echo "Pas encore de transaction !";
          echo '</a>';
      }
      ?>
      </ul>
      </p>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <h3 class="card-title">Amis</h3>
      <p class="card-text">
      <h6>
      <?php 
      $amis = liste_amis($id);
      for ($i = 0; $i < sizeof($amis); $i++) {
          echo "<img class='demo-avatar' src='".image_m_avec_id_m($amis[$i])."'>";
          echo fullname_id($amis[$i]);
          echo '<br>';
      }
      if (sizeof($amis) == 0)
      {
          echo "Pas encore d'amis !";
      }
      ?></p>
      </h6>
    </div>
  </div>
</div>
<br>
<br>
  <div class="card">
    
    <div class="card-body">
      <h3 class="card-title">Groupes </h3>
            <p class="card-text"><?php echo afficher_table_groupes($mon_id) ?></p>
    </div>
</div>

<script>
jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});
</script>


<?php include("includes/footer.php"); ?>