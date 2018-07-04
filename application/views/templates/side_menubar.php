<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="<?=base_url('dashboard');?>" id="dashboardMainMenu">
                    <i class="fa fa-dashboard fa-fw"></i> Dashboard
                </a>
            </li>
            <?php if($user_permission): ?>
                <?php if(in_array('createUser', $user_permission) || in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
                    <li>
                        <a href="#" id="mainUserNav">
                            <i class="fa fa-users fa-fw"></i> Users
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <?php if(in_array('createUser', $user_permission)): ?>
                                <li>
                                    <a id="createUserNav" href="<?=base_url('users/create');?>">Add User</a>
                                </li>
                            <?php endif; ?>

                            <?php if(in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
                                <li>
                                    <a id="manageUserNav" href="<?=base_url('users');?>">Manage Users</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if(in_array('createGroup', $user_permission) || in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
                    <li>
                        <a href="#" id="mainGroupNav">
                            <i class="fa fa-files-o"></i> Groups
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <?php if(in_array('createGroup', $user_permission)): ?>
                                <li>
                                    <a id="addGroupNav" href="<?=base_url('groups/create');?>">Add Group</a>
                                </li>
                            <?php endif; ?>
                            <?php if(in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
                                <li>
                                    <a id="manageGroupNav" href="<?=base_url('groups');?>">Manage Groups</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if(in_array('createBrand', $user_permission) || in_array('updateBrand', $user_permission) || in_array('viewBrand', $user_permission) || in_array('deleteBrand', $user_permission)): ?>
                    <li>
                        <a id="brandNav" href="<?=base_url('brands/');?>">
                            <i class="fa fa-tags"></i> Brands
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(in_array('createCategory', $user_permission) || in_array('updateCategory', $user_permission) || in_array('viewCategory', $user_permission) || in_array('deleteCategory', $user_permission)): ?>
                    <li>
                        <a id="categoryNav" href="<?=base_url('category/');?>">
                            <i class="fa fa-files-o"></i> Category
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(in_array('createProduct', $user_permission) || in_array('updateProduct', $user_permission) || in_array('viewProduct', $user_permission) || in_array('deleteProduct', $user_permission)): ?>
                    <li>
                        <a href="#" id="mainProductNav">
                            <i class="fa fa-cube"></i> Products
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <?php if(in_array('createProduct', $user_permission)): ?>
                                <li>
                                    <a id="addProductNav" href="<?=base_url('products/create');?>">Add Product</a>
                                </li>
                            <?php endif; ?>

                            <?php if(in_array('updateProduct', $user_permission) || in_array('viewProduct', $user_permission) || in_array('deleteProduct', $user_permission)): ?>
                                <li>
                                    <a id="manageProductNav" href="<?=base_url('products');?>">Manage Products</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if(in_array('createOrder', $user_permission) || in_array('updateOrder', $user_permission) || in_array('viewOrder', $user_permission) || in_array('deleteOrder', $user_permission)): ?>
                    <li>
                        <a href="#" id="mainOrdersNav">
                            <i class="fa fa-dollar"></i> Orders
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <?php if(in_array('createOrder', $user_permission)): ?>
                                <li>
                                    <a id="addOrderNav" href="<?=base_url('orders/create');?>">Add Order</a>
                                </li>
                            <?php endif; ?>

                            <?php if(in_array('updateOrder', $user_permission) || in_array('viewOrder', $user_permission) || in_array('deleteOrder', $user_permission)): ?>
                                <li>
                                    <a id="manageOrdersNav" href="<?=base_url('orders');?>">Manage Orders</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if(in_array('viewReports', $user_permission)): ?>
                    <li>
                        <a id="reportNav" href="<?=base_url('reports/');?>">
                            <i class="fa fa-bar-chart-o"></i> Reports
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(in_array('updateCompany', $user_permission)): ?>
                    <li>
                        <a id="companyNav" href="<?=base_url('company/');?>">
                            <i class="fa fa-files-o"></i> Company
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(in_array('viewProfile', $user_permission)): ?>
                    <li>
                        <a id="profileNav" href="<?=base_url('users/profile/');?>">
                            <i class="fa fa-user"></i> Profile
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(in_array('updateSetting', $user_permission)): ?>
                    <li>
                        <a id="settingNav" href="<?=base_url('users/setting/');?>">
                            <i class="fa fa-wrench"></i> Setting
                        </a>
                    </li>
                <?php endif; ?>

            <?php endif; ?>
            <li>
                <a href="<?=base_url('auth/logout');?>">
                    <i class="fa fa-sign-out"></i> Logout
                </a>
            </li>   
        </ul>
    </div>
</div>
</nav>