<?php unset($_SESSION['message']); ?>

<div class="content animated fadeIn">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title" style="margin-bottom:10px;">Calendar of Events/Activities</h4>
                        <!-- <a type="button" class="btn btn-info btn-fill btn-wd" style="margin-bottom:10px;" data-toggle="modal" data-target="#requestEvent">
                            Add Event
                        </a> -->
                    </div>
                    <!-- Tab Group -->
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#calendar" data-toggle="tab">Calendar</a></li>
                        <li><a href="#add" data-toggle="tab">Add Event</a></li>
                        <li><a href="#requests" data-toggle="tab">Event Requests</a></li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="content tab-content">
                        <div class="legend">
                            <i class="fa fa-circle text-danger"></i> PREVIOUS
                            <i class="fa fa-circle text-info"></i> ONGOING
                            <i class="fa fa-circle text-success"></i> UPCOMING
                        </div>
                        <br>
                        <!-- Donations Page Directory -->
                        <div class="tab-pane active" id="calendar">
                            <div class="content animated fadeIn">
                                <div id='calendar'></div> <br>
                            </div>
                        </div>

                        <!-- Donations Page Directory -->
                        <div class="tab-pane" id="add">
                            <?php
                                include('pages/events-tab/add-event.php');
                            ?>
                        </div>

                        <!-- Send Donation Page Directory -->
                        <div class="tab-pane" id="requests">
                            <?php
                                include('pages/events-tab/requests.php');
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>