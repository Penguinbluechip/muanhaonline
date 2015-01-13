<div id="checkout_line">
    <?php if($this->params['action'] == 'add_step1') { ?>
        <a class="active" href="<?php echo $this->Html->url(array('controller'=>'fixprice_orders', 'action'=>'add_step1')) ?>">B1. Thông tin khách hàng</a>
        <a href="#">B2. Mô tả BĐS</a>
        <a href="#">B3. Xem trước - Thanh toán</a>
        <a href="#" style="margin-right: 0">Kết thúc</a>
    <?php } else  if($this->params['action'] == 'add_step2') { ?>
        <a class="active" href="<?php echo $this->Html->url(array('controller'=>'fixprice_orders', 'action'=>'add_step1')) ?>">B1. Thông tin khách hàng</a>
        <a class="active" href="<?php echo $this->Html->url(array('controller'=>'fixprice_orders', 'action'=>'add_step2')) ?>">B2. Mô tả BĐS</a>
        <a href="#">B3. Xem trước - Thanh toán</a>
        <a href="#" style="margin-right: 0">Kết thúc</a>

    <?php } else  if($this->params['action'] == 'add_step3') { ?>
        <a class="active" href="<?php echo $this->Html->url(array('controller'=>'fixprice_orders', 'action'=>'add_step1')) ?>">B1. Thông tin khách hàng</a>
        <a class="active" href="#">B2. Mô tả BĐS</a>
        <a class="active" href="#">B3. Xem trước - Thanh toán</a>
        <a href="#" style="margin-right: 0">Kết thúc</a>

    <?php } else  if($this->params['action'] == 'add_paylater' || $this->params['action'] == 'update_order_nl' || $this->params['action'] == 'order_result') { ?>
        <a class="active" href="#">B1. Thông tin khách hàng</a>
        <a class="active" href="#">B2. Mô tả BĐS</a>
        <a class="active" href="#">B3. Xem trước - Thanh toán</a>
        <a style="margin-right: 0" class="active" href="#">Kết thúc</a>
    <?php } ?>    
</div>