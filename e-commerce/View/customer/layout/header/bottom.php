<?php $categories = $this->getCategories(); ?>

<!-- menu -->
<section id="menu">
    <div class="container">
        <div class="menu-area">
            <!-- Navbar -->
            <div class="navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse">
                    <!-- Left nav -->
                    <ul class="nav navbar-nav">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="account.html">My Account</a></li>
                        <?php $cnt = 0; ?>
                        <?php $flag = 0; ?>
                        <?php foreach ($categories->getdata() as $key => $category) : ?>
                            <?php if($category->parentId == 0): ?>
                                <?php if($key !=0): ?>
                                    </ul></li>
                                    <?php for ($i=0; $i < $flag; $i++): ?>
                                        </ul></li>
                                    <?php endfor; ?>
                                <?php $flag = 0; ?>
                                <?php $cnt = 0; ?>
                                <?php endif; ?>
                                <li><a href="<?php echo $this->getUrl('view', 'category', ['categoryId' => $category->categoryId], true); ?>"><?= $category->name; ?> <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                <?php continue; ?>
                            <?php endif; ?>
                            <?php if($cnt == 7): ?>
                                <li><a href="#">And more.. <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                <?php $flag++; ?>
                            <?php $cnt = 0; ?>
                            <?php endif; ?>
                            <li><a href="<?php echo $this->getUrl('view', 'category', ['categoryId' => $category->categoryId], true); ?>"><?= $category->name; ?></a></li>
                            <?php $cnt++; ?>
                        <?php endforeach; ?>
                            </ul>
                        </li>
                        <li><a href="wishlist.html">Wishlist</a></li>
                        <li><a href="contact.html">Contact</a></li>
                        <li><a href="#">Pages <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="product.html">Shop Page</a></li>
                                <li><a href="product-detail.html">Shop Single</a></li>
                                <li><a href="404.html">404 Page</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!--/.nav-collapse -->
            </div>
        </div>
    </div>
</section>
<!-- / menu -->