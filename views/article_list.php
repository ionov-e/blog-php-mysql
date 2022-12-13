<?php if (!empty($_GET[SEARCH_KEY_NAME])) : ?>
    <div class="d-flex justify-content-center pt-4 mb-5">
        <a href="/" class="btn btn-warning btn-lg">Return back to List</a>
    </div>
<?php endif; ?>

<h1 class="text-center">Articles table</h1>

<h2 class="pt-5 text-center">Articles count: <?= count($this->args) ?></h2>

<div class="row justify-content-end">
    <div class="mw-50" style="width: 400px;">
        <form class="input-group" action="/">
            <input type="text" id="<?= SEARCH_KEY_NAME ?>" name="<?= SEARCH_KEY_NAME ?>" class="form-control rounded"
                   placeholder="Search by title" aria-label="Search"/>
            <button type="submit" class="btn btn-primary rounded">search</button>
        </form>
    </div>
</div>

<table class="table table-hover">
    <thead>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Content</th>
        <th>User ID</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($this->args as $article): ?>
        <tr role="button">
            <td><?= $article[ID_KEY_NAME] ?></td>
            <td><?= $article[TITLE_KEY_NAME] ?></td>
            <td><?= $article[CONTENT_KEY_NAME] ?></td>
            <td><?= $article[USER_ID_KEY_NAME] ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php include_once __DIR__ . "/components/article-create-block.php" ?>

<script>
    const rows = document.querySelectorAll('tr');
    rows.forEach(row => {
        if (row.parentElement.tagName !== 'THEAD') {
            row.addEventListener('click', () => {
                let rowId = row.children[0].innerHTML;
                console.log(window.location.href = "/?<?= ARTICLE_ID_KEY_NAME ?>=" + rowId);
            })
        }
    })
</script>

