
<?php require_once 'inc/connection.php' ?>
<?php require_once 'inc/header.php' ?>
    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="banner header-text">
      <div class="owl-banner owl-carousel">
        <div class="banner-item-01">
          <div class="text-content">
            <!-- <h4>Best Offer</h4> -->
            <!-- <h2>New Arrivals On Sale</h2> -->
          </div>
        </div>
        <div class="banner-item-02">
          <div class="text-content">
            <!-- <h4>Flash Deals</h4> -->
            <!-- <h2>Get your best products</h2> -->
          </div>
        </div>
        <div class="banner-item-03">
          <div class="text-content">
            <!-- <h4>Last Minute</h4> -->
            <!-- <h2>Grab last minute deals</h2> -->
          </div>
        </div>
      </div>
    </div>
    <!-- Banner Ends Here -->
<?php



 
if (isset($_GET['page'])){
  $page = $_GET['page'];
}else{
  $page = 1; 
}
$limit = 2;
$offset = ($page-1) * $limit;
$query = "SELECT id,image , title ,substring(body , 1 , 80) as body , date(created_at) as created_at FROM posts order by id limit $limit offset $offset";

$runQuery = mysqli_query($conn , $query);

if(mysqli_num_rows($runQuery)>0){
  $posts = mysqli_fetch_all($runQuery , MYSQLI_ASSOC);
}else{
  echo $msg= "no posts founded";
}




$queryCount = "select count(`id`) as total from posts ";

$runQuery= mysqli_query($conn , $queryCount);
$total = mysqli_fetch_assoc($runQuery)['total'];
$numberOfPage = ceil($total / $limit);

if ($_GET['page'] > $numberOfPage || !isset($_GET['page'])){
 header("location: index.php?page=1");
}

?>

<?php 
if (!empty($posts)):
?>
<?php if (!isset($_SESSION["errors"])) : ?>

    <div class="latest-products">
      <div class="container">
      <?php require_once 'inc/sucess.php';?>
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Latest Posts</h2>
              <!-- <a href="products.html">view all products <i class="fa fa-angle-right"></i></a> -->
            </div>
          </div>

          <?php 
          foreach($posts as $post) :
          ?>
          <div class="col-md-4">
            <div class="product-item">
              <a href="#"><img src="uploads/<?php echo $post['image'];?>" alt=""></a>
              <div class="down-content">
                <a href="#"><h4><?php echo $post['title']; ?></h4></a>
                <h6><?php echo $post['created_at']; ?></h6>
                <p><?php echo $post['body'] . "...."; ?></p>
                <!-- <ul class="stars">
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                </ul>
                <span>Reviews (24)</span> -->
                <div class="d-flex justify-content-end">
                  <a href="viewPost.php?id= <?php echo $post["id"]; ?>" class="btn btn-info "> view</a>
                </div>
                
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <nav aria-label="Page navigation example">
  <ul class="pagination d-flex justify-content-center">
    <li class="page-item <?php if ($page == 1) echo "disabled"?>"><a class="page-link" href="index.php?page=<?php echo $page -1 ?>">Previous</a></li>
    <li class="page-item"><a class="page-link" href="#"><?php echo $page?></a></li>
    <li class="page-item <?php if ($page == $numberOfPage) echo "disabled" ?>"><a class="page-link" href="index.php?page=<?php echo $page + 1 ?>">Next</a></li>
  </ul>
</nav>
    </div>

<?php 
else :
    echo $_SESSION["errors"][0]; 
    unset($_SESSION["errors"]);
endif;
?>
<?php 
else:
   echo $msg;
endif;
?>

 
    
<?php require_once 'inc/footer.php' ?>
