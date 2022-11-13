<div name = "a" value = "a" class = "a">
<?php require APPROOT . '/views/inc/header.php'; ?>
</div>
<div name = "index">
  <div class="row mb-3">
    <div class="col-md-6">
  <br><br>
      <h1>Admin Panel</h1>
      <br>
      <div class="form-outline">
 <form class="form-inline">
		    <!-- <div class="input-group"> -->
		      <div class="input-group-prepend">
		        <button class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i>&nbsp</button>
		      </div>
      <input name="find" value="<?=isset($_GET['find'])?$_GET['find']:'';?>" type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1">
		    <!-- </div> -->
		  </form>
    <label class="form-label" for="form1"></label>
  </div>
  <div id="filters" class = "filter" >
    <select name = "fetchval" id= "fetchval">
      <option value = "" disabled ="" selected= "">Select Filter</option>
      <option value = "">Dishes</option>
      <option>Drinks</option>
      <option>Sandwhiches</option>
</select>
</div>





    </div>

    
    <div class="col-md-6">
      <a href="<?php echo URLROOT; ?>/menus/add" class="btn btn-primary pull-right">
        <i class="button"></i> Add Item
      </a>
    </div>
  </div>

  <script type = "text/javascript">
    $(document).ready(function()){
      $("#fetchval").on('change',function()){
        var value = $(this).val();
        alert(value);
      }
    }
  </script>

  <?php foreach($data['menus'] as $menu) : ?>
  
 <php?
    $query = "SELECT * FROM menu";
    $r= mysqli_query($con,$query);
    while($row = mysqli_fetch_assoc($r)){

    ?>


    <div class=".bg-success.bg-gradient card-header mb-3">
      <h4 class="card-title"><?php echo $menu->title; ?></h4>
      <h4 class="card-title"><?php echo $menu->price; ?></h4>
      <div class="p-2 mb-3">
        Added by <?php echo $menu->name; ?> on <?php echo $menu->postCreated; ?>
      </div>
      <p class="card-text"><?php echo $menu->description; ?></p>
      <a href="<?php echo URLROOT; ?>/menus/show/<?php echo $menu->postId; ?>" class="btn btn-dark">More</a>
    </div>
  <?php endforeach; ?>
  
<?php require APPROOT . '/views/inc/footer.php'; ?>
