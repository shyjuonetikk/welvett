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
                        <th scope="col"><?= $this->Paginator->sort('first_name') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('last_name') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('Photo') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('eventcategory_id', 'Category') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('address') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('state') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('city') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('social_media_link') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td data-title="First Name"><?= h(ucwords($user->first_name)); ?></td>
                        <td data-title="Last Name"><?= h(ucwords($user->email)); ?></td>
                        <td data-title="Email"><?= h(ucwords($user->email)); ?></td>
                        <td data-title="Photo">
                            <img src="<?php echo $this->request->webroot; ?>img/users/<?php echo h($user->profile_image); ?>" width='50' height='50'/>
                        </td>
                        <td data-title="Category"><?= $eventcategories[$user->employee_member->eventcategory_id] ?></td>
                        <td data-title="Address"><?= h(ucwords(strtolower($user->employee_member->address))) ?></td>
                        <td data-title="State"><?= h(strtolower($user->employee_member->state)) ?></td>
                        <td data-title="City"><?= h($user->employee_member->city) ?></td>
                        <td data-title="Social Media Link"><?= ucfirst($user->employee_member->social_media_link) ?></td>
                        <td data-title="Description"><?= ucfirst($user->employee_member->description) ?></td>
                    </tr>
                </tbody>
            </table>
            <div class="clearfix"> &nbsp;</div>

        </div>
    </div>
</div>
