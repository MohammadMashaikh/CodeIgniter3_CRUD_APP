<div class="container mt-5">
    <h2>Create a New Post</h2>

    <!-- Show validation errors -->
    <?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>

    <?= form_open('posts/create') ?>
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input 
                type="text" 
                name="title" 
                class="form-control" 
                id="title"
                value="<?= set_value('title') ?>" 
            >
        </div>

        <div class="form-floating">
            <textarea 
                class="form-control" 
                name="body" 
                placeholder="Write your Post Body Here" 
                id="body"
            ><?= set_value('body') ?></textarea>
            <label for="body">Body</label>
        </div>

     <select name="category_id" class="form-select mt-3" aria-label="Default select example">
     <option selected>Select a Post Categories</option>
        <?php foreach ($categories as $category) :  ?>
            <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
        <?php endforeach; ?>
    </select>

        <button type="submit" class="btn btn-primary mt-3">Submit</button>
        <?= form_close() ?>
</div>
