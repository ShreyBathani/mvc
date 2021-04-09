<div id="outerbox" class="p-4">
    <div>
        <form action="<?= $this->getUrl('login', 'login'); ?>" method="post">
            <h4  class="font-weight-bold">Login</h4> <hr>
            <span> <?php echo $this->getBlock('Block\Customer\Layout\Message')->toHtml();?> </span>
            <div class="row form-group">
                <div class="col-12 ">
                    <label for="email" class="font-weight-bold">Email</label>
                    <input type="email" name="login[email]" id="email" class="form-control" required>
                </div>

                <div class="col-12 mt-3">
                    <label for="password" class="font-weight-bold">Password</label>
                    <input type="password" name="login[password]" id="password" class="form-control" required>
                </div>
                
                <div class="col-12 mt-4">
                    <input type="submit" id="login" value="Log in" class="form-control text-white">
                </div>
            </div>
        </form>

        <div class="clearfix">
            <span class="float-left">Need a Account? <a id="link" href="<?= $this->getUrl('index', 'Register'); ?>">Sign up</a></span>
            <!-- <span class="float-right"><a id="link" href="<?php //echo $this->getUrl('login', 'login'); ?>">Forgot Password?</a></span> -->
        </div>
    </div>
</div>