<?php
include('document_type.php');
include('db_connect.php');
?>
<head>
    <?php include('common_head.php'); ?>
    <meta charset='utf-8'>
    <title>Search Result</title>
</head>

<body id='body_one'>
<div id='main_body'>
<?php

include('header.php');
include('menu.php');
include('lib.php');
include('adv_search.php');

if ($_POST){
    $empty_input=0;
    $condition = "Results for your search: ";
    $sql = "SELECT ID, protein_name, organism FROM mads WHERE ";
    foreach(range(0,count($_POST['con'])-1) as $i){
        if($i!=0) {
            $condition = $condition." ".$_POST['con'][$i]." ";
            $sql = $sql.$_POST['con'][$i]." ";
        }
        $kw = $_POST['value'][$i];
        if(!$kw) {
            print ("<p align='center'>Empty input.</p>");
            $empty_input=1;
            break;
        }
	switch($_POST['field'][$i]){
	    case 'id':
		$condition = $condition."[id: ".$kw."]";
                $sql = $sql."(id LIKE {$kw}) ";
                break;
	    case 'protein':
                $condition = $condition."[protein name: ".$kw."]";
                $sql = $sql."(protein_name LIKE '%{$kw}%' OR protein_alias LIKE '%{$kw}%') ";
                break;
            case 'gene':
                $condition = $condition."[gene name: ".$kw."]";
                $sql = $sql."(gene_name LIKE '%{$kw}%' OR gene_alias LIKE '%{$kw}%') ";
                break;
	    default:
                $condition = $condition."[".$_POST['field'][$i].": ".$kw."]";
                $sql = $sql.$_POST['field'][$i]." LIKE '%{$kw}%' ";
        }
    }
    $sql = $sql.";";
    //print($sql);
    if(!$empty_input){
        $search_res = mysqli_query($conn, $sql);
        if (!$search_res->num_rows) print ("<p align='center'>Nothing found.</p>");
        else{
            echo "<p align='center'>{$condition}</p><br/>";
            echo "<div class='tbl_search'><table border='1' align='center'><tr><th class='tbl_title' width=5%>ID</th><th class='tbl_title'>Protein Name</th><th class='tbl_title' width=30%>Organism</th></tr>";

            while ($entry = mysqli_fetch_array($search_res, MYSQLI_ASSOC)){
                echo "<tr><td>{$entry['ID']}</td><td><a href='entry.php?id={$entry['ID']}'>{$entry['protein_name']}</a></td><td>".get_sp_name_full($entry['organism'])."</td></tr>";}

            echo "</table></div>";
        }
    }

}


mysqli_close($conn);

?>
<br/>
<?php include('footer.php');?>
</div>
</body>
</html>
