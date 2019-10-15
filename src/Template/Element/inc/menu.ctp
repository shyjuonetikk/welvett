<?php ?>

<div class="col-md-6">
    <div class="left-header-section">
        <div class="branding">
            <a class="navbar-brand" href="<?php echo $this->request->webroot;?>">
                <img src="<?php echo $this->request->webroot ?>assets/images/logo.png" class="image-responsive"  />
            </a>
        </div>
        <div class="top-member-menu">
            <ul>
                <li class="<?php if($this->request->params['action'] == 'registerindividual') echo 'active-reg-option'; ?>">
                    <a href="<?php echo $this->request->webroot;?>pages/registerindividual">
                        <span class="top-icon-wrapper pull-left">
                            <img src="<?php echo $this->request->webroot ?>assets/images/individual-icon.png" class="top-menu-icon">
                        </span> Individual Account
                    </a>
                </li>

                <li class="<?php if($this->request->params['action'] == 'registercorporate') echo 'active-reg-option'; ?>">
                    <a href="<?php echo $this->request->webroot;?>pages/registercorporate">
                        <span class="top-icon-wrapper pull-left">
                            <img src="<?php echo $this->request->webroot ?>assets/images/corporate-icon.png" class="top-menu-icon">
                        </span>Corporate Account
                    </a>
                </li>

                <li class="nonactive"><hr class="top-divider" /></li>
                <li class="<?php if($this->request->params['action'] == 'registeremployee') echo 'active-reg-option'; ?>">
                    <a href="<?php echo $this->request->webroot;?>pages/registeremployee">
                        <span class="top-icon-wrapper pull-left">
                            <img src="<?php echo $this->request->webroot ?>assets/images/employee-icon.png" class="top-menu-icon">
                        </span> Talent Account
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>   