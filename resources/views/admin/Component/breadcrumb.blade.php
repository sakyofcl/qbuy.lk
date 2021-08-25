<?php 
function breadcrumb($active,$path=""){
    
    if(gettype($path)=="array" && count($path)!=0){
        $store="";
        foreach($path as $item){
            $store=$store."<li class='breadcrumb-item'><a class='text-capitalize' href=".$item['link'].">".$item['name']."</a></li>";
        }
    }
    else{
        $store="empty"; 
    }
    return"
    <nav aria-label='breadcrumb'>
        <ol class='breadcrumb bg-white RT-shadow RT-radius p-3'>
            ".$store."
            <li class='breadcrumb-item active text-capitalize' aria-current='page'>".$active."</li>
        </ol>
    </nav>
    ";
}
?>

