<?php
$old = array("<p></p>", "{name}", "{link}", "{/link}", "{product_name}");
$new = array("", $expert['Expert']['username'], '<a href="'.$link.'">', '</a>', $fixprice_order['Product']['name']);

$content = str_replace($old, $new, $mail_content['Content']['content']);
echo $content;
?>