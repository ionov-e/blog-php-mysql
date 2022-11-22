<?php
$alertMessage ??= $this->args[1];
?>
<?php if ($alertMessage) : ?>
    <div class="alert alert-warning" role="alert">
        <?= $alertMessage ?>
    </div>
<?php endif; ?>