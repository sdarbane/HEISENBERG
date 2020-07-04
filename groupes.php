<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>

<?php for_logged(); ?>



<?php

if(isset($_GET['id_g']) && id_in_group($id,$_GET['id_g'])){
   
    $id_g = $_GET['id_g'];
    $group = groupe_avec_id_g($id_g);
    

    if (isset($_GET['action'])) {
        
        if ($_GET['action'] == "edit")
            include("groupes/groupe_modifier_depense.php");
        else if($_GET['action'] == "ajouter_participant")
        include("groupes/groupe_ajouter_participant.php");
  
    }
    else{
        include("groupes/groupe_depenses.php");
    }

}else{
    include("groupes/groupes.php");
}

?>





<script>
jQuery(document).ready(function($) {
    $(".clickable-row").click(function() { 
        window.location = $(this).data("href");
    });
});
</script>


<?php include("includes/footer.php"); ?>