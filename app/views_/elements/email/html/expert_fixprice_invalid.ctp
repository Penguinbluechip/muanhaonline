<?php
$old = array("<p></p>", "{name}", "{link}", "{/link}", "{product}");
$new = array("", $fixprice_order['Expert']['username'], '<a href="'.$link.'">', '</a>', $fixprice_order['Product']['name']);

$content = str_replace($old, $new, $mail_content['Content']['content']);
echo $content;
?>
