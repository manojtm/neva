<?php
if ( !empty($friends) ) {
    foreach ($friends as $key => $value) {
?>
    <tr>
        <td> <?php echo $value['first_name'].' '.$value['last_name']; ?> </td>
        <td>
            <button class="btn btn-sm btn-info f-chat" onclick="chat(<?php echo $value['id']; ?>, '<?php echo $value['first_name']; ?>');" data-fid="<?php echo $value['id']; ?>">Chat</button>
        </td>
    </tr>
<?php
    }
}
else {
?>
    <tr>
        <td colspan="2">No Friends Added Yet.</td>
    </tr>
<?php
}
?>