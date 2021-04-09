<div id="outerbox" class="p-4">
    <div>
        <form action="<?= $this->getUrl('register', 'Register'); ?>" method="post">
            <h4  class="font-weight-bold">Register</h4> <hr>
            <span> <?php echo $this->getBlock('Block\Customer\Layout\Message')->toHtml();?> </span>
            <div class="row form-group">
                <div class="col-12 ">
                    <label for="firstName" class="font-weight-bold">First Name</label>
                    <input type="firstName" name="register[firstName]" id="firstName" class="form-control" required>
                </div>

                <div class="col-12  mt-3">
                    <label for="lastName" class="font-weight-bold">Last Name</label>
                    <input type="lastName" name="register[lastName]" id="lastName" class="form-control" required>
                </div>
            
                <div class="col-12  mt-3">
                    <label for="email" class="font-weight-bold">Email</label>
                    <input type="email" name="register[email]" id="email" class="form-control" required>
                </div>

                <div class="col-12 mt-3">
                    <label for="password" class="font-weight-bold">Password</label>
                    <input type="password" name="register[password]" id="password" class="form-control" required>
                </div>
                
                <div class="col-12 mt-3">
                    <label for="phone" class="font-weight-bold">Phone</label>
                    <input type="tel" name="register[phone]" id="phone" class="form-control" required>
                </div>

                <div class="col-12 mt-4">
                    <input type="submit" id="login" value="Register" class="form-control text-white">
                </div>
            </div>
        </form>

        <div class="clearfix">
            <span class="float-left">Already have an account? <a id="link" href="<?= $this->getUrl('index', 'Login'); ?>">log In</a></span>
            <!-- <span class="float-right"><a id="link" href="<?php //echo $this->getUrl('login', 'login'); ?>">Forgot Password?</a></span> -->
        </div>
    </div>
</div>