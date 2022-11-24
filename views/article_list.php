<h1 class="text-center">Articles table</h1>

<h2 class="pt-5 text-center">Articles count: <?= count($this->args) ?></h2>

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

