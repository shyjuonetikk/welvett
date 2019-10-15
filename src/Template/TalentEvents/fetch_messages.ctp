<style>
    .all_msg{
        height: 50px;
        padding-right: 14px;
    }
</style>
<?php
foreach ($messages as $msg):
    if ($msg->talent_event->user_id == $msg->user_id):
        ?>
        <div class="message">
            <small class="role_style">Talent: &nbsp;</small>
            <?php echo $msg->message ?>
        </div>
        <?php
    else:
        ?>
        <div class="message_right">
            <small class="role_style">Customer: &nbsp;</small>
            <?= $msg->message ?>
        </div>
    <?php endif; ?>
    <?php
endforeach;
if ($this->request->params['paging']['TalentMessages']['count'] > 10) {
    ?>
    <div class="all_msg">
        <a target="_blank" href="<?=$this->request->webroot.'TalentEvents/messages/'.$_GET['id']?>" class="btn btn-success btn-sm pull-right">View All Messages</a>
    </div>
<?php } ?>


