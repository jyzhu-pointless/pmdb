<?php
include('document_type.php');
include('db_connect.php');
include('lib.php');
?>

<html>
<head>
<?php include('common_head.php'); ?>
</head>
<body id='body_one'>
<div id='main_body'>

<?php
include('header.php');
include('menu.php');
?>

<?php
$organism_name = get_organism_name($conn);
/* print_r($organism_name);
echo '<br>';
 */
$retval = mysqli_query($conn, 'select * from mads where taxon_ID = '.$_GET["taxon"]);

echo '<h2 align="center">'.get_sp_name_full($organism_name[$_GET["taxon"]]).'</h2>';

echo "<div class='tbl_search'><table border='1' align='center'><tr><th>ID</th><th>Protein Name</th><th width=30%>Organism</th></tr>";

while ($row = mysqli_fetch_assoc($retval)){
    echo "<tr><td>{$row['ID']}</td><td><a href='entry.php?id={$row['ID']}'>{$row['protein_name']}</a></td><td>".get_sp_name_full($row['organism'])."</td></tr>";}

echo "</table></div>";

echo "<br/>";

?>

<?php
include('footer.php');
mysqli_close($conn);
?>
</div>
</body>
</html>
