<option value="0">- <?php __('Dự án'); ?> -</option>
<?php foreach ($projects as $item): ?>
    <option value="<?php echo $item["Project"]["id"] ?>"><?php echo $item["Project"]["name"] ?></option>
<?php endforeach ?>