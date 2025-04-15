

<?php if ($this->session->flashdata('success_comment')): ?>
    <div class="alert alert-success text-center mt-5">
        <?= $this->session->flashdata('success_comment'); ?>
    </div>
<?php endif; ?>

<div class="container text-center mt-5">
    <p class="display-6"><?= $post['title'] ?></p>
    <p><?= $post['body'] ?></p>
    <small>Posted on: <?= $post['created_at'] ?></small>
    <div class="d-flex justify-content-center gap-3">
    <p><a class="btn btn-secondary mt-3" href="<?= site_url('/posts'); ?>">Back</a></p>
    <p><a class="btn btn-warning mt-3" href="<?= site_url('/posts/edit/' . $post['id']); ?>">Edit</a></p>
    <p><a href="<?= site_url('posts/' . $post['id'] . '/delete') ?>" class="btn btn-danger mt-3">Delete</a></p>
    </div>
    </div>
    <hr>


    <div class="accordion container mt-5 mb-5" id="accordionExample">
  <?php foreach ($comments as $index => $comment): ?>
    <div class="accordion-item">
      <h2 class="accordion-header" id="heading<?= $index ?>">
        <button class="accordion-button <?= $index !== 0 ? 'collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $index ?>" aria-expanded="<?= $index === 0 ? 'true' : 'false' ?>" aria-controls="collapse<?= $index ?>">
          <?= htmlspecialchars($comment['name']) ?>
        </button>
      </h2>
      <div id="collapse<?= $index ?>" class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>" aria-labelledby="heading<?= $index ?>" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <strong><?= htmlspecialchars($comment['email']) ?></strong><br>
          <?= nl2br(htmlspecialchars($comment['body'])) ?>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>



    <div class="container mt-5 mb-5">
    <h3 class="text-center mb-3">Add Comment</h3>
    <?= form_open('comments/create/' . $post['id']) ?>
    <div class="form-group">
    <label for="name">Name</label>
    <input id="name" type="text" name="name" class="form-control">
    </div>

    <div class="form-group">
    <label for="email">Email</label>
    <input id="name" type="email" name="email" class="form-control">
    </div>

    <div class="form-group">
    <label for="body">Body</label>
    <textarea name="body" class="form-control" id="body"></textarea>
    </div>
    <input type="hidden" name="slug" value="<?= $post['slug'] ?>">
    <button type="submit" class="btn btn-secondary mt-3">Submit</button>
    </div>

    <?= form_close() ?>