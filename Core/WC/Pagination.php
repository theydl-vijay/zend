<?php

/**
 * 
 */
class Core_WC_Pagination {
	
	function pagination($total, $offset, $limit, $page, $link='', $link_param=""){
        $pages = ceil($total / $limit);
        $start = $offset + 1;
        $first = false;
        $last = false;
        $display_last_pages = false;
        $first_pages_list = array();
        $last_pages_list = array();
        $page_to_be_displaied = array();
        $add_right_dots = false;
        if($page==$pages){
            $last = true;   
        }
        if($page==1){
            $first = true;
            $higher = 3;
            if($pages<$higher){
                $higher = $pages;
            }
            for($count = 1; $count <= $higher; $count++ ){
                array_push($page_to_be_displaied, $count);
            }
        }
        elseif($pages<=3){
            $higher = 3;
            if($pages<$higher){
                $higher = $pages;
            }
            if($page==$pages){
                $last = true;   
            }
            for($count = 1; $count <= $higher; $count++ ){
                array_push($page_to_be_displaied, $count);
            }   
        }
        if($pages>3){
            //first numbers
            $higher = 3;
            if($page==4){
                $higher = 4;    
            }
            elseif($page>4&&($pages-3)>=$page){
                array_push($last_pages_list, $page);
            }
            if($page>1){
                for($count = 1; $count <= $higher; $count++ ){
                    array_push($page_to_be_displaied, $count);
                }
            }
            //last numbers
            if($pages==4&&$page!=4){
                array_push($last_pages_list, 4);
            }
            elseif($pages==5){
                if($page!=4){
                    array_push($last_pages_list, 4);
                }
                array_push($last_pages_list, 5);
            }
            elseif($pages==6){
                if($page!=4){
                    array_push($last_pages_list, 4);
                }
                array_push($last_pages_list, 5);
                array_push($last_pages_list, 6);
            }
            elseif($pages>6){
                $display_last_pages = true;
                if(($pages-$page)>3&&$page>4){
                    array_push($last_pages_list, '...');
                }
                for($count = $pages-2; $count <= $pages; $count++){
                    array_push($last_pages_list, $count);
                }
            }
        }
        $back = $page-1;
        $next = $page+1;
        $back_link = $link.''.$back;
        $next_link = $link.''.$next;
        $page_avail = false;
        if(strpos($link, '{{page}}')){
            $page_avail = true;
            $back_link = str_replace('{{page}}', $back, $link);
            $next_link = str_replace('{{page}}', $next, $link);
        }
        if($total>$limit){
            $response = '<nav aria-label="Brands navigation" class="pagination-nav">
                        <ul class="pagination">';
            if(!$first){
                $response .= '      <li class="page-item"><a class="page-link" href="'.$back_link.'">&lt; &nbsp; Back</a></li>';
            }
            else{
                $response .= '      <li class="page-item"><a class="page-link">&lt; &nbsp; Back</a></li>';  
            }
            foreach($page_to_be_displaied as $value){
                $response .= '      <li class="page-item '.($value==$page?'active':'').'"><a class="page-link" href="'.($page_avail?str_replace('{{page}}', $value, $link):($link.''.$value)).'">'.$value.'</a></li>';
            }
            if($display_last_pages){
                $response .= '<li class="page-item">&nbsp;...&nbsp;</li>';
            }
            if(count($last_pages_list)>0){
                foreach($last_pages_list as $value){
                    if($value=='...'){
                        $response .= '<li class="page-item">&nbsp;...&nbsp;</li>';
                    }
                    else{
                        $response .= '      <li class="page-item '.($value==$page?'active':'').'"><a class="page-link" href="'.($page_avail?str_replace('{{page}}', $value, $link):($link.''.$value)).'">'.$value.'</a></li>';
                    }
                }
            }
            if(!$last){
                $response .= '      <li class="page-item"><a class="page-link" href="'.$next_link.'">Next  &nbsp; &gt;</a></li>';
            }
            else{
                $response .= '      <li class="page-item"><a class="page-link">Next  &nbsp; &gt;</a></li>'; 
            }
            $response .= '  </ul>
                        </nav>';    
        }
        else{
            $response = '';
        }
        return $response;
    }
}

?>