<?php

/**
 * @var $messengers array
 * @var $iterator integer
 */
?>
<div class="cabinet__add-company-form--hover-elements">
    <p class="cabinet__add-company-form--title"></p>
    <div class="input-group" data-id="<?= '_' . $iterator ?>">
        <input type="hidden" name="Phones[new_<?= $iterator ?>][id]" value="new_<?= $iterator ?>">
        <input type="text" class="form-control" name="Phones[new_<?= $iterator ?>][phone]">
        <a href="#" class="cabinet__remove-pkg company__remove-phone"></a>
        <?php if (!empty($messengers)): ?>
            <div>
                <?php foreach ($messengers as $id => $name): ?>
                    <label class="ckbox col-md-3">
                        <input type="checkbox" name="Phones[new_<?= $iterator ?>][messengeresArray][]"
                               value="<?= $id ?>">
                        <?= $name ?>
                    </label>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <p class="cabinet__add-company-form--notice"></p>
    </div>
</div>


