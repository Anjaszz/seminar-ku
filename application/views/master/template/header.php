<header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed">
   <div class="m-header">
       <a class="mobile-menu" id="mobile-collapse1" href="#!"><span></span></a>
       <a href="#" class="b-brand">
           <div class="b-bg">
               <img src="<?php echo base_url('assets/images/fav.png'); ?>" alt="" style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
           </div>
           <span class="b-title">Sistem Manajemen Seminar</span>
       </a>
   </div>
   <a class="mobile-menu" id="mobile-header" href="#!">
       <i class="feather icon-more-horizontal"></i>
   </a>
   <div class="collapse navbar-collapse">
       <a href="#" class="mob-toggler"></a>
       <ul class="navbar-nav mr-auto">
           <li>
               <div class="page-header">
               </div>
           </li>
       </ul>
       <ul class="navbar-nav ml-auto">
       
        
           <li>
               <div class="dropdown drp-user">
                   <a href="#"  data-toggle="dropdown">
                       <i class="icon feather icon-user"></i>
                   </a>
                   <div class="dropdown-menu dropdown-menu-right profile-notification">
                       <div class="pro-head">
                           <img src="<?php echo base_url() ?>assets/images/widget/user.png" class="img-radius" alt="User-Profile-Image">
                           <span>Admin</span>
                           <a href="<?php echo site_url('logout') ?>" class="dud-logout" title="Logout">
                               <i class="feather icon-log-out"></i>
                           </a>
                       </div>
                   </div>
               </div>
           </li>
       </ul>
   </div>
</header>