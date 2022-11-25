<?php $article = $this->args[0] ?>

<h1 class="text-center">Article #<?= $article[ID_KEY_NAME] ?> (created by user #<?= $article[USER_ID_KEY_NAME] ?>)</h1>

<h2 class="pt-5 text-center"><?= $article[TITLE_KEY_NAME] ?></h2>

<p><?= $article[CONTENT_KEY_NAME] ?></p>

<?php include_once __DIR__ . "/components/back-to-list-block.php" ?>