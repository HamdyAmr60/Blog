<?php require_once 'inc/connection.php' ?>
<?php require_once 'inc/header.php' ?>

    <!-- Page Content -->
    <div class="page-heading products-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>view Post</h4>
              <h2>view new personal post</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php 
$id=$_GET['id'];
if(isset($id)){
$query = "SELECT users.name , posts.* FROM posts join users
  on users.id = posts.user_id
 WHERE posts.id = $id";
} else {

  $_SESSION["errors"]=["no posts found"];
  header("location: index.php");
}
$runQuery = mysqli_query($conn , $query);

if (mysqli_num_rows($runQuery)==1) {
  $post = mysqli_fetch_assoc($runQuery);
}else{
  $_SESSION["errors"]=["no posts found"];
  header("location: index.php");
}
?>

    <div class="best-features about-features">
      <div class="container">

      <?php if (isset($_SESSION['errors'])){ ?>
        <div class="alert alert-danger"><?php echo $_SESSION["errors"]; ?></div>

        <?php }
        unset($_SESSION['errors']);
        ?>
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Our details</h2>
            </div>
          </div>

          <div class="col-md-6">
            <div class="right-image">
              <img src="uploads/<?php echo $post["image"]; ?>" alt="">
            </div>
          </div>
          <div class="col-md-6">
            <div class="left-content">
              <h4><?php echo $post["title"]; ?></h4>
              <h4><?php echo $post["name"]; ?></h4>
              <p><?php echo $post["body"]; ?></p>
              <?php  if (isset($_SESSION['id'])) :?>
              <div class="d-flex justify-content-center">
                  <a href="editPost.php?id=<?php echo $post["id"];?>" class="btn btn-success mr-3 "> edit post</a>
                    <form action="handle/delete.php?id=<?php echo $post["id"];?>" method="post">
                      <button type="submit" name="submit" class="btn btn-danger" onclick="alert('are you sure')">delete</button>
                    </form>
                    <?php endif;?>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>




    <?php require_once 'inc/footer.php' ?>
