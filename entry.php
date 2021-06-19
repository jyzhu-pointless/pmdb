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
$retval = mysqli_query($conn, 'select * from mads where ID = '.$_GET["id"]);
$row = mysqli_fetch_assoc($retval);

echo "<h2 align='center'>{$row["protein_name"]}</h2>";

echo generate_basic_table($row);

echo "<br/>";

echo generate_seq_table($row);
echo "<br/>";

$sql = "SELECT * FROM domain_pos WHERE ID={$row['ID']} AND domain_name='SRF-TF'";
$domain_info = mysqli_query($conn, $sql);
$svg_arr = array();
$dom_arr = array();
while ($entry = mysqli_fetch_array($domain_info, MYSQLI_ASSOC)){
    $dom = $entry;
    $dom['svg'] = generate_domain_svg($entry);
    $dom_arr[] = $dom;
}
echo generate_domain_table($dom_arr);
echo "<br/>";
echo generate_GO_table($row['GO']);

?>

<?php
include('footer.php');
mysqli_close($conn);
?>
</div>
</body>
</html>
