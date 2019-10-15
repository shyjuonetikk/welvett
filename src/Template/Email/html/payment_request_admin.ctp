<div style="width: 100%;text-align:center;background-color: #7B1B2D;">
    <img src="<?= 'http://' . $_SERVER['SERVER_NAME'] . '/' . $this->request->webroot . 'img/logo.png' ?>" width="120">
</div>
<h4>Hi <?php echo ucwords($admin->first_name . ' ' . $admin->last_name); ?>,</h4><br/>

<p>
    <?php echo ucwords($talent['first_name'] . ' ' . $talent['last_name']).' has been requested for the payment to '.ucwords($customer['first_name'] . ' ' . $customer['last_name']); ?>
    <br/>
    <br/>
    Thanks!<br>
    Welvet
</p>