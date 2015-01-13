<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $i=1;
        while($i<=200){
            $string .= $i .' ';
            $i++;
        }
        $string = trim($string);
        $store = explode(' ', $string);
        
        function data($str){
            return 'Paging in PHP: ' . $str;
        }
        
        $array = array_map(data, $store);
        $cnt = count($array);
        if($current_page == ""){
            $current_page = 1;
            $start = 0;
        }
        $num_display = 10;
        $max_page = ceil($cnt/$num_display);

        if($_GET['page'] <> ""){
            $current_page = $_GET['page'];
            $start = ($current_page-1) * $num_display;
        }
        $paging_mes = '<p>Current page is ' . $current_page . '.</p>'.
        '<p>' . ($start+1) . ' - ' . (($start)+$num_display) . ' are displayed.</p>';        
        if($current_page == $max_page){
            $paging_mes = '<p>Current page is ' . $current_page . '.</p>'.
            '<p>' . ($start+1) .' - ' . $cnt . ' are displayed.</p>';
        }
        if($cnt==0){
            $paging_mes = 'No data registered currently.';
        }
        echo $paging_mes;
        $content = array_slice($array, $start, $num_display);
        foreach($content as $val){
            echo $val . '<br />';
        }
         echo '<p>';
        if(($max_page<=10) && ($max_page != 1)){
            for($i=1;$i<=$max_page;$i++){
                echo '<a href="index.php?page=' .$i . '">[' . $i .']</a> ';
            }	
        }elseif(($max_page>10) && ($current_page<6)){
            for($a=1; $a<=10; $a++){
		echo '<a href="index.php?page=' . $a .'">[' . $a .']</a> ';
            }
        }elseif(($max_page > 10) && ($current_page>=6) && (($current_page+5) < $max_page)){
            echo '<a href="index.php?page=1">First </a>';
            for($a=1; $a<=5; $a++){
                echo '<a href="index.php?page=' . ($current_page-5+$a) . '">[' . ($current_page-5+$a) . ']</a> ';
            }
            for($a=1; $a<=5; $a++){
                echo '<a href="index.php?page=' . ($current_page+$a) . '">[' . ($current_page+$a) . ']</a> ';
            }
        echo '<a href="index.php?page=' . $max_page . '">Last</a>';
        }elseif(($max_page>10) && ($current_page>=6) && (($current_page+5) >= $max_page)){
            echo '<a href="index.php?page=1">First</a> ';
            $b = $max_page-10;
            while($b <= $max_page){
                echo '<a href="index.php?page=' . $b . '">[' . $b . ']</a> ';
                $b++;
            }
        }
        echo '<p>';
        if($current_page != 1){
            echo '<a href="index.php?page=' . ($current_page-1) . '"><< Previous Page</a>　';
        }
        if($current_page != $max_page){
            echo '<a href="index.php?page=' . ($current_page+1) . '">Next Page >></a>';
        }
        ?>
    </body>
</html>
