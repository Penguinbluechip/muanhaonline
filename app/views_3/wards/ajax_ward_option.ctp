<option value="0">- <?php __('Phường/Xã'); ?> -</option>
<?php foreach ($wards as $item): ?>
    <option value="<?php echo $item["Ward"]["id"] ?>"><?php echo $item["Ward"]["name"] ?></option>
<?php endforeach ?>