
<?foreach ($model as $item):?>
    <div class="checkbox">
        <label><input type="checkbox" name="services[][services_id]" value="<?=  $item['id']?>"><?= $item['name']?></label>
    </div>
<?endforeach;?>