<style>
    .active{
        color: #444;
        background: #f7f7f7;
    }
</style>
<?php
$action = $this->request->params['action'];
$a = $p = $all = '';
if (isset($this->request->params['pass'][0]) && $this->request->params['pass'][0] == 'active') {
    $a = 'active';
} elseif (isset($this->request->params['pass'][0]) && $this->request->params['pass'][0] == 'pending') {
    $p = 'active';
} else {
    $all = 'active';
}
?>
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link <?= $all; ?>" href="<?php echo $this->request->webroot . 'Users/' . $action; ?>">All</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= $a; ?>" href="<?php echo $this->request->webroot . 'Users/' . $action . '/active'; ?>">Active</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= $p; ?>" href="<?php echo $this->request->webroot . 'Users/' . $action . '/pending'; ?>">Pending</a>
    </li>
</ul>