<?php require_once 'inc/connection.php' ?>
<?php require_once 'inc/header.php' ?>
<?php 
if (isset($_SESSION['lang'])) {
  $lang = $_SESSION['lang'];
}else {
  $lang = "en";
}

if ($lang == "ar"){
  require_once "inc/ar.php";
}else{
  require_once "inc/en.php";
}

?>

    <!-- Page Content -->
    <div class="page-heading products-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4><?php echo $ar['NEW POST']?></h4>
              <h2><?php echo $ar['ADD NEW PERSONAL POST']?></h2>
            </div>
          </div>
        </div>
      </div>
    </div>

    
<div class="container w-50 ">
  <?php require_once 'inc/error.php' ?>
  <div class="d-flex justify-content-center">
    <h3 class="my-5"><?php echo $ar['NEW POST']?></h3>
  </div>
  <form method="POST" action="handle/store.php" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="title" class="form-label"><?php echo $ar['Title']?></label>
        <input type="text" class="form-control" id="title" name="title" value="">
    </div>
    <div class="mb-3">
        <label for="body" class="form-label"><?php echo $ar['Body']?></label>
        <textarea class="form-control" id="body" name="body" rows="5"></textarea>
    </div>
    <div class="mb-3">
        <label for="body" class="form-label"><?php echo $ar['image']?></label>
        <input type="file" class="form-control-file" id="image" name="image" >
    </div>
    <button type="submit" class="btn btn-primary" name="submit"><?php echo $ar['submit']?></button>
  </form>
</div>

    <?php require_once 'inc/footer.php' ?>
