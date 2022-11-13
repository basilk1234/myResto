<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<br>
<h1><?php echo $data['menu']->title; ?></h1>
<div class="bg-secondary text-white p-2 mb-3">
  Added by <?php echo $data['user']->name; ?> on <?php echo $data['menu']->created_at; ?>
</div>
<p><?php echo $data['menu']->description; ?></p>

<?php if($data['menu']->user_id == $_SESSION['user_id']) : ?>
  <hr>
  <a href="<?php echo URLROOT; ?>/menus/edit/<?php echo $data['menu']->id; ?>" class="btn btn-dark">Edit</a>

  <form class="pull-right" action="<?php echo URLROOT; ?>/menus/delete/<?php echo $data['menu']->id; ?>" method="post">
    <input type="submit" value="Delete" class="btn btn-danger">
  </form>
<?php endif; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>