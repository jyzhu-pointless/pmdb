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
$kw = $_POST['keyword'];
if (! $kw) {print ("<p align='center'>No keyword.</p>");}
    else{


    $sql = "SELECT ID, protein_name, organism FROM mads WHERE protein_name LIKE '%{$kw}%' OR protein_alias LIKE '%{$kw}%' OR gene_name LIKE '%{$kw}%' OR gene_alias LIKE '%{$kw}%';";
    $search_res = mysqli_query($conn, $sql);
    $sql = "SELECT ID, protein_name, organism FROM mads WHERE description LIKE '%{$kw}%';";
    $search_res_d = mysqli_query($conn, $sql);
    if ((!$search_res->num_rows) and (!$search_res_d->num_rows)){
        print ("<p align='center'>Nothing found about this keyword: {$kw}</p>");
    }
    else{
        if ($search_res->num_rows){
        echo "<p align='center'>Protein name or gene name containing this keyword: {$kw}</p><br/>";
        echo "<div class='tbl_search'><table border='1' align='center'><tr><th width=5%>ID</th><th>Protein Name</th><th width=30%>Organism</th></tr>";

        while ($entry = mysqli_fetch_array($search_res, MYSQLI_ASSOC)){
            echo "<tr><td>{$entry['ID']}</td><td><a href='entry.php?id={$entry['ID']}'>{$entry['protein_name']}</a></td><td>".get_sp_name_full($entry['organism'])."</td></tr>";}

        echo "</table></div>";
        }

        echo "<br/>";

        if ($search_res_d->num_rows){
        echo "<p align='center'>Description containing this keyword: {$kw}</p><br/>";
        echo "<div class='tbl_search'><table border='1' align='center'><tr><th width=5%>ID</th><th>Protein Name</th><th width=30%>Organism</th></tr>";

        while ($entry = mysqli_fetch_array($search_res_d, MYSQLI_ASSOC)){
            echo "<tr><td>{$entry['ID']}</td><td><a href='entry.php?id={$entry['ID']}'>{$entry['protein_name']}</a></td><td>".get_sp_name_full($entry['organism'])."</td></tr>";}

        echo "</table></div>";
        }
    }
}

mysqli_close($conn);

?>
<br/>
<p align='center'>Not wanted results? Try <a href='adv_search_result.php'>Advanced Search</a>.</p>
<?php include('footer.php');?>
</div>
</body>
</html>
