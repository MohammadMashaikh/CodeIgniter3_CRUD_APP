<div class="container mt-5">
    <h2>Edit Post <?= $title ?></h2>

    <!-- Show validation errors -->
    <?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>

    <?= form_open('posts/' . $id . '/update') ?>
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input 
                type="text" 
                name="title" 
                class="form-control" 
                id="title"
                value="<?= set_value('title', $title) ?>" 
            >
        </div>

        <div class="form-floating mb-3">
            <textarea 
                class="form-control" 
                name="body" 
                placeholder="Write your Post Body Here" 
                id="body"
            ><?= set_value('body', $body) ?></textarea>
            <label for="body">Body</label>
        </div>

    <select name="category_id" class="form-select">
    <?php foreach ($categories as $category): ?>
        <option value="<?= $category['id'] ?>" 
            <?= $category['id'] == $category_id ? 'selected' : '' ?>>
            <?= $category['name'] ?>
        </option>
    <?php endforeach; ?>
    </select>
    
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
        <?= form_close() ?>
    <a class="btn btn-outline-info underline-none" href="<?= site_url('posts/' .$slug) ?>">Cancel</a>
</div>
