<?php echo $this->element('inc/userStatusTabs'); ?>
<div class="container content-container" style="overflow: auto;">
    <div class="row">
        <?php echo $this->Form->create(); ?>

        <div class="col-md-9">
            <?php echo $this->Form->control('category_id', ['options' => $eventcategories, 'empty' => 'All', 'class' => 'form-control']); ?>
        </div>
        <div class="col-md-3">

            <?php echo $this->Form->submit('Search', ['class' => 'btn btn-primary', 'style' => 'margin-top:25px;']); ?>
            <br/>
            <br/>
        </div>

        <?php echo $this->Form->end(); ?>

        <div class="" id="no-more-tables">
            <table class="table-bordered table-striped table-condensed cf">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('Photo') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('first_name') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('last_name') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('eventcategory_id', 'Category') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('Services') ?></th>
                        <th scope="col" style="color:black !important">Reviews</th>
                        <th scope="col" style="color:black !important">Calendars</th>
                        <th scope="col" style="color:black !important">Bookings</th>
                        <!--<th scope="col">< $this->Paginator->sort('social_media_link') ?></th>-->
                        <th scope="col"  style="color:black !important">links</th>
                        <th scope="col" class="actions" style="color:black !important">Status</th>
                        <th scope="col" class="actions" style="color:black !important">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($users as $user):
                        $social_link = '';
                        $color = '';

                        if ($user['howtologin'] == 'login with google') {
                            $social_link = 'fa fa-google-plus-square';
                            $color = '#E84F4A';
                        }
                        if ($user['howtologin'] == 'login with Twitter') {
                            $social_link = 'fa fa-twitter';
                            $color = '#7CC5F8';
                        }
                        if ($user['howtologin'] == 'login with Instagram') {
                            $social_link = 'fa fa-instagram';
                            $color = '#C21C7B';
                        }
                        if ($user['howtologin'] == 'login with facebook done') {
                            $social_link = 'fa fa-facebook';
                            $color = '#465994';
                        }
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
                        if ($this->request->is('post') && count($user->talent_events) == 0) {
                            //do nothing
                        } else {
                            $cats = $user->employee_member->eventcategory_id;
                            if ($this->request->is('post')) {
                                $cats = $this->request->data['category_id'];
                            }
                            ?>
                            <tr>
                                <td data-title="Photo">

                                    <img src="<?php echo $path; ?>" width='50' height='50'/>
                                </td>
                                <td data-title="First Name"><?= h(ucwords($user->first_name)); ?></td>
                                <td data-title="Last Name"><?= h(ucwords($user->last_name)); ?></td>
                                <td data-title="Email"><?= h(ucwords($user->email)) ?></td>
                                <td data-title="Category"><?= $eventcategories[$cats] ?></td>
                                <td data-title="Total Events">
                                    <a href="<?php echo $this->request->webroot . 'TalentEvents/viewevents/' . $user->id ?>" class="btn btn-primary" data-toggle="tooltip" title="Services">
                                        <span class="fa fa-briefcase"></span> 
                                        <span class="badge"><?php echo count($user->talent_events); ?></span> 
                                    </a>
                                </td>
                                <td data-title="Reviews">
                                    <a href="<?php echo $this->request->webroot . 'Users/viewreviews/' . $user->id ?>" class="btn btn-default" data-toggle="tooltip" title="Reviews">
                                        <span class="fa fa-comments"></span>
                                        <span class="badge">
                                            <?php echo empty($user->talent_reviews) ? 0 : $user->talent_reviews[0]->total; ?>
                                        </span>
                                    </a>
                                </td>
                                <td data-title="Calendar">
                                    <a href="<?php echo $this->request->webroot . 'Users/viewcalendar/' . $user->id ?>" class="btn btn-info" data-toggle="tooltip" title="Calendars">
                                        <span class="fa fa-calendar"></span>

                                        <span class="badge">
                                            <?php echo empty($user->talent_calendars) ? 0 : $user->talent_calendars[0]->total_calendars; ?>
                                        </span>
                                    </a>
                                </td>
                                <td data-title="Bookings">
                                    <a href="<?php echo $this->request->webroot . 'TalentEvents/bookings/' . $user->id ?>" class="btn btn-info" data-toggle="tooltip" title="Bookings">
                                        <span class="fa fa-calendar-o"></span>
                                    </a>
                                </td>
                                <!--                            <td data-title="Social Media Link">
        < ucfirst($user->employee_member->social_media_link) ?>
        </td>-->

                                <td data-title="Social Link" style="text-align:center;">
                                    <a target="_blank" href="<?= $user['profile_link'] ?>" class="<?= $social_link; ?>" style="color:<?= $color; ?>;font-size:22px;"></a>
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
                                <td data-title="Action" style="min-width: 135px;">
                                    <?php
                                    if ($permission == 2) {
                                        echo $this->Html->link(__('<i class="fa fa-edit"></i>'), array('controller' => 'users', 'action' => 'editemployee', $user->id), array('class' => 'btn btn-success', 'escape' => false));
                                        echo $this->Html->link(__('<i class="fa fa-trash"></i> '), ['controller' => 'users', 'action' => 'delete_employee', $user->id], ['escape' => false, 'class' => 'btn btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $user->user_name)]);
                                    } else {
                                        echo $this->Html->link(__('<i class="fa fa-eye"></i> '), array('controller' => 'users', 'action' => 'viewemployee', $user->id), array('class' => 'btn btn-primary', 'escape' => false));
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php } endforeach; ?>
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

