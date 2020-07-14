<?php

use \App\MenuGroup;
use \App\Role;

$menu = (new MenuGroup())->fetchMenu();
?>

<!-- Left side column. contains the logo and sidebar -->
<aside id="sidebar" class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search Mails and Peoples">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search rotate-90"></i>
                    </button>
                </span>
            </div>
        </form>

        <?php
        $menus = Role::listMenus();
        $data = [];
        foreach ($menus as $m) {
            $data[] = $m->id;
        }
        $groups = DB::table('menu_group_route')->select('group_id')->distinct('group_id')->whereIn('route_id', $data)->get();
        $groupIds = (function() use ($groups) {
                    $gids = [];
                    foreach ($groups as $gp) {
                        $gids[] = $gp->group_id;
                    }
                    return $gids;
                })();
        ?>

        <ul class="sidebar-menu">
            <?php foreach ($menu as $item): ?>
    <?php if ($item['type'] == 'g'): ?>
        <?php if (!in_array($item['id'], $groupIds)) {
            continue;
        } ?>
                    <li class="treeview">
                        <a href="#">
                            <i class="<?php echo $item['icon']; ?>" style="font-size: 20px !important"></i>            
                            <span class="menu-span"><?php echo $item['name']; ?></span>
                            <i class="fa fa-plus pull-right plus" ></i>
                        </a>
                            <?php if (isset($item['childs']) && is_array($item['childs'])): ?>
                            <ul class="treeview-menu">
                                <?php foreach ($item['childs'] as $m): ?>
                <?php if(!in_array($m->id,$data)){ continue;} ?>
                                    <li class="pull-center"><a data-async="fullpage" href="<?php echo url('/').'/'.$m->route; ?>"> <?php echo $m->{t_field('name')}; ?></a></li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                        </ul>
                    </li>
    <?php else: ?>
        <?php if (!in_array($item['childs']->id, $data)) {
            continue;
        } ?>
                    <li class="treeview">
                        <a data-async="fullpage" href="<?php echo url('/').'/'.$item['childs']->route; ?>"> 
                            <i class="<?php echo $item['childs']->icon; ?>" style="font-size: 20px !important"></i>            
                            <span class="menu-span"> <?php echo $item['childs']->{t_field('name')} ?> </span>
                        </a>
                    </li>
    <?php endif;
endforeach;
?>
        </ul>
        <div class="aside-bottom-menu">
            <div class=" margin-left-5">
                <a href="index.html"><div class="pull-left col-sm-2 font-size active"><i class="fa fa-envelope" aria-hidden="true"></i></div></a> 
                <a href="calendar.html"> <div class="pull-left col-sm-2 font-size"><i class="fa fa-calendar" aria-hidden="true"></i></div></a>
                <a href="people.html"><div class="pull-left col-sm-2 font-size"><i class="fa fa-users" aria-hidden="true"></i></div></a>
                <a href="tasks.html"><div class="pull-left col-sm-2 font-size"><i class="fa fa-check-square-o" aria-hidden="true"></i></div></a>
            </div>
        </div>

    </section>
    <!-- /.sidebar -->

</aside>
<!--start dragbar-->

<!-- end dragbar-->
<!-- Content Wrapper. Contains page content -->
<div id="main" class="content-wrapper" style="min-height:400px !important;">
    <div id="dragbar" class=""></div>
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <div class="row" >
        <section id="main-body" class="content col-lg-12">