 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 <img src="<?= base_url('assets/dist/img/') .  $user['image']; ?>" class="img-circle elevation-2" alt="User Image">
             </div>
             <div class="info">
                 <a href="#" class="d-block"><?= $user['name']; ?></a>
             </div>
         </div>


         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                 <!-- QUERY MENU -->
                 <?php
                    $role_id = $this->session->userdata('role_id');
                    $queryMenu = "SELECT `user_menu`.`id`, `menu`
                                FROM `user_menu` JOIN `user_access_menu`
                                ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                            WHERE `user_access_menu`.`role_id` = $role_id
                            ORDER BY `user_access_menu`.`menu_id` ASC
                            ";
                    $menu = $this->db->query($queryMenu)->result_array();
                    ?>

                 <!-- LOOPING MENU -->
                 <?php foreach ($menu as $m) : ?>
                     <a href="#" class="nav-link active">
                         <i class="nav-icon fas fa-book"></i>
                         <p>
                             <?= $m['menu']; ?>
                             <i class="fas right"></i>
                         </p>
                     </a>

                     <!-- SIAPKAN SUB-MENU SESUAI MENU -->
                     <?php
                        $menuId = $m['id'];
                        $querySubMenu = "SELECT *
                               FROM `user_sub_menu` JOIN `user_menu` 
                                 ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                              WHERE `user_sub_menu`.`menu_id` = $menuId
                                AND `user_sub_menu`.`is_active` = 1
                        ";
                        $subMenu = $this->db->query($querySubMenu)->result_array();
                        ?>
                     <?php foreach ($subMenu as $sm) : ?>
                         <?php if ($title == $sm['title']) : ?>
                             <li class="nav-item menu-open">
                             <?php else : ?>
                             <li class="nav-item">
                             <?php endif; ?>
                             <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
                                 <i class="<?= $sm['icon']; ?>"></i>
                                 <span><?= $sm['title']; ?></span></a>
                             </li>
                         <?php endforeach; ?>

                     <?php endforeach; ?>

                     <li class="nav-item">
                         <a href="<?= base_url('auth/logout'); ?>" class="nav-link">
                             <i class="nav-icon far fa-circle text-info"></i>
                             <p>Logout</p>
                         </a>
                     </li>
             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>