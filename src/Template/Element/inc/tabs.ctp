<style>
    #nav-tab .active{
        background-color: #511723;
        color:white;
    }
    #nav-tab .active:hover{
        color:white !important;
    }

</style>
<?php
$link = '';
if ($this->request->session()->read('Auth.User.role_id') == 2) {
    $link = 'Users/individual_events';
}
if ($this->request->session()->read('Auth.User.role_id') == 3) {
    $link = 'CorporateMembers/corporateEvents';
}
if ($this->request->session()->read('Auth.User.role_id') == 4) {
    $link = 'EmployeeMembers/employee_events';
}
?>
<!-- Tabs -->
<div class="row" style="margin-bottom: 25px;">
    <div class="col-lg-12 col-xl-12 col-md-12 col-xs-12">
        <nav>
            <?php
            $active = '';
            if (isset($this->request->params['pass'][0])) {
                $active = $this->request->params['pass'][0];
            }
            ?>
            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                <a class="nav-item nav-link <?= ($active == '') ? 'active' : ''; ?>" href="<?php echo $this->request->webroot . $link; ?>" aria-selected="true">All</a>
                <a class="nav-item nav-link <?= ($active == 'disputes') ? 'active' : ''; ?>" href="<?php echo $this->request->webroot . $link . '/disputes' ?>" aria-selected="true">Disputes</a>
                <a class="nav-item nav-link <?= ($active == 'accepted') ? 'active' : ''; ?>" href="<?php echo $this->request->webroot . $link . '/accepted' ?>" aria-selected="true">Accepted</a>
                <a class="nav-item nav-link <?= ($active == 'pending') ? 'active' : ''; ?>" href="<?php echo $this->request->webroot . $link . '/pending' ?>" aria-selected="true">Pending</a>
            </div>
        </nav>
    </div>
</div>

<!-- ./Tabs -->