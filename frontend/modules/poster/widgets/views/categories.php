<section class="afisha-menu">
    <div class="container">
        <ul>
            <?php foreach ($categories as $category): ?>
                <li><a href=""><?= $category->title;?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>