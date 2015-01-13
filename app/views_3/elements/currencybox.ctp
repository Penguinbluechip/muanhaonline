<form style="float:right; margin-right:20px;" method="post" action="<?php echo $this->Html->url(array('controller'=>'currencies', 'action'=>'changeCurrency')) ?>" id="currency_box">
            <input name="data[Currency][id]" type="hidden" value="1" id="CurrencyId" />
            <input name="data[Currency][url]" type="hidden" value="<?php echo $this->here; ?>"/>
	    <a href="#" <?php if($this->Session->read('currency_id') == 2) echo 'style="font-weight:bold;color: #F7B375"'; ?> onclick="$('#CurrencyId').attr('value', '2');$('#currency_box').submit()">VNĐ</a>
            <a href="#" <?php if($this->Session->read('currency_id') == 1) echo 'style="font-weight:bold;color: #F7B375"'; ?> onclick="$('#CurrencyId').attr('value', '1');$('#currency_box').submit()">USD</a>
            <a href="#" <?php if($this->Session->read('currency_id') == 3) echo 'style="font-weight:bold;color: #F7B375"'; ?> onclick="$('#CurrencyId').attr('value', '3');$('#currency_box').submit()">SJC</a>
</form>