<ul>
    <?php foreach ($city as $item): ?>
        <span class="republic selectCity" city-id="<?= $item->id?>"><?= $item->name; ?></span>
    <?php endforeach; ?>
</ul>