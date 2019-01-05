<?php
if ( !empty($chats) ) {
    foreach ($chats as $key => $value) {
        $who = ( $uid == $value->from_friend ) ? 'You' : 'Friend';
?>
    <li class="list-group-item"> <span class="badge">
        <?php echo $who; ?>: </span> 
        <?php echo $value->message; ?>
    </li>
<?php
    }
}
else {
?>
    <li class="list-group-item"> NO CHATS YET!. </li>
<?php
}
?>