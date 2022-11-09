<!--navigation-->
<div class="nav-container">
    <div class="mobile-topbar-header">
        <div>
            <img src="{{ asset('assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">VMS</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <nav class="topbar-nav">
        <ul class="metismenu" id="menu" style="display:none;">
            <li>
                <a href="{{ route('dashboard') }}" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
            <li class="active">
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-category"></i>
                    </div>
                    <div class="menu-title">Settings</div>
                </a>
                <ul class="sublist">
                    <li> <a href="{{ route('department') }}"><i class="bx bx-right-arrow-alt"></i>Departments</a>
                    </li>
                    <li> <a href="{{ route('court') }}"><i class="bx bx-right-arrow-alt"></i>Courts</a>
                    </li>
                    <li> <a href="{{ route('role') }}"><i class="bx bx-right-arrow-alt"></i>Roles</a>
                    </li>
                    <li> <a href="{{ route('badge') }}"><i class="bx bx-right-arrow-alt"></i>Badges</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-category"></i>
                    </div>
                    <div class="menu-title">Staff</div>
                </a>
                <ul>
                    <li> <a href="{{ route('employees.create') }}"><i class="bx bx-right-arrow-alt"></i>Add Employee</a>
                    </li>
                    <li> <a href="{{ route('employees.index') }}"><i class="bx bx-right-arrow-alt"></i>View Employee</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon icon-color-6"> <i class="bx bx-category"></i>
                    </div>
                    <div class="menu-title">Offices</div>
                </a>
                <ul>
                    <li> <a href="{{ route('offices.create') }}"><i class="bx bx-right-arrow-alt"></i>Add Office</a>
                    </li>
                    <li> <a href="{{ route('offices.index') }}"><i class="bx bx-right-arrow-alt"></i>View Offices</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon icon-color-6"> <i class="bx bx-category"></i>
                    </div>
                    <div class="menu-title">Out of Office</div>
                </a>
                <ul>
                    <li> <a href="list-attendance.html"><i class="bx bx-right-arrow-alt"></i>Attendance</a>
                    </li>
                    <li> <a href="list-leave.html"><i class="bx bx-right-arrow-alt"></i>Leaves</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class='bx bx-category'></i>
                    </div>
                    <div class="menu-title">Visitors</div>
                </a>
                <ul>
                    <li> <a href="{{ route('visitors.index') }}"><i class="bx bx-right-arrow-alt"></i>Visitors</a>
                    </li>
                    <li> <a href="{{ route('appointments.index') }}"><i class="bx bx-right-arrow-alt"></i>Appointments</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class='bx bx-category'></i>
                    </div>
                    <div class="menu-title">Reports</div>
                </a>
                <ul>
                    <li> <a href="#"><i class="bx bx-right-arrow-alt"></i>Visitor Reports</a>
                    </li>
                    <li> <a href="#"><i class="bx bx-right-arrow-alt"></i>Appointment Reports</a>
                    </li>
                </ul>
            </li>

        </ul>
    </nav>
</div>
<!--end navigation-->