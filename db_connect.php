<?php

$host = 'localhost';
$usr = 'leb4d';
$passwd = '08b995e85136';
$db = 'leb4d';
if (!($conn = @mysqli_connect($host, $usr, $passwd)))
{
	die('Connection denied!</br>' . mysqli_error());
}
mysqli_select_db($conn, $db) || die ('Cannot select database: '. $db . mysqli_error());
mysqli_query($conn, 'set character set utf8');

// echo 'Done.';

$table = 'mads';
//$retval = mysqli_query($conn, 'select * from mads');

//if ( ! $retval ) {
//	die ( 'Cannot get data: ' . mysqli_error() );
//}
// echo '<h3>Getting data from table mads ...<h3/>';
/*
echo '<table border="2">
	<tr>
	<td>ID</td>
	<td>protein_name</td>
	<td>organism</td>
	<td>taxon_ID</td>
	<td>lineage</td>
	<td>protein_length</td>
	<td>protein_mass</td>
	<td>sequence</td>
	<td>description</td>
	<td>GO</td>
	</tr>';

while ( $row = mysqli_fetch_array($retval, MYSQLI_ASSOC) )
{
	echo "<tr>
		<td>{$row['ID']}</td>
		<td>{$row['protein_name']}</td>
		<td>{$row['organism']}</td>
		<td>{$row['taxon_ID']}</td>
		<td>{$row['lineage']}</td>
		<td>{$row['protein_length']}</td>
		<td>{$row['protein_mass']}</td>
		<td>{$row['sequence']}</td>
		<td>{$row['description']}</td>
		<td>{$row['GO']}</td>
		</tr>";
}
echo '</table>';
mysqli_close($conn);
*/
?>
