<?php foreach ($categories as $item): ?>
    <option value="<?php echo $item["Category"]["id"] ?>"><?php echo $item["Category"]["name"] ?></option>
<?php endforeach ?>

<script type="text/javascript">
    ajaxFilterUtility(<?php echo $categories[0]["Category"]["id"] ?>)
</script>