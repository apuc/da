<?php

/**
 * @var $messengeres array
 * @var $iterator integer
 */
?>

<div class="input-group" data-id="<?= '_' . $iterator ?>">
    <input type="hidden" name="Phones[new_<?= $iterator ?>][id]" value="new_<?= $iterator ?>">
    <input value="" class="form-control" name="Phones[new_<?= $iterator ?>][phone]" type="text">
    <?php if (!empty($messengeres)): ?>
        <div>
            <?php foreach ($messengeres as $id => $name): ?>
                <label class="ckbox ckbox-primary col-md-2">
                    <input type="checkbox" name="Phones[new_<?= $iterator ?>][messengeresArray][]" value="<?= $id ?>">
                    <?= $name ?>
                </label>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <a href="#" class="input-group-addon remove-input-phone" data-iterator="<?= $iterator + 1 ?>">
        <span class="glyphicon glyphicon-minus"></span>
    </a>
</div>
