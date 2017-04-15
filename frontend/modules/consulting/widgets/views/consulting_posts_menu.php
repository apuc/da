<?php ; ?>
<aside id="aside-consultations">
    <div class="accordion-menu">
        <ul>
            <?php foreach ($sections as $section => $categories): ?>
                <li><a class="section <?= $categories['active'];?>" href="<?= $categories['url']; ?>"><?= $section; ?></a>
                    <?= $categories['content']; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</aside>