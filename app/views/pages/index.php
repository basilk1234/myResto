<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="text-center" name = "title" value = "title"> 
    <h1 class="display-3"><?php echo $data['title']; ?></h1>
</div>
<div class="text-center">
    <p class="lead"><?php echo $data['description']; ?></p>
    </div>

    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
<?php require APPROOT . '/views/inc/footer.php'; ?>
