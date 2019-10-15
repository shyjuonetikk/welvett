<?php ?>

<form method="post" class="pt-4">
    <div class="form-group">
        <label for="exampleInputEmail1">Username</label>
        <input name="user_name" type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter your username">
        <i class="mdi mdi-account"></i>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter your password">
        <i class="mdi mdi-eye"></i>
    </div>
    <div class="mt-5">
        <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium" style="background-color: #7D1A2E; border: none;">Login</button>
    </div>
    <div class="mt-3 text-center">
        <!-- <a href="#" class="auth-link text-black">Forgot password?</a> -->
    </div>
</form>