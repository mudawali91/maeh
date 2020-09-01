<!-- Top Bar Start -->
<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <!-- Image logo -->
        <a href="index.html" class="logo">
			<span>
				<img src="<?=base_url()?>img/logo-maeh-100x100.png" alt="" height="30">
			</span>
            <i>
                <img src="<?=base_url()?>img/logo-maeh-100x100.png" alt="" height="30">
            </i>
        </a>
    </div>


    <nav class="navbar-custom">

        <ul class="list-inline float-right mb-0">

            <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                    <img src="<?=base_url()?>assets/images/users/avatar-1.jpg" alt="user" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h5 class="text-overflow">
                            <small><?=$this->session->curr_full_name;?></small> 
                        </h5>
                    </div>

                    <!-- item-->
                    <a href="<?=site_url('admin/profile')?>" class="dropdown-item notify-item">
                        <i class="zmdi zmdi-account-circle"></i> <span>Profile</span>
                    </a>

                    <!-- item-->
                    <a href="<?=site_url('admin/change-password')?>" class="dropdown-item notify-item">
                        <i class="zmdi zmdi-account-circle"></i> <span>Change Password</span>
                    </a>

                    <!-- item-->
                    <a href="<?=site_url('admin/logout')?>" class="dropdown-item notify-item">
                        <i class="zmdi zmdi-power"></i> <span>Logout</span>
                    </a>

                </div>
            </li>

        </ul>

        <ul class="list-inline menu-left mb-0">
            <li class="float-left">
                <button class="button-menu-mobile open-left waves-light waves-effect">
                    <i class="dripicons-menu"></i>
                </button>
            </li>
        </ul>

    </nav>

</div>
<!-- Top Bar End -->