<div class="content animated fadeIn">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header" style="margin-bottom: 10px;">
                        <h4 class="title">My Donations</h4>
                    </div>
                    <!-- Tab Group -->
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#donationList" data-toggle="tab">Donations</a></li>
                        <li><a href="#sendDonation" data-toggle="tab">Send Donation</a></li>
                        <li><a href="#beVolunteer" data-toggle="tab">Be a Volunteer</a></li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="content tab-content">

                        <!-- Donations Page Directory -->
                        <div class="tab-pane active" id="donationList">
                            <?php
                            include('../dashboard/pages/donation-tabs/donation-list.php');
                            ?>
                        </div>

                        <!-- Send Donation Page Directory -->
                        <div class="tab-pane" id="sendDonation">
                            <?php
                            include('../dashboard/pages/donation-tabs/donation-send.php');
                            ?>
                        </div>

                        <!-- Be a Volunteer Page Directory -->
                        <div class="tab-pane" id="beVolunteer">
                            <?php
                            include('../dashboard/pages/donation-tabs/donation-volunteer.php');
                            ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>