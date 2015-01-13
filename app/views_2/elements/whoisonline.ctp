<?php
$result = $this->requestAction('users/onlines/');
//$everybodyhere = implode(', ',$result["onlineusers"]);
//echo $everybodyhere;
//echo "-".$result["count"]["user"]."-";
?>

<div class="video clear" style="margin-top:10px">
				<h3>Trực tuyến</h3>
				<ul>
								<li>
												Hiện đang có <strong><?php echo $result['guest'] ?></strong> khách và <strong><?php echo $result["user"] ?></strong> thành viên.
								</li>
								<li>
												Tổng lượt truy cập: <strong><?php echo $result['total']+1268 ?></strong>.
								</li>
				</ul>
</div>