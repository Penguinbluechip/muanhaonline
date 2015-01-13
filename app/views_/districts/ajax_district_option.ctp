<option value="0">- <?php __('Quận/Huyện'); ?> -</option>
<?php foreach ($districts as $item): ?>
    <option value="<?php echo $item["District"]["id"] ?>"><?php echo $item["District"]["name"] ?></option>
<?php endforeach ?>