
<style>
    .submit{
        display:inline !important;
    }
</style>
<div class="container content-container">
    <div class="row">
        <div class="" id="no-more-tables">
            <table class="table-bordered table-striped table-condensed cf">
                <thead>
                    <tr>
                        <th scope="col" style="color:black !important;">User Name</th>
                        <!--<th scope="col">< $this->Paginator->sort('booking_id') ?></th>-->
                        <th scope="col" style="color: black !important;">Service Category</th>
                        <th scope="col" style="color: black !important;">Services</th>
                        <th scope="col" style="color: black !important;"><?= $this->Paginator->sort('date') ?></th>
                        <th scope="col" class="actions" style="color:black !important">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($calendars as $calendar):
                        ?>
                        <tr>
                            <td data-title="User Name"><?= h(ucwords($calendar->user->first_name . ' ' . $calendar->user->last_name)); ?></td>
                            <td data-title="Services"><?php echo $calendar->talent_event->eventcategory->title; ?></td>

                            <td data-title="Service category"><span class="badge"><?php echo str_replace(',', '</span> <span class="badge">', $calendar->talent_event->talent_event_subcategories[0]->title); ?></span></td>
                            <td data-title="Booking Date" id="message_td<?= $calendar->id; ?>">
                                <?php echo date("M d, Y", strtotime($calendar->date)); ?>
                            </td>
                            <td data-title="Action">
                                <?php if ($permission == 2) { ?>
                                    <a class="btn btn-success" onclick="update_msg(<?php echo $calendar->id; ?>)" href="#"><i class="fa fa-edit"></i></a>

                                    <?php
//                                    echo $this->Html->link(__('<i class="fa fa-edit"></i>'), '#', array('class' => 'btn btn-success', 'escape' => false));
                                    echo $this->Html->link(__('<i class="fa fa-trash"></i> '), ['controller' => 'users', 'action' => 'delete', $calendar->id], ['escape' => false, 'class' => 'btn btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $calendar->id)]);
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
        <div class="modal-dialog modal-md" style="width:30%">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #7B1B2D;color: white;">
                    <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
                    <h4 class="modal-title">Edit Date</h4>
                </div>
                <?php echo $this->Form->create('message_edit_form', array('id' => 'edit_message_form')); ?>

                <div class="modal-body" style="padding-bottom: 0;">
                    <div class="row">
                        <label for="message" class="col-md-4 control-label">Date</label>
                        <div class="col-md-8">
                            <?php echo $this->Form->hidden('id', array('id' => 'message_id', 'value' => '')); ?>
                            <?php echo $this->Form->control('message', array('type' => 'text', 'id' => 'message', 'div' => false, 'label' => false, 'class' => 'form-control datepicker', 'required')); ?>
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
        $.ajax({
            type: 'GET',
            url: '<?php echo $this->request->webroot . 'Users/getdate' ?>',
            data: 'id=' + msg_id,
            contentType: 'json',
            success: function (data)
            {
                data = JSON.parse(data);
                console.log(data);

                $('#message').val(data);
                $('#message_id').val(msg_id);
                $('#myModal').modal('show');
            }, error: function (error) {
                // alert(JSON.stringify(error));
            }
        });
    }
    $(function () {
        $('#edit_message_form').submit(function () {
            $.ajax({
                type: 'GET',
                url: '<?php echo $this->request->webroot . 'Users/editcalendar' ?>',
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

