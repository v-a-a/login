<ul class="<?= $class ?>">
    <?php
    foreach ($sortedMenu as $item) : ?>
        <li><a href="<?= $item['path']; ?>
            " style="<?= (isCurrentUrl($item['path'])) ? 'text-decoration: underline;' : '' ?>
                   "><?= trimString($item['title']); ?></a></li>
    <?php endforeach; ?>
</ul>