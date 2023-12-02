<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="dashboard.php" class="brand-link d-flex justify-content-around pb-2 text-center">
        <h2 class="brand-text font-weight-bold">MMS</h2>
        <div class="brand-text font-weight-bold mt-2" id="time"></div>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-4 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/user-profile-min.png" alt="">
            </div>
            <div class="info">
                <a href="account" class="d-block"><?php echo $_SESSION['Firstname'] . " " . $_SESSION['Lastname']; ?></a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview">
                    <a href="dashboard" class="nav-link d-flex justify-content-between">
                        <div style="<?php if ($head == 'Dashboard') {
                                        echo "border-left: 3px solid #ffffff; border-radius: 2px;";
                                    } ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </div>
                    </a>
                </li>
                <li class="nav-header font-weight-bold">Your All Account</li>
                <li class="nav-item">
                    <a href="account" class="nav-link">
                        <div style="<?php if ($head == 'Account') {
                                        echo "border-left: 3px solid #ffffff; border-radius: 2px;";
                                    } ?>">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Account</p>
                        </div>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-university"></i>
                        <p>
                            Bank Account
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="bank-account-main" class="nav-link">
                                <p>Account Main</p>
                            </a>
                        </li>
                        <div class="nav-item">
                            <a href="bank-account-saving" class="nav-link">
                                <p>Account Saving</p>
                            </a>
                        </div>
                    </ul>
                </li>
                <li class="nav-header font-weight-bold">Manage Money</li>
                <li class="nav-item">
                    <a href="income" class="nav-link">
                        <div style="<?php if ($head == 'Income') {
                                        echo "border-left: 3px solid #ffffff; border-radius: 2px;";
                                    } ?>">
                            <i class="nav-icon fas fa-hand-holding-usd"></i>
                            <p>Income</p>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="expenese" class="nav-link">
                        <div style="<?php if ($head == 'Expenese') {
                            echo "border-left: 3px solid #ffffff; border-radius: 2px;";
                        } ?>">
                            <i class="nav-icon fas fa-coins"></i>
                            <p>Expenese</p>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="saving" class="nav-link">
                        <div style="<?php if ($head == 'Saving') {
                            echo "border-left: 3px solid #ffffff; border-radius: 2px;";
                        } ?>">
                            <i class="nav-icon fas fa-piggy-bank"></i>
                            <p>Saving</p>
                        </div>
                    </a>
                </li>
                <li class="nav-header font-weight-bold">More Options</li>
                <li class="nav-item">
                    <a href="calendar" class="nav-link">
                        <div style="<?php if ($head == 'Calendar/Events') {
                            echo "border-left: 3px solid #ffffff; border-radius: 2px;";
                        } ?>">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>Calendar/Events</p>
                        </div>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>