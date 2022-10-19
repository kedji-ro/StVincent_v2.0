<ul> 
    <li class="nav-link">
        <a class="nav-item animsition-link <?php echo (isset($_GET['activitylists'])!=null)? 'active': ''; ?>" href="?activitylists" title="Event/ Activity">
            <i class="nav-icon fa fa-calendar font-25"></i>
            <span>Event/ Activity</span>
        </a>
    </li> 
    <li class="nav-link">
        <a class="nav-item animsition-link <?php echo (isset($_GET['mydonation'])!=null)? 'active': ''; ?>" href="?mydonation" title="My Donation">
        <i class="nav-icon fa fa-money font-25"></i>
            <span>My Donation</span>
        </a>
    </li>  
    <li class="nav-link">
        <a class="nav-item animsition-link <?php echo (isset($_GET['mysettings'])!=null)? 'active': ''; ?>" href="?mysettings" title="Settings">
            <i class="nav-icon fa fa-cogs font-25"></i>
            <span>Settings</span>
        </a>
    </li> 
</ul>