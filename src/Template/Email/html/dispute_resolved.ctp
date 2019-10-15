<div style="width: 100%;text-align:center;background-color: #7B1B2D;">
    <img src="<?= 'http://' . $_SERVER['SERVER_NAME'] . '/' . $this->request->webroot . 'img/logo.png' ?>" width="120">
</div>
<?php
if (isset($content['role_id'])) {
    if ($content['role_id'] == 2 || $content['role_id'] == 3) {
        ?>
        <h4>Hi <?php echo ucwords($content['first_name'] . ' ' . $content['last_name']); ?>,</h4><br/>

        <p>
            <?php if ($status == 'approve') { ?>
                The dispute with <?php echo ucwords($talent['first_name'] . ' ' . $talent['last_name']); ?> has been resolved in the favor of <?php echo ucwords($talent['first_name'] . ' ' . $talent['last_name']); ?>.

            <?php } else { ?>
                The dispute with <?php echo ucwords($talent['first_name'] . ' ' . $talent['last_name']); ?> has been resolved in your favor and amount has been Refunded successfully.
            <?php } ?>
            Admin decision on is given bellow:
            <br>
            <br>
            "<?= $admin_decision ?>"

            <br/>
            <br/>
            <br/>
            Thanks!<br/>
            Welvet
        </p>
    <?php } ?>
    <?php if ($content['role_id'] == 4) { ?>
        <h4>Hi <?php echo ucwords($content['first_name'] . ' ' . $content['last_name']); ?>,</h4><br/>

        <p>
            <?php if ($status == 'approve') { ?>
                The dispute with <?php echo ucwords($customer['first_name'] . ' ' . $customer['last_name']); ?> has been resolved in your favor and amount has been released successfully.

            <?php } else { ?>
                The dispute with <?php echo ucwords($customer['first_name'] . ' ' . $customer['last_name']); ?> has been resolved in the favor of <?php echo ucwords($customer['first_name'] . ' ' . $customer['last_name']); ?>.
            <?php } ?>
            Admin decision on is given bellow:
            <br>
            <br>
            "<?= $admin_decision ?>"
            <br/>
            <br/>
            <br/>
            Thanks!
            <br/>
            Welvet
        </p>
        <?php
    }
}
?>

<?php if (isset($content->role_id) && $content->role_id == 1) { ?>
    <h4>Hi <?php echo ucwords($content->first_name . ' ' . $content->last_name); ?>,</h4><br/>

    <p>
        <?php if ($status == 'approve') { ?>
            you have resolved the dispute between <?php echo ucwords($customer['first_name'] . ' ' . $customer['last_name']); ?> and  <?php echo ucwords($talent['first_name'] . ' ' . $talent['last_name']); ?> and the amount is successfully transfered to  <?php echo ucwords($talent['first_name'] . ' ' . $talent['last_name']); ?>.

        <?php } else { ?>
            you have resolved the dispute between <?php echo ucwords($customer['first_name'] . ' ' . $customer['last_name']); ?> and  <?php echo ucwords($talent['first_name'] . ' ' . $talent['last_name']); ?> and the amount is successfully refunded to  <?php echo ucwords($customer['first_name'] . ' ' . $customer['last_name']); ?>.
        <?php } ?>
        Admin decision on is given bellow:
        <br>
        <br>
        "<?= $admin_decision ?>"


        <br/>
        <br/>
        <br/>
        Thanks!
        <br/>
        Welvet
    </p>
<?php } ?>