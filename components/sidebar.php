<?php

$Users = new Users();

?>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile border-bottom">
            <a href="#" class="nav-link flex-column">
                <div class="nav-profile-image">
                    <i class="mdi mdi-account-circle" style="font-size:70px;"></i>
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex ms-0 mb-3 flex-column">
                    <span class="font-weight-semibold mb-1 mt-2 text-center"><?= $Users->fullname($_SESSION['et_user_id']); ?></span>
                    <span class="text-secondary icon-sm text-center"><?= $Users->category($_SESSION['et_user_id']); ?></span>
                </div>
            </a>
        </li>
        <li class="nav-item pt-3">
            <a class="nav-link d-block" href="./">
                <center style="font-weight: bold;color: #c82a2b;">
                    <div class="small font-weight-light pt-1">LC Star Transport Cooperative</div>
                </center>
            </a>
        </li>
        <li class="pt-2 pb-1">
            <span class="nav-item-head">Menu</span>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="homepage">
                <i class="mdi mdi-compass-outline menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="buses">
                <i class="mdi mdi-bus menu-icon"></i>
                <span class="menu-title">Buses</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="drivers">
                <i class="mdi mdi-worker menu-icon"></i>
                <span class="menu-title">Drivers</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="transactions">
                <i class="mdi mdi-file-document-outline menu-icon"></i>
                <span class="menu-title">Transactions</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="trips">
                <i class="mdi mdi-road-variant menu-icon"></i>
                <span class="menu-title">Trips</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="trip-schedule">
                <i class="mdi mdi-calendar-clock menu-icon"></i>
                <span class="menu-title">Trip Schedule</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#sidebar-layouts" aria-expanded="false" aria-controls="sidebar-layouts">
                <i class="mdi mdi-playlist-play menu-icon"></i>
                <span class="menu-title">Reports</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="sidebar-layouts">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="bus-history">Bus History</a></li>
                    <li class="nav-item"> <a class="nav-link" href="daily-passengers">Daily VIP Passengers</a></li>
                    <li class="nav-item"> <a class="nav-link" href="passenger-complaints">Passenger Complaints</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="users">
                <i class="mdi mdi-account-multiple-plus menu-icon"></i>
                <span class="menu-title">Users</span>
            </a>
        </li>
    </ul>
</nav>