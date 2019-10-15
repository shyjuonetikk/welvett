<div style="width: 100%;text-align:center;background-color: #7B1B2D;">
    <img src="<?= 'http://' . $_SERVER['SERVER_NAME'] . '/' . $this->request->webroot . 'img/logo.png' ?>" width="120">
</div>
<h4>Hi <?php echo ucwords($admin->first_name . ' ' . $admin->last_name); ?>,</h4><br/>

<p>
    A new <?php
    if ($content->role_id == 3) {
        echo "Corporate";
    } else {
        echo "talent";
    }
    ?>  (<?php echo ucwords($content->first_name . ' ' . $content->last_name); ?>) have registered successfully, Please review and verfiy the account of this talent by clicking <a href="http://<?= $_SERVER['HTTP_HOST'] . $this->request->webroot; ?>backend">here</a>
    <br/>
    <br/>
    Thanks!<br>
    Welvet
</p>