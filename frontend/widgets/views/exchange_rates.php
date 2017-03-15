<?php
/**
 * @var $key_value array
 */
?>
<div class="currency-panel">
    <div class="item">
        <span class="currency-pic">$</span>
        <span class="currency"><?= $key_value['exchange_dol']; ?></span>
    </div>
    <div class="item">
        <span class="currency-pic">€</span>
        <span class="currency"><?= $key_value['exchange_euro']; ?></span>
    </div>
    <div class="item">
        <span class="currency-pic"> ₴ </span>
        <span class="currency"><?= $key_value['exchange_grn']; ?></span>
    </div>
</div>