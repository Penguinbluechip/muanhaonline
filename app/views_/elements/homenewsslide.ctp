<?php $newses = $this->requestAction('contents/getHomeNewses'); ?>     
<div class="homenewsslide">
    <label>Tin tức mới:</label>
    <ul id="slidernews">
        <?php foreach($newses as $key => $news) {?>
	    <li>
                <a href="<?php echo $this->Html->url($news["Content"]["link"]) ?>">
                    <?php echo $news["Content"]["name"] ?></a>
                    <span class="small_date">(<?php echo $news["Content"]["create_date"] ?>)</span>
	    </li>
	<?php } ?>     
    
    </ul>
</div>