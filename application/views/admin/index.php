<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Users Statistic</h1>
                        </div>
                    </div>
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <!-- ./col -->
                        <!-- small box -->
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Total User & Admins</span>
                                    <?php

                                    $query = $this->db->query('SELECT * FROM user WHERE `is_active`=1');
                                    $onlyAdmin  = $query->num_rows();
                                    ?>
                                    <span class="info-box-number">
                                        <?= $onlyAdmin ?>
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box">
                                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users-cog"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Admins</span>
                                    <?php

                                    $query = $this->db->query('SELECT * FROM user WHERE `role_id`=1');
                                    $onlyAdmin  = $query->num_rows();
                                    ?>
                                    <span class="info-box-number">
                                        <?= $onlyAdmin ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box">
                                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Users</span>
                                    <?php

                                    $query = $this->db->query('SELECT * FROM user WHERE `role_id`=2');
                                    $onlyUser  = $query->num_rows();
                                    ?>
                                    <span class="info-box-number">
                                        <?= $onlyUser ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List of Users</h3>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 1%">
                                        #
                                    </th>
                                    <th style="width: 20%">
                                        Name
                                    </th>
                                    <th style="width: 30%">
                                        Email
                                    </th>
                                    <th style="width: 30%">
                                        Address
                                    </th>
                                    <th style="width: 30%">
                                        Role Type
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($x as $r) : ?>
                                    <tr>
                                        <td>
                                            <?= $i; ?>
                                        </td>
                                        <td>
                                            <?= $r['name']; ?>
                                        </td>
                                        <td>
                                            <?= $r['email']; ?>
                                        </td>
                                        <td>
                                            <?= $r['address']; ?>
                                        </td>
                                        <td>
                                            <?php if ("1" == $r['role_id']) : ?>
                                                Admin
                                            <?php else : ?>
                                                Member
                                            <?php endif; ?>


                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </section>
            <!-- /.content -->




        </div>
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->