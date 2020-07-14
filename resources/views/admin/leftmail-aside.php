<?php $menu = (new App\UserRole())->getUserMenus();
?>
<style>
    .plus {
        margin-top: 2px;
    }

    .pull-center a {
        padding-left: 15% !important
    }

    .sidebar-menu>li:hover>a,
    .sidebar-menu>li.active>a {
        color: #333 !important;
        background: #d8d6d6 !important;
    }


</style>

<!-- Left side column. contains the logo and sidebar -->
<aside id="sidebar" class="main-sidebar admn widget-scroll">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <ul class="sidebar-menu">
            <?php if ($menu == []) : ?>

            <?php else : ?>
                <?php foreach ($menu as $item) : ?>
                    <li class="treeview">
                        <?php if (count($item['childs']) == 0) : ?>
                            <a data-async="fullpage" href="<?php echo url($item['url']); ?>">
                            <?php else : ?>
                                <a href="#">
                                    <i class="fa fa-plus pull-right"></i>
                                <?php endif; ?>
                                <i class="<?php echo $item['icon']; ?>" style="font-size: 20px !important"></i>
                                <span class="menu-span"> <?php echo $item['name']; ?> </span>
                                </a>
                                <?php if (!empty($item['childs'])) : ?>
                                    <ul class="treeview-menu">
                                        <?php foreach ($item['childs'] as $cItems) : ?>
                                            <li class="pull-center">
                                                <a data-async="fullpage" href="<?php echo url('/') . '/' . $cItems->menu_url; ?>"><?php echo $cItems->menu_name; ?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>

    </section>
    <!-- /.sidebar -->

</aside>
<!--start dragbar-->

<!-- end dragbar-->
<!-- Content Wrapper. Contains page content -->
<div id="main" class="content-wrapper admn">
    <!-- <div id="dragbar" class=""></div> -->
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <div class="row">
        <section id="main-body" class="content col-lg-12">