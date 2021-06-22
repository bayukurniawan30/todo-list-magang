<?php
    if ($cat == NULL) {
        $todayUrl    = 'index.php?page=dashboard&assign=today';
        $tomorrowUrl = 'index.php?page=dashboard&assign=tomorrow';
        $upcomingUrl = 'index.php?page=dashboard&assign=upcoming';
    }
    else {
        $todayUrl    = 'index.php?page=dashboard&cat='.$cat.'&assign=today';
        $tomorrowUrl = 'index.php?page=dashboard&cat='.$cat.'&assign=tomorrow';
        $upcomingUrl = 'index.php?page=dashboard&cat='.$cat.'&assign=upcoming';
    }
?>
<div class="" style="width: 100%">
    <div class="uk-background-default uk-box-shadow-small">
        <nav class="uk-container" uk-navbar>
            <div class="uk-navbar-left">
                <a class="uk-navbar-item uk-logo" href="index.php?page=dashboard">ToDo List</a>
            </div>
            <div class="uk-navbar-right">
                <a class="uk-navbar-toggle uk-hidden@m" uk-navbar-toggle-icon href="#" uk-toggle="target: #offcanvas-nav"></a>
                <ul class="uk-navbar-nav uk-visible@m">
                    <li class="<?= $assign == 'today' ? 'uk-active' : '' ?>">
                        <a href="<?= $todayUrl ?>">
                            Today
                        </a>
                    </li>
                    <li class="<?= $assign == 'tomorrow' ? 'uk-active' : '' ?>">
                        <a href="<?= $tomorrowUrl ?>">
                            Tomorrow
                        </a>
                    </li>
                    <li class="<?= $assign == 'upcoming' ? 'uk-active' : '' ?>">
                        <a href="<?= $upcomingUrl ?>">
                            Upcoming
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="uk-margin-small-left" uk-icon="icon: user"></span>
                        </a>
                        <div class="uk-navbar-dropdown" uk-dropdown="offset: 0">
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li>
                                    <a class="uk-text-bold" href="#">Hai <?= $user->first_name . ' ' . $user->last_name ?></a>
                                </li>
                                <li><a href="include/action/signout.php">Sign Out</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>

<div id="offcanvas-nav" uk-offcanvas="overlay: true">
    <div class="uk-offcanvas-bar">
        <ul class="uk-nav uk-nav-default">
            <li class="uk-active">
                <a href="#">
                    <strong><?= strtoupper($user->first_name . ' ' . $user->last_name) ?></strong>
                </a>
            </li>
            <li class="uk-nav-divider"></li>
            <li class="<?= $assign == 'today' ? 'uk-active' : '' ?>">
                <a href="<?= $todayUrl ?>">
                    Today
                </a>
            </li>
            <li class="<?= $assign == 'tomorrow' ? 'uk-active' : '' ?>">
                <a href="<?= $tomorrowUrl ?>">
                    Tomorrow
                </a>
            </li>
            <li class="<?= $assign == 'upcoming' ? 'uk-active' : '' ?>">
                <a href="<?= $upcomingUrl ?>">
                    Upcoming
                </a>
            </li>
            <li class="uk-nav-divider"></li>
            <li class="">
                <a href="include/action/signout.php">
                Sign Out
                </a>
            </li>
        </ul>
    </div>
</div>