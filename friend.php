<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>

<?php 
	for_logged(); 
	include("includes/action.php");
?>

<div class="jumbotron">
  <h1 class="display-4"><center>Ma liste d'amis</center></h1>
</div>

<table width=100% class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
  <thead>
    <tr>
      <th class="mdl-data-table__cell--non-numeric"></th>
      <th class="mdl-data-table__cell--non-numeric">Nom</th>
      <th class="mdl-data-table__cell--non-numeric">Prénom</th>
      <th class="mdl-data-table__cell--non-numeric">Balance</th>
      <th class="mdl-data-table__cell--non-numeric"></th>
    </tr>
  </thead>
  <tbody>
	<?php $amis = liste_amis($id); ?>
  	<?php for ($i=0; $i <sizeof($amis) ; $i++): ?>
	<?php $ami = $amis[$i]; ?>
    	  <tr class='clickable-row' data-href="my_friend.php?id_ami=<?php echo $ami;?>" >
		  <td class="mdl-data-table__cell--non-numeric"  >	  	
		  	<img src="<?php echo image_m_avec_id_m($ami); ?>" class='demo-avatar'>
		  </td>
		  <td class="mdl-data-table__cell--non-numeric">
		  	<?php echo nom_m_avec_id_m($ami); ?>
		  </td>
		  <td class="mdl-data-table__cell--non-numeric">
		  	<?php echo prenom_m_avec_id_m($ami); ?>
		  </td>
		  <td class="mdl-data-table__cell--non-numeric">
		  	<?php echo balance_ami($id, $ami);
		  	echo "\n";
		  	$balance = balance_ami($id, $ami);
		  	if ($balance==0){
		  		echo '<img src="images/equal.svg" height=60% />';
		  	}
		  	if ($balance>0){
		  		echo '<img src="images/upload.svg" height=60% />';
		  	}
		  	if ($balance<0){
		  		echo '<img src="images/download.svg" height=60% />';
		  	}?>
		  </td>
		  <td class="mdl-data-table__cell--non-numeric">      	
		  	<?php 
		  	echo "<a href=\"friend.php?id_ami=$ami&amp;action=5\">";
		  	echo '<img src="images/delete-button.svg" height=60%></a>';
		  	echo "</a>";?>
		  </td>
  	  <?php endfor; ?>
    </tr>
  </tbody>
</table>

<script>
jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});
</script>

<?php include("includes/footer.php"); ?>