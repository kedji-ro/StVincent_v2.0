<?php unset($_SESSION['message']); ?>

<div class="content animated fadeIn">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header" style="margin-bottom: 10px;">
                        <h4 class="title">Manage Inventory</h4><br>
                        <button class="btn btn-info btn-fill btn-sm" data-toggle="modal" data-target="#addItem"><i class="pe-7s-plus fa-lg"></i> Add Item</button>
                    </div>
                    
                    <!-- Tab Group -->
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#inventory" data-toggle="tab">Inventory</a></li>
                        <li><a href="#logs" data-toggle="tab">Logs</a></li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="content tab-content">

                        <!-- Donations Page Directory -->
                        <div class="tab-pane active" id="inventory">
                            <?php
                            include('pages/items-tabs/inventory.php');
                            ?>
                        </div>

                        <!-- Send Donation Page Directory -->
                        <div class="tab-pane" id="logs">
                            <?php
                            include('pages/items-tabs/logs.php');
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>