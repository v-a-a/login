<ul class="<?= $class ?>">
    <?php
    foreach ($_SESSION['user'] as $item) : ?>
        <li>
            <p><?= $item; ?></p>
        </li>
    <?php endforeach; ?>
</ul>