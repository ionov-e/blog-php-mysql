<h1 class="text-center">Create article</h1>

<form action="" method="post">

    <input type="hidden" name="<?= NEW_ARTICLE_KEY_NAME ?>" value="true">

    <div class="row">
        <div class="col">
            <label class="form-label" for="<?= TITLE_KEY_NAME ?>">Title</label>
            <input name="<?= TITLE_KEY_NAME ?>" id="<?= TITLE_KEY_NAME ?>" placeholder="Most original title"
                   type="text" maxlength="60" class="form-control" required>
            <div class="invalid-feedback">No more than 60 symbols</div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col">
            <label class="form-label" for="<?= CONTENT_KEY_NAME ?>">Content</label>
            <textarea name="<?= CONTENT_KEY_NAME ?>" id="<?= CONTENT_KEY_NAME ?>" placeholder="Most talented content"
                      rows="5" class="form-control" required></textarea>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <button type="submit" name="submit" class="btn btn-primary btn-lg m-4">Submit</button>
    </div>

</form>

<?php include_once __DIR__ . "/components/back-to-list-block.php" ?>