<?php $article = $this->args[0] ?>

<h1 class="text-center">Статья №<?= $article[ID_KEY_NAME] ?> (created by user #<?= $article[USER_ID_KEY_NAME] ?>)</h1>

<h2 class="pt-5 text-center"><?= $article[TITLE_KEY_NAME] ?></h2>

<p><?= $article[CONTENT_KEY_NAME] ?></p>