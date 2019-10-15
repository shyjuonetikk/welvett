<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="panel-head-info">
    <p class="pull-left info-text">User Profile</p>
    <a href="<?php echo $this->request->webroot ?>users/corporate" style="font-size:14px;" class="btn btn-primary btn-blue-custom pull-right text-info"><i class="fa fa-angle-left"></i> Go Back</a>
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
                        <th scope="row">Company Name</th>
                        <th scope="row">Company Address</th>
                        <th scope="row">Company Email</th>
                        <th scope="row">Company Phone</th>
                        <th scope="row">Is Authorize</th>
                        <th scope="row">Authorizer First Name</th>
                        <th scope="row">Authorizer Last Name</th>
                        <th scope="row">Authorizer Job Title</th>
                        <th scope="row">Authorizer Email</th>
                        <th scope="row">Authorizer Phone</th>

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
                        <td data-title="Company Name"><?= h(ucwords(strtolower($user->corporate_member->company_name))) ?></td>
                        <td data-title="Company Address"><?= h(ucwords(strtolower($user->corporate_member->company_address))) ?></td>
                        <td data-title="Company Email"><?= h(strtolower($user->corporate_member->company_email)) ?></td>
                        <td data-title="Company Phone"><?= h(strtolower($user->corporate_member->company_phone)) ?></td>
                        <td data-title="Is Authorize"><?= h(strtolower($user->corporate_member->is_authorize)) ?></td>
                        <td data-title="Authorizer First Name"><?= h(strtolower($user->corporate_member->authorizer_first_name)) ?></td>
                        <td data-title="Authorizer Last Name"><?= h(strtolower($user->corporate_member->authorizer_last_name)) ?></td>
                        <td data-title="Authorizer Job title"><?= h(strtolower($user->corporate_member->authorizer_job_title)) ?></td>
                        <td data-title="Authorizer Email"><?= h(strtolower($user->corporate_member->authorizer_email)) ?></td>
                        <td data-title="Authorizer Phone"><?= h(strtolower($user->corporate_member->authorizer_phone)) ?></td>
                        
                    </tr>
                </tbody>
            </table>
            <div class="clearfix"> &nbsp;</div>
            
        </div>
    </div>
</div>
