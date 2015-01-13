<option value="0">- <?php __('Tên đường'); ?> -</option>
<?php foreach ($streets as $item): ?>
    <option value="<?php echo $item["Street"]["id"] ?>"><?php echo $item["Street"]["name"] ?></option>
<?php endforeach ?>