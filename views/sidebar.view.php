<?php require 'patials/head.php'; ?>

<body id="page-top">
    <div id="wrapper">

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
        <div class="sidebar-brand-text mx-2">smart Billing</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="/"><i class="fas fa-fw fa-tachometer-alt" style="color: #fff; font-size: 20px"></i><span>Dashboard</span></a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link collapsed" href="/manageuser"><i class="fas fa-fw fa-cogs fa-4x" style="color: silver; font-size: 20px"></i><strong>Manage Users</strong></a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link collapsed" href="/managedepartment"><i class="fas fa-fw fa-building" style="color: brown; font-size: 20px;"></i><strong>Manage unit</strong></a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link collapsed" href="/manageproduct"><i class="fas fa-fw fa-shopping-bag fa-4x" style="color: black; font-size: 20px"></i><strong>Manage Product</strong></a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#"><i class="fas fa-fw fa-chart-pie fa-4x" style="color:lightgreen; font-size: 20px;"></i><strong>Report</strong></a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link collapsed" href="#"><i class="fas fa-fw fa-power-off fa-4x" style="color:red; font-size: 20px;"></i><strong>LogOut</strong></a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<?php
require 'patials/footer.php';
//require 'modal/modal.php';
