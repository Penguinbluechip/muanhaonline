<?php
$old = array("<p></p>", "{customer_name}", "{link}", "{/link}");
$new = array("", $fixprice_order['FixpriceCustomer']['name'], '<a href="'.$link.'">', '</a>');

$content = str_replace($old, $new, $mail_content['Content']['content']);
echo $content;
?>