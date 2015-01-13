<script type="text/javascript">
    function checkSubmit1()
    {
        //alert("sdfsdfsf");
        if($('#ProductCommentContentE').val() != "Viết nhận xét tại đây ..." && $('#ProductCommentContentE').val() != "")
        {
            //alert("ok");
            return true;
        }
        else
        {
            alert("Bạn phải để lại nhận xét");
            return false;
        }
        
    }
</script>

<!--SIDEBAR PARAGRAPH-->
			<div id="relate_estate">
			
                            <div id="comments"  class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active">
                                <ul>
                                    <?php
                                    if(!count($product["ProductCommentE"]))
                                    {
                                        echo '<li>Chưa có nhận xét của chuyên gia cho sản phẩm</li>';
                                    }
                                    foreach($product["ProductCommentE"] as $comment) {?>
                                        <li>
                                            <label><?php echo $comment["User"]["username"] ?></label> <span style="color:#ccc">(<?php echo $comment["ProductComment"]["create_date"] ?>)</span>:
                                            <p><?php echo $comment["ProductComment"]["content"] ?></p>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            
                            <?php if($user && $user["expert"]) { ?>
                                <?php echo $this->Form->create('ProductComment', array('action'=>'add', 'onsubmit'=>'return checkSubmit1();'));?>
                                    
                                    <?php
                                            echo $this->Form->input('product_id', array('value'=>$product["Product"]["id"], 'type'=>'hidden'));
					    echo $this->Form->input('expert', array('value'=>'1', 'type'=>'hidden'));                                            
                                    ?>
                                    
                                    <div class="input text fillupform" style="padding-top:10px">                                    
                                        <textarea style="width:300px;height:95px;" class="required" onblur="if(this.innerHTML=='') this.innerHTML='Viết nhận xét tại đây ...'" onfocus="if(this.innerHTML=='Viết nhận xét tại đây ...') this.innerHTML=''" id="ProductCommentContentE" cols="50" rows="3" name="data[ProductComment][content]">Viết nhận xét tại đây ...</textarea>
                                    </div>
                                    <input style="margin:10px 130px" type="submit" value="Gửi nhận xét" />
                                    
                                    
                                    
                                <?php echo $this->Form->end();?>
                            <?php } else { ?>
                                <!--<div style="margin:10px 20px">Phần dành cho chuyên gia đánh giá. Hãy <a href="#?w=409" rel="login" class="poplight">đăng nhập</a> vào tài khoản chuyên gia.</div>-->
                            <?php } ?>
			</div>