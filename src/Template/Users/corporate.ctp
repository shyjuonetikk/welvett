<?php echo $this->element('inc/userStatusTabs'); ?>
<div class="container content-container">
    <div class="row">
        <div class="" id="no-more-tables">
            <table class="table-bordered table-striped table-condensed cf">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('job_title', 'Photo') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('company_name') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('company_address') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('company_email') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('company_phone') ?></th>
                        <th scope="col">Bookings</th>
                        <th scope="col"><?= __('Status') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($users as $user):
                        $path = '';
                        $loginWithSocial = $user['loginwithsocial'];
                        $path = $user['profile_image'];
                        $image = 'cyber1550500683.png';
                        if ($loginWithSocial != 'undefined' && $loginWithSocial != "") {

                            $path = $user['profile_image'];
                        } else if ($loginWithSocial == 'undefined' || $loginWithSocial == '') {
                            if ($user['profile_image'] == '') {

                                $path = $this->request->webroot . 'img/users/' . $image;
                            } else {
                                $path = $this->request->webroot . 'img/users/' . $path;
                            }
                        } else {
                            $path = $this->request->webroot . 'img/users/' . $image;
                        }
                        ?>
                        <tr>
                            <td data-title="Photo">
                                <img src="<?php echo $path; ?>" width='50' height='50'/>
                            </td>
                            <td data-title="Company Name"><?= h(ucwords(strtolower($user->corporate_member->company_name))) ?></td>
                            <td data-title="Company Address"><?= h(ucwords(strtolower($user->address1))) ?></td>
                            <td data-title="Company Email"><?= h(strtolower($user->email)) ?></td>
                            <td data-title="Company Phone"><?= h($user->phone1) ?></td>
                            <td data-title="Bookings">
                                <a href="<?php echo $this->request->webroot . 'TalentEvents/bookings/' . $user->id ?>" class="btn btn-info" data-toggle="tooltip" title="Bookings">
                                    <span class="fa fa-calendar-o"></span>
                                </a>
                            </td>
                            <td data-title="Status">
                                <?php
                                if ($user->status) {
                                    echo $this->Html->link(__('Active'), array('controller' => 'users', 'action' => 'change_status', $user->id, 0), array('class' => 'btn btn-success', 'onclick' => "return confirm('This account is active do you want to inactive it')", 'escape' => false));
                                } else {
                                    echo $this->Html->link(__('In active'), array('controller' => 'users', 'action' => 'change_status', $user->id, 1), array('class' => 'btn btn-danger', 'onclick' => "return confirm('This account is Inactive do you want to active it')", 'escape' => false));
                                }
                                ?>

                            </td>
                            <td data-title="Action" class="actions">
                                <?php
                                echo $this->Html->link(__('Reviews'), array('controller' => 'Customerreviews', 'action' => 'index', $user->id), array('class' => 'btn btn-primary', 'escape' => false));
                                if ($permission == 2) {
                                    echo $this->Html->link(__('<i class="fa fa-edit"></i>'), array('controller' => 'users', 'action' => 'editcorporate', $user->id), array('class' => 'btn btn-success', 'escape' => false));
                                    echo $this->Html->link(__('<i class="fa fa-trash"></i> '), ['controller' => 'users', 'action' => 'delete', $user->id], ['escape' => false, 'class' => 'btn btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $user->user_name)]);
                                    ?>
                                    <?php
                                } else {
                                    echo $this->Html->link(__('<i class="fa fa-eye"></i> '), array('controller' => 'users', 'action' => 'viewcorporate', $user->id), array('class' => 'btn btn-primary', 'escape' => false));
                                }
                                ?>

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
</div>

