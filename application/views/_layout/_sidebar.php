<?php $aktif = $this->uri->segment(1); ?>
<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MENU UTAMA</li>
    <li class = "<?php echo activate_menu('Beranda')?>"><a href="<?= base_url()?>Beranda"><i class="fa fa-dashboard"></i> <span>Beranda</span><span class="pull-right-container"></span></a></li>
    <li class="treeview <?php if ($aktif == 'Menu_1' || $aktif == 'Menu_bawahn') echo 'active' ?>">
        <a href="#"><i class="fa fa-database"></i> <span>Master Data</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
            <li class = "<?php echo activate_menu('Menu_1')?>"><a href="<?= base_url()?>Menu_1"><i class="fa fa-circle-o"></i>Menu v1</a></li>
            <li class = "<?php echo activate_menu('Menu_bawah')?>"><a href="<?= base_url()?>Menu_bawah"><i class="fa fa-circle-o"></i>Menu v2</a></li>
        </ul>
    </li>
</ul>