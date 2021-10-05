<?php
function alertBox($msg,$status=1)
{
    $type="alert-dark";
    $color="#000";

    if($status==0){
        $type="alert-danger";
        $color="#e74a3b";
    }
    else if($status==1){
        $type="alert-success";
        $color="#2ea500";
    }
    else if($status==2){
        $type="alert-warning";
        $color="#916d00";
    }
    return "
    
        <div class='alert $type d-flex justify-content-between align-items-center alert-box-message' role='alert'>
            <span>$msg</span>
            <div class='alert-box-close-icon RT-shadow' data-dismiss='alert' style='background-color:$color;'>
                <i class='fas fa-times'></i>
            </div>
        </div>

    ";
}
