<?php $article = $this->args[0] ?>

<h1 class="text-center">Article #<?= $article[ID_KEY_NAME] ?> (created by user #<?= $article[USER_ID_KEY_NAME] ?>)</h1>

<h2 class="pt-5 text-center"><?= $article[TITLE_KEY_NAME] ?></h2>

<p><?= $article[CONTENT_KEY_NAME] ?></p>

<div class="d-flex justify-content-center">
    <a href="/" class="btn btn-primary btn-lg">Back to article list</a>
</div>