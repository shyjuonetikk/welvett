<?php ?>
<style>
    ::placeholder {
        color: gray !important;
        opacity: 1; /* Firefox */
    }
    #customer_login_button{
        color:white !important;
        background-color: #7D1A2E;
    }
    #customer_login_button::hover{
        color:white !important;
        background-color: #7D1A2E;
    }
    .special-login {
        padding: 0px;
        box-shadow: 0px 1px 18px #7D1A2E;
        position: relative;
        border: 1px solid #7D1A2E;
    }
    #display_reg_form{
        color:#7D1A2E;
    }
    #display_reg_form::hover{
        color:#7D1A2E;
    }
</style>
<form method="post" class="pt-4">
    <div class="form-group">
        <!--<label for="exampleInputEmail1">Username</label>-->
        <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
        <i class="mdi mdi-account"></i>
    </div>
    <div class="form-group">
        <!--<label for="exampleInputPassword1">Password</label>-->
        <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        <i class="mdi mdi-eye"></i>
    </div>
    <div class="mt-5">
        <button id="customer_login_button" type="submit" class="btn btn-block btn-lg font-weight-medium">Login</button>
    </div>
    <div class="mt-3 text-center">
        <span>Haven't Account </span><a href="<?php echo $this->request->webroot ?>" id="display_reg_form">Sign Up</a>
    </div>
</form>