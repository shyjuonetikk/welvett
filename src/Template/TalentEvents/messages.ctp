<style>
    th{
        color:black !important;
    }
    .submit{
        display:inline;
    }
</style>
<div class="container content-container">
    <div class="row">
        <div class="" id="no-more-tables">
            <table class="table-bordered table-striped table-condensed cf">
                <thead>
                    <tr>
                        <th scope="col">User</th>
                        <th scope="col">Role</th>
                        <th scope="col">Message</th>
                        <th scope="col">Time</th>
                        <th scope="col" style="color:black !important">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($messages as $msg): ?>
                        <tr>
                            <td data-title="User"><?= ucwords($msg->user->first_name . ' ' . $msg->user->last_name); ?></td>
                            <?php
                            if ($msg->user->role_id == 2 || $msg->user->role_id == 3) {
                                $role = 'Customer';
                                if ($msg->user->role_id == 2) {
                                    $role .= " (Individual Member)";
                                } else {
                                    $role .= " (Corporate Member)";
                                }
                            } else {
                                $role = "Talent";
                            }
                            ?>
                            <td data-title="Role"><?= $role; ?></td>
                            <td id="message_td<?php echo $msg->id; ?>" data-title="Message"><?= $msg->message; ?></td>
                            <td data-title="Time">
                                <?php
                                $date = explode(', ', $msg->created);
                                echo date("M d, Y", strtotime($date[0])) . ' at ' . $date[1];
                                ?>
                            </td>
                            <td data-title="Action">
                                <?php
                                if ($permission == 2) {
                                    ?>
                                    <a class="btn btn-success" onclick="update_msg(<?php echo $msg->id; ?>)" href="#"><i class="fa fa-edit"></i></a>
                                    <?php echo $this->Html->link(__('<i class="fa fa-trash"></i> '), ['controller' => 'TalentEvents', 'action' => 'delete_message', $msg->id,$this->request->params['pass'][0]], ['escape' => false, 'class' => 'btn btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $msg->id)]);
                                    ?>
                                <?php } ?>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="paginator">
                <ul class="pagination">
                    <?= $this->Paginator->first('<< ' . __('first')) ?>
                    <?= $this->Paginator->prev('< ' . __('previous')) ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next(__('next') . ' >') ?>
                    <?= $this->Paginator->last(__('last') . ' >>') ?>
                </ul>
                <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #7B1B2D;color: white;">
                    <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
                    <h4 class="modal-title">Edit Message</h4>
                </div>
                <?php echo $this->Form->create('message_edit_form', array('id' => 'edit_message_form')); ?>

                <div class="modal-body">
                    <div class="row">
                        <label for="message" class="col-md-3 control-label">Message</label>
                        <div class="col-md-9">
                            <?php echo $this->Form->hidden('id', array('id' => 'message_id', 'value' => '')); ?>
                            <?php echo $this->Form->control('message', array('type' => 'textarea', 'id' => 'message', 'div' => false, 'label' => false, 'class' => 'form-control text-capitalize', 'value' => '', 'required', 'style' => 'padding:7px 10px !important')); ?>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="modal-footer" style="text-align:right">
                    <?php
                    echo $this->Form->control('Update', array('type' => 'submit', 'label' => false, 'class' => 'btn btn-default', 'id' => 'register'));
                    ?>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>

</div>
<script>
    function update_msg(msg_id) {
        $('#message').val($('#message_td' + msg_id).text());
        $('#message_id').val(msg_id);
        $('#myModal').modal('show');
    }
    $(function () {
        $('#edit_message_form').submit(function () {
            $.ajax({
                type: 'GET',
                url: '<?php echo $this->request->webroot . 'TalentEvents/edit_msg' ?>',
                data: $("#edit_message_form").serialize(),
                contentType: 'json',
                success: function (data)
                {
                    data = JSON.parse(data);
                    console.log(data);
                    $('#message_td' + data.id).text(data.message);
                    $('#myModal').modal('hide');
                }, error: function (error) {
                    // alert(JSON.stringify(error));
                }
            });
            return false;
        });
    });
</script>
