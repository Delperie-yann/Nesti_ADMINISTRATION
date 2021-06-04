<?php declare(strict_types = 1);
/** @var string $loc */
/** @var string $action */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<?php if (($loc == null) || (!isset($_SESSION["login"]))) {
  $loc = "connection";
}

switch ($loc) {
  case 'connection':
   ?><script src="<?= BASE_URL ?>public/js/recipes.js"></script>   
</script>
 <?php
    break;
  case 'recipes':
    switch ($action) {
        case 'editing':
            ?>
            <script src="<?= BASE_URL ?>public/js/orderScript.js"></script>
            <script src="<?= BASE_URL ?>public/js/recipes.js"></script>
            <script src="<?= BASE_URL ?>public/js/toast-chart.js"></script>
            
            <?php
          break;
       
        default:
        
          break;
      }
    break;
  case 'articles':
    ?>
     <script src="<?= BASE_URL ?>public/js/orderScript.js"></script>
     <?php
    break;
  case 'users':
    switch ($action) {
        case 'editing':
            ?>
            <script src="<?= BASE_URL ?>public/js/orderScript.js"></script>
            <?php
          break;
        case 'creation':
            ?><script src="<?= BASE_URL ?>public/js/addUsers.js"></script>  <?php
          break;
        default:
        
          break;
      }
  
    break;
  case 'statistics':
    ?> 
    <script src="<?= BASE_URL ?>public/js/toast-chart.js"></script>
    <script src="<?= BASE_URL ?>public/js/statsCharts.js"></script>
     <?php
    break;
  case 'deconnection':
    ?>  <?php
    break;
  default:
    echo ("404");
    break;
} ?>






</body>

</html>