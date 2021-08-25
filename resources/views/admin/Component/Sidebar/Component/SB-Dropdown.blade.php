<?php



function dropdown($type = 'D-0', $name = 'default', $link = '#', $ico = '#', $sub = "", $id = "default")
{
    if ($type == 'D-0') {
        return "

    <li class='nav-item'>
        <a class='nav-link ' href='" . $link . "'>
            <i class='" . $ico . "'></i>
            <span>" . $name . "</span>
        </a>
    </li>

    ";
    } elseif ($type == 'D-1') {
        if (gettype($sub) == "array" && count($sub) != 0) {
            $subitem = "";
            foreach ($sub as $item) {
                $subitem = $subitem . "<a class='collapse-item' href=" . $item['link'] . ">" . $item['name'] . "</a>";
            }
            return "
                <li class='nav-item'>
                    <a class='nav-link collapsed text-capitalize' href='#' data-toggle='collapse' data-target='" . "#" . $id . "'
                        aria-expanded='true' aria-controls='collapseTwo'>
                            <i class='" . $ico . "'></i>
                            <span>" . $name . "</span>
                    </a>
                    <div id='" . $id . "' class='collapse'>
                        <div class='bg-white py-2 collapse-inner rounded'>
                            " . $subitem . "
                        </div>
                    </div>
                </li>
            ";
        }
    }
}


function dropdownHeader($name = 'default')
{
    return "<div class='sidebar-heading'>" . $name . "</div>";
}
