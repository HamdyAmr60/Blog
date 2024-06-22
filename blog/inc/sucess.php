<?php 
if (isset($_SESSION['sucess'])){?>

<div class="alert alert-success"><?php echo $_SESSION['sucess']; ?></div>


<?php }
unset($_SESSION['sucess'])
?>