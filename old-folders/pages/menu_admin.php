<ul>
    <li class="nav-link">
        <a class="nav-item animsition-link <?php echo (isset($_GET['patient'])!=null)? 'active': ''; ?>" href="?patient" title="Manage Patient"> 
            <i class="nav-icon fa fa-user font-25"></i>
            <span>Patient Info</span>
        </a>
    </li> 
    <li class="nav-link">
        <a class="nav-item animsition-link <?php echo (isset($_GET['account'])!=null)? 'active': ''; ?>" href="?account" title="User Account">
            <i class="nav-icon fa fa-users font-25"></i>
            <span>User Account</span>
        </a>
    </li> 
    <li class="nav-link">
        <a class="nav-item animsition-link <?php echo (isset($_GET['donation'])!=null)? 'active': ''; ?>" href="?donation" title="Donation">
        <i class="nav-icon fa fa-money font-25"></i>
            <span>Donation</span>
        </a>
    </li> 
    <li class="nav-link">
        <a class="nav-item animsition-link <?php echo (isset($_GET['employee'])!=null)? 'active': ''; ?>" href="?employee" title="Employee/ Volunteer">
            <i class="nav-icon fa fa-handshake-o font-25"></i>
            <span>Employee/ Volunteer</span>
        </a>
    </li> 
    <li class="nav-link">
        <a class="nav-item animsition-link <?php echo (isset($_GET['inventory'])!=null)? 'active': ''; ?>" href="?inventory" title="Item/ Inventory">
            <i class="nav-icon fa fa-list-alt font-25"></i>
            <span>Item/ Inventory</span>
        </a>
    </li> 
    <li class="nav-link">
        <a class="nav-item animsition-link <?php echo (isset($_GET['activity'])!=null)? 'active': ''; ?>" href="?activity" title="Event/ Activity">
            <i class="nav-icon fa fa-calendar font-25"></i>
            <span>Event/ Activity</span> 
            <span id="pending_event" class="badge badge-warning py-1" style="border-radius: 4rem!important;margin-left: 10px;font-size: 16px;position: absolute;"></span>
        </a>
    </li> 
    <li class="nav-link">
        <a class="nav-item animsition-link <?php echo (isset($_GET['settings'])!=null)? 'active': ''; ?>" href="?settings" title="Settings">
            <i class="nav-icon fa fa-cogs font-25"></i>
            <span>Settings</span>
        </a>
    </li> 
</ul>