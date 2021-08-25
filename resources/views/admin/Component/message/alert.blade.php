<?php
function alertMsg($type, $msg, $display = "d-none")
{
    return "
    
    <div class='alert text-capitalize border RT-radius  $display justify-content-between align-items-center $type' role='alert' id='alert-msg'>
        <span id='alert-msg-span'>" . $msg . "</span>
        <i class='fas fa-times-circle alert-close-btn' id='alert-close-btn'></i>
    </div>
    
    ";
}
