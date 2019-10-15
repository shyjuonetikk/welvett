<div style="width: 100%;text-align:center;background-color: #7B1B2D;">
    <img src="<?= 'http://' . $_SERVER['SERVER_NAME'] . '/' . $this->request->webroot . 'img/logo.png' ?>" width="120">
</div>
<h4>Hi <?php echo ucwords($content->first_name . ' ' . $content->last_name); ?>,</h4><br/>
<p>
    Your Welvet account has been approved. You can now login to your account by clicking 
    <a href="http://<?= $_SERVER['HTTP_HOST'] . $this->request->webroot; ?>">here</a>.
    <br/>
    <br/>
    After login you will be able to set your booking price and start earning :)
    <br/>
    <br/>
    Thanks!<br/>
    Welvet
</p>
