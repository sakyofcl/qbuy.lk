<?php
function SidebarUserDetail($name="royaltech",$role="admin"){
    return 
    "
    <div class='user-name'>".$name."</div>
    <div class='user-role'>".$role."</div>
    ";
} 
function SidebarUserImage($url){
    return 
    "
    <img alt='image' src='".$url."'>
    ";
}

function company($name,$img,$link){
    return
    "
    <a class='sidebar-brand d-flex align-items-center justify-content-center' href='".$link."'>
        <div class='sidebar-brand-icon rotate-n-15'>
            <img src='".$img."'/>
        </div>
        <div class='sidebar-brand-text mx-3'>".$name."</div>
    </a>

    ";
}
?>
