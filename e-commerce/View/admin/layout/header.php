<nav class="navbar navbar-expand-md bg-dark navbar-dark sticky-top">
    <a class="navbar-brand" href="<?php echo $this->getUrl('index', 'index', null, true) ?>"><img src="<?php echo $this->baseUrl('Skin/Admin/Logo/logo.PNG'); ?>" alt="logo" width="200px"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" onclick="object.setUrl('<?php echo $this->getUrl('grid', 'Admin\admin', null, true) ?>').resetParams().load()" href="javascript:void(0)">Admin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" onclick="object.setUrl('<?php echo $this->getUrl('grid', 'Admin\attribute', null, true) ?>').resetParams().load()" href="javascript:void(0)">Attribute</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" onclick="object.setUrl('<?php echo $this->getUrl('grid', 'Admin\brand', null, true) ?>').resetParams().load()" href="javascript:void(0)">Brand</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" onclick="object.setUrl('<?php echo $this->getUrl('grid', 'Admin\cart', null, true) ?>').resetParams().load()" href="javascript:void(0)">Cart</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" onclick="object.setUrl('<?php echo $this->getUrl('grid', 'Admin\category', null, true) ?>').resetParams().load()" href="javascript:void(0)">Category</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" onclick="object.setUrl('<?php echo $this->getUrl('grid', 'Admin\cms', null, true) ?>').resetParams().load()" href="javascript:void(0)">Cms</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" onclick="object.setUrl('<?php echo $this->getUrl('grid', 'Admin\ConfigGroup', null, true) ?>').resetParams().load()" href="javascript:void(0)">Configuration</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" onclick="object.setUrl('<?php echo $this->getUrl('grid', 'Admin\customer', null, true) ?>').resetParams().load()" href="javascript:void(0)">Customer</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" onclick="object.setUrl('<?php echo $this->getUrl('grid', 'Admin\Customer\Group', null, true) ?>').resetParams().load()" href="javascript:void(0)">Customer Group</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" onclick="object.setUrl('<?php echo $this->getUrl('grid', 'Admin\product', null, true) ?>').resetParams().load()" href="javascript:void(0)">Product</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" onclick="object.setUrl('<?php echo $this->getUrl('grid', 'Admin\paymentMethod', null, true) ?>').resetParams().load()" href="javascript:void(0)">Payment</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" onclick="object.setUrl('<?php echo $this->getUrl('grid', 'Admin\shippingMethod', null, true) ?>').resetParams().load()" href="javascript:void(0)">Shipping</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $this->getUrl('logout', 'Login', null, true) ?>">Log Out</a>
            </li>
        </ul>
    </div>  
</nav>