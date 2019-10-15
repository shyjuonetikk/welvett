<div class="container-fluid">
    <div class="row">
        <div class="clearfix"></div>
        <?php
        if ($permission == 2) {
        ?>
        <a href="<?php echo $this->request->webroot ?>users/addAdmin" class="btn btn-blue-custom btn-lg"><i class="fa fa-plus"></i> Add Admin</a>
        <?php } ?>
    </div>
</div>
<div class="container content-container">

    <div class="row">
        <div class="" id="no-more-tables">
            <table class="table-bordered table-striped table-condensed cf">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('photo', 'Photo') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('name', 'Name') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('email', 'Email') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('Phone', 'Phone') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('role', 'Role') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('modified', 'Modified') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user):
                            $path = '';
                            $loginWithSocial = $user['loginwithsocial'];
                            $path = $user['profile_image'];
                            $image = 'cyber1550500683.png';
                            if ($loginWithSocial != 'undefined' && $loginWithSocial != "") {

                                $path = $user['profile_image'];
                            } else if ($loginWithSocial == 'undefined' || $loginWithSocial == '') {
                                if($user['profile_image'] == ''){

                                    $path = $this->request->webroot.'img/users/'.$image;
                                } else{
                                    $path = $this->request->webroot.'img/users/'.$path;
                                }
                            } else { 
                                $path = $this->request->webroot.'img/users/'.$image;
                            }
                    ?>
                    <tr>
                        <td data-title="Photo"><img src="<?php echo $path; ?>" height='50'/></td>
                        <td data-title="Name"><?= h(ucwords(strtolower($user->full_name))) ?></td>
                        <td data-title="Email"><?= h(strtolower($user->email)) ?></td>
                        <td data-title="Phone"><?= h($user->phone1) ?></td>
                        <td data-title="Role"><?= h($user->role->name) ?></td>
                        <td data-title="Modified"><?= h(date('n/j/y', strtotime($user->modified))) ?></td>
                        <td data-title="Action" class="actions">


                            <?php
    if ($permission == 2) {
                            ?>
                            <?php echo $this->Html->link(__('<i class="fa fa-edit"></i>'), array('controller' => 'users', 'action' => 'edit_user', $user->id), array('class' => 'btn btn-success', 'escape' => false)); ?>

                            <?php
        $userId = $this->request->session()->read('Auth.User.id');
        if ($userId != $user->id) {
                            ?>
                            <?= $this->Html->link(__('<i class="fa fa-trash"></i> '), ['controller' => 'users', 'action' => 'delete', $user->id], ['escape' => false, 'class' => 'btn btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $user->user_name)]); ?>
                            <?php
        }
    } else {
                            ?>
                            <?php echo $this->Html->link(__('<i class="fa fa-eye"></i> '), array('controller' => 'users', 'action' => 'view_profile', $user->id), array('class' => 'btn btn-primary', 'escape' => false)); ?>
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
</div>

