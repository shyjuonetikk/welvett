<div style="width: 100%;text-align:center;background-color: #7B1B2D;">
    <img src="<?= 'http://' . $_SERVER['SERVER_NAME'] . '/' . $this->request->webroot . 'img/logo.png' ?>" width="120">
</div>
<h4>Hi <?php echo ucwords($content->first_name . ' ' . $content->last_name); ?>,</h4>
<p>
    Your Welvett account verification code is <b>W-<?php echo $content->verification_code ?></b>
    <br/>
    <br/>
    Thanks!<br/>
    Welvet
</p>