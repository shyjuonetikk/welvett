<div style="width: 100%;text-align:center;background-color: #7B1B2D;">
    <img src="<?= 'http://' . $_SERVER['SERVER_NAME'] . '/' . $this->request->webroot . 'img/logo.png' ?>" width="120">
</div>
<?php
if (isset($content['role_id'])) {
    if ($content['role_id'] == 2 || $content['role_id'] == 3) {
        ?>
        <h4>Hi <?php echo ucwords($content['first_name'] . ' ' . $content['last_name']); ?>,</h4><br/>

        <p>
            You have released amount to <?php echo ucwords($talent['first_name'] . ' ' . $talent['last_name']); ?><br/>
            <br/><br/>
            Thanks!<br/>
            Welvet
        </p>
    <?php } ?>
    <?php if ($content['role_id'] == 4) { ?>
        <h4>Hi <?php echo ucwords($content['first_name'] . ' ' . $content['last_name']); ?>,</h4><br/>

        <p>
            The Amount is released by <?php echo ucwords($customer['first_name'] . ' ' . $customer['last_name']); ?><br/>
            <br/><br/>
            Thanks!<br/>
            Welvet
        </p>
        <?php
    }
}
?>

<?php if (isset($content->role_id)) { ?>
    <h4>Hi <?php echo ucwords($content->first_name . ' ' . $content->last_name); ?>,</h4><br/>

    <p>
        <?php echo ucwords($customer['first_name'] . ' ' . $customer['last_name']); ?> has released amount to <?php echo ucwords($talent['first_name'] . ' ' . $talent['last_name']); ?><br/>
        <br/><br/>
        Thanks!
        <br/>
        Welvet
    </p>
<?php } ?>