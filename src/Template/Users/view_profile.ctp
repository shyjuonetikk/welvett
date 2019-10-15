<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="panel-head-info">
    <p class="pull-left info-text">User Profile</p>
    <a href="<?php echo $this->request->webroot ?>users/users_list" style="font-size:14px;" class="btn btn-primary btn-blue-custom pull-right text-info"><i class="fa fa-angle-left"></i> Go Back</a>
    <div class="clearfix"></div>

</div>
<div class="container content-container">
    <div class="row">
        <div class="" id="no-more-tables">
            <table class="table-bordered table-striped table-condensed cf">
                <thead>
                    <tr>
                        <?php
                        $image = $user->profile_image;
                        if ($image != "") {
                            ?>
                            <th scope="row"><?= __('Photo') ?></th>
                        <?php } ?>
                        <th scope="row"><?= __('First Name') ?></th>
                        <th scope="row"><?= __('Last Name') ?></th>
                        <th scope="row"><?= __('User name') ?></th>
                        <th scope="row"><?= __('Email') ?></th>
                        <th scope="row"><?= __('Role') ?></th>
                        <th scope="row"><?= __('Gender') ?></th>
                        <th scope="row"><?= __('Status') ?></th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        if ($image != "") {
                            ?>
                            <td data-title="Photo">
                                <img width="60" src="<?php echo $this->request->webroot ?>img/users/<?php echo $user->profile_image; ?>" alt="No Image Found"/>

                                &nbsp;
                            </td>
                        <?php } ?>
                        <td data-title="First Name"><?= h(ucwords(strtolower($user->first_name))) ?></td>
                        <td data-title="Last Name"><?= h(ucwords(strtolower($user->last_name))) ?></td>
                        <td data-title="User name"><?= h(strtolower($user->user_name)) ?></td>
                        <td data-title="Email"><?= h(strtolower($user->email)) ?></td>
                        <td data-title="Role"><?= h($user->role->name) ?></td>
                        <td data-title="Gender"><?= h(ucwords(strtolower($user->gender))) ?></td>
                        <td data-title="Status"><?php if ($user->status == 1) {
                            $status = "Active";
                        } else {
                            $status = "In Active";
                        } echo $status; ?>&nbsp;</td>
                    </tr>
                </tbody>
            </table>
            <div class="clearfix"> &nbsp;</div>
            <table class="table-bordered table-striped table-condensed cf">
                <thead>
                    <tr>
                        <th scope="row"><?= __('Phone 1') ?></th>
                        <th scope="row"><?= __('Phone 2') ?></th>
                        <th scope="row"><?= __('Address 1') ?></th>
                        <th scope="row"><?= __('Address 2') ?></th>
                        <th scope="row"><?= __('City') ?></th>
                        <th scope="row"><?= __('State') ?></th>
                        <th scope="row"><?= __('Zip') ?></th>
                        <th scope="row"><?= __('Modified') ?></th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td data-title="Phone 1"><?= h($user->phone1) ?></td>
                        <td data-title="Phone 2"><?= h($user->phone2) ?></td>
                        <td data-title="Address 1"><?= h(strtolower($user->address1)) ?></td>
                        <td data-title="Address 2"><?= h(strtolower($user->address2)) ?></td>
                        <td data-title="City"><?= h($user->city) ?></td>
                        <td data-title="State"><?= h($user->state) ?></td>
                        <td data-title="Zip"><?= h($user->zip) ?></td>
                        <td data-title="Modified"><?= h(date('n/j/y', strtotime($user->modified))) ?></td>
                    </tr>
                </tbody>

            </table>


        </div>
    </div>
</div>
