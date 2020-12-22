<?php 
//custom pagination here

function custom_pagination($page, $totalpage, $link, $show)  //$link = '&page=%s' 
{ 
   //show page 
if($totalpage == 0) 
{ 
return 'Page 0 of 0'; 
} else { 
   $nav_page = '<div class="w3-bar"><span class="currents">Page '.$page.' of '.$totalpage.' : </span>'; 
   $limit_nav = 3; 
   $start = ($page - $limit_nav <= 0) ? 1 : $page - $limit_nav; 
   $end = $page + $limit_nav > $totalpage ? $totalpage : $page + $limit_nav; 
   if($page + $limit_nav >= $totalpage && $totalpage > $limit_nav * 2){ 
       $start = $totalpage - $limit_nav * 2; 
   } 
   if($start != 1){ //show first page 
       $nav_page .= '<a href="'.sprintf($link, 1).'" class="currents"> 1 </a>'; 
   } 
   if($start > 2){ //add ... 
       $nav_page .= '<span class="currents">...</span>'; 
   } 
   if($page > 5){ //add prev 
       $nav_page .= '<span class="item1"><a href="'.sprintf($link, $page-5).'">&laquo;</a></span>'; 
   } 
   for($i = $start; $i <= $end; $i++){ 
       if($page == $i) 
           $nav_page .= '<span class="currents">'.$i.'</span>'; 
       else 
           $nav_page .= '<span class="item1"><a href="'.sprintf($link, $i).'"> '.$i.' </a></span>'; 
   } 
   if($page + 3 < $totalpage){ //add next 
       $nav_page .= '<span class="item1"><a href="'.sprintf($link, $page+4).'">&raquo;</a></span>'; 
   } 
   if($end + 1 < $totalpage){ //add ... 
       $nav_page .= '<span class="currents">...</span>'; 
   }     
   if($end != $totalpage) //show last page 
       $nav_page .= '<span class="item1"><a href="'.sprintf($link, $totalpage).'"> '.$totalpage.'</a></span>'; 
   $nav_page .= '</div>'; 
   return $nav_page; 
} 
} 
?>