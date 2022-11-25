<?php if (!empty($_SESSION[AUTHENTICATED_USER_ID])) : ?>
    <div class="d-flex justify-content-center pt-4">
        <a href="/?<?= NEW_ARTICLE_KEY_NAME ?>=true" class="btn btn-primary btn-lg">Create new article</a>
    </div>
<?php endif; ?>