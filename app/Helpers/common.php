<?php

use Illuminate\Support\Facades\DB;


/*
function getTopNavBar()

{
  $result = DB::table('navbars')
                //->where(['category_status'=>1])
                //->where('category_status', '=', 1)
                ->get();
  
  $arr=[];
  foreach($result as $row){
        $arr[$row->id]['category_name']=$row->category_name;
        $arr[$row->id]['parent_id']=$row->parent_category_id;
        $arr[$row->id]['category_slug']=$row->category_slug;
    }
	 //echo "<pre>";
	 //print_r($arr);
	 //die();
    $str=buildTreeView($arr,0);
    return $str;
	 
}


$html='';
function buildTreeView($arr,$parent,$level=0,$prelevel= -1){
	global $html;
	foreach($arr as $id=>$data){
		if($parent==$data['parent_id']){
			if($level>$prelevel){
				$html.='<li class="dropdown-child">';
				//$html.= '<ul class="img_hover">';
			}

			if($level==$prelevel){
				//$html.='</ul>';
        		
			}
		
		$html.=' <li><a href="#">'.$data['category_name'].'</a><img src="#" class="imgMenu active">';
		if($level>$prelevel){
				$prelevel=$level;
		}
			$level++;
			buildTreeView($arr,$id,$level,$prelevel);
			$level--;
		}
	}
	if($level==$prelevel){
		$html.='</li></ul>';
	}
	return $html;
}

*/

/*function getUserTempId(){
	$sessiondata = session()->get('USER_TEMP_ID');
	if($sessiondata != ''){
	  return session()->get('USER_TEMP_ID');
	}else{
	  $rand=rand(1111111, 99999999);
	  return session()->put('USER_TEMP_ID', $rand);
	}
  } */

?>