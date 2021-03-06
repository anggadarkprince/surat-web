<?php

$dashboard_active = "";
$mailbox_active = "";
$inbox_active = "";
$outbox_active = "";
$archive_active = "";
$report_active = "";
$today_active = "";
$week_active = "";
$all_active = "";
$setting_active = "";
$account_active = "";

if(isset($title)){
    switch($title){
        case "Dashboard":
            $dashboard_active = "active";
            break;
        case "Create In-mail":
        case "Edit In-mail":
        case "Detail In-mail":
        case "Inbox":
            $mailbox_active = "active";
            $inbox_active = "active";
            break;
        case "Create Out-mail":
        case "Edit Out-mail":
        case "Detail Out-mail":
        case "Outbox":
            $mailbox_active = "active";
            $outbox_active = "active";
            break;
        case "Archive":
            $mailbox_active = "active";
            $archive_active = "active";
            break;
        case "Today":
            $report_active = "active";
            $today_active = "active";
            break;
        case "Weekly":
            $report_active = "active";
            $week_active = "active";
            break;
        case "Report":
            $report_active = "active";
            $all_active = "active";
            break;
        case "Settings":
            $setting_active = "active";
            break;
        case "Account":
            $account_active = "active";
            break;
    }
}

?>
<!-- BEGIN SIDEBAR -->
<div class="sidebar">
    <div class="logopanel">
        <h1>
            <a href="dashboard.html"></a>
        </h1>
    </div>
    <div class="sidebar-inner">
        <div class="sidebar-top">
            <form action="http://themes-lab.com/make/admin/layout1/search-result.html" method="post"
                  class="searchform" id="search-results">
                <input type="text" class="form-control" name="keyword" placeholder="Search...">
            </form>
            <div class="userlogged clearfix">
                <i class="icon icons-faces-users-01"></i>

                <div class="user-details">
                    <h4><?=$this->session->userdata(User_model::$SESSION_NAME)?></h4>

                    <div class="dropdown user-login">
                        <button class="btn btn-xs dropdown-toggle btn-rounded" type="button" data-toggle="dropdown"
                                data-hover="dropdown" data-close-others="true" data-delay="300">
                            <i class="online"></i><span>Available</span><i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="busy"></i><span>Busy</span></a></li>
                            <li><a href="#"><i class="turquoise"></i><span>Invisible</span></a></li>
                            <li><a href="#"><i class="away"></i><span>Away</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-title">
            Navigation
            <div class="pull-right menu-settings">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                   data-close-others="true" data-delay="300">
                    <i class="icon-settings"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#" id="reorder-menu" class="reorder-menu">Reorder menu</a></li>
                    <li><a href="#" id="remove-menu" class="remove-menu">Remove elements</a></li>
                    <li><a href="#" id="hide-top-sidebar" class="hide-top-sidebar">Hide user &amp; search</a></li>
                </ul>
            </div>
        </div>
        <ul class="nav nav-sidebar">
            <li class="<?=$dashboard_active?>"><a href="<?=site_url()?>dashboard.html"><i class="icon-home"></i><span>Dashboard</span></a></li>
            <li class="nav-parent <?=$mailbox_active?>">
                <a href="#"><i class="icon-envelope"></i><span>Mailbox</span> <span class="fa arrow"></span></a>
                <ul class="children collapse">
                    <li class="<?=$inbox_active?>"><a href="<?=site_url()?>inbox.html"> Inbox</a></li>
                    <li class="<?=$outbox_active?>"><a href="<?=site_url()?>outbox.html"> Outbox</a></li>
                    <li class="<?=$archive_active?>"><a href="<?=site_url()?>archive.html"> Archive</a></li>
                </ul>
            </li>
            <li class="nav-parent <?=$report_active?>">
                <a href="#"><i class="icon-bar-chart"></i><span>Report</span> <span class="fa arrow"></span></a>
                <ul class="children collapse">
                    <li class="<?=$today_active?>"><a href="<?=site_url()?>report/today.html"> Today</a></li>
                    <li class="<?=$week_active?>"><a href="<?=site_url()?>report/week.html"> Last Week</a></li>
                    <li class="<?=$all_active?>"><a href="<?=site_url()?>report.html"> Statistic</a></li>
                </ul>
            </li>
        </ul>
        <!-- SIDEBAR WIDGET FOLDERS -->
        <div class="sidebar-widgets">
            <p class="menu-title widget-title">Configurations</p>
            <ul class="folders">
                <li class="<?=$setting_active?>">
                    <a href="<?= site_url() ?>settings.html"><i class="icon-settings"></i>Settings</a>
                </li>
                <li class="<?=$account_active?>">
                    <a href="<?= site_url() ?>account.html"><i class="icon-user"></i>My Account</a>
                </li>
                <li>
                    <a href="<?= site_url() ?>lockscreen.html"><i class="icon-lock"></i>Lockscreen</a>
                </li>
            </ul>
        </div>
        <div class="sidebar-footer clearfix">
            <a class="pull-left footer-settings" href="<?= site_url() ?>settings.html" data-rel="tooltip" data-placement="top"
               data-original-title="Settings">
                <i class="icon-settings"></i></a>
            <a class="pull-left toggle_fullscreen" href="#" data-rel="tooltip" data-placement="top"
               data-original-title="Fullscreen">
                <i class="icon-size-fullscreen"></i></a>
            <a class="pull-left" href="<?= site_url() ?>lockscreen.html" data-rel="tooltip" data-placement="top"
               data-original-title="Lockscreen">
                <i class="icon-lock"></i></a>
            <a class="pull-left btn-effect" href="<?= site_url() ?>logout.html" data-modal="modal-1" data-rel="tooltip"
               data-placement="top" data-original-title="Logout">
                <i class="icon-power"></i></a>
        </div>
    </div>
</div>
<!-- END SIDEBAR -->