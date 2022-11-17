<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
    if(isset($_GET['1'])!=null) {
        echo '<div class="alert alert-danger" role="alert" style="border-radius:0px;">Your input does not match our records.</div>';
        unset($_GET['1']);
    }

    if(isset($_GET['2'])!=null) {
        echo '<div class="alert alert-danger" role="alert" style="border-radius:0px;">Account unverified. Please check your email for verification.</div>';
        unset($_GET['2']);
    }

    if(isset($_GET['3'])!=null) {
        echo '<div class="alert alert-success" role="alert" style="border-radius:0px;">Registration successful! Please check your email for verification.</div>';
        unset($_GET['3']);
    }

    if(isset($_SESSION['message']))
    {
        if ($_SESSION['message'] == 1) {
            echo '<div class="alert alert-danger" role="alert">Your input does not match our records.</div>';
        }

        elseif ($_SESSION['message'] == 2) {
            echo '<div class="alert alert-danger" role="alert">Account unverified. Please check your email for verification.</div>';
        }
        
        elseif ($_SESSION['message'] == 3) {
            echo '<div class="alert alert-success" role="alert">Registration successful! Please check your email for verification.</div>';
        }

        else {
            echo '<div class="alert alert-'.$_SESSION['alert-message'].'" role="alert">'.$_SESSION['message'].'</div>';
        }

        unset($_SESSION['message']);
    }
?>