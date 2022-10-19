<?php

$user_id = 30;
$query = "CALL `SP_Retrieve_Notifications`(".$user_id.",'','')";
$result = $conn->query($query);

foreach($result as $res) {
    // $user =  $result[0]['ID'];          
    // $username = $result[0]['user_login'];
    // $user_nickname = $result[0]['display_name'];
    // $gravatar = get_avatar( $result[0]['ID'] , $size = '32' );
    echo  '<div href="" class="dropdown-item">
                <h6>'.$res['_title'].'</h6>
                <p> 
                    <i class="user-icon"><img src="assets/images/key-grey.svg" alt="" /></i>
                    '.$res['_description'].'
                </p>
            </div> <script> console.log('.$result.') </>';
}
?>