
<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success text-center mt-5">
        <?= $this->session->flashdata('success'); ?>
    </div>
<?php endif; ?>


<?php if ($this->session->flashdata('success_delete')): ?>
    <div class="alert alert-success text-center mt-5">
        <?= $this->session->flashdata('success_delete'); ?>
    </div>
<?php endif; ?>


<h2 class="text-center mt-5 mb-5"><?= $title ?></h2>
<hr>

 <?php
  foreach ($posts as $post) :
    ?>
    <div class="container text-center">
    <h4 class="display-7 mb-3">Category: <?= $post['category_name'] ?></h4>   
    <p class="font-monospace text-info"><?= $post['title'] ?></p>
    <p><?= word_limiter($post['body'], 50) ?></p>
    <p>Posted on: <?= $post['created_at'] ?></p>
    <small class="text-success">Comments Count: <?= $comments_count[$post['id']] ?? 0 ?></small>
    <p><a class="btn btn-secondary mt-3" href="<?= site_url('/posts/' . $post['slug']) ?>">Read More</a></p>
    <hr>
    </div>
    <?php
  endforeach;
?>
