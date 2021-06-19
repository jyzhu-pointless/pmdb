<?php
include('document_type.php');
include('db_connect.php');
include('lib.php');
include('species_name.php');
if(isset($_GET['sp'])){
	$para_sp=addslashes($_GET['sp']);
	$para_sp=htmlspecialchars(strip_tags(trim($para_sp)));
	$sp = $para_sp;
	$sp=substr($sp,0,3);
}
if(isset($_GET['fam'])){
	$para_fam=addslashes($_GET['fam']);
	$para_fam=htmlspecialchars(strip_tags(trim($para_fam)));
	$fam = $para_fam;
}
?>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<?php include('common_head.php'); ?>
</head>
<body id='body_one'>
<div id='main_body'><?php include('header.php'); ?> <?php include('menu.php'); ?>
<div class='title_one'>
<div class='species_name'><?php if (isset($sp)) {echo $sp_name[$sp];} ?></div> <?php echo $fam?> Family
</div>
<div class='family_info'>
<ul>
	<li><a href='#family_intro'><?php echo $fam;?> Family Introduction</a></li>
	<?php if (isset($sp)) {?>
	<li><a href='/download_seq.php?sp=<?php echo $sp;?>&amp;fam=<?php echo $fam;?>'>Download Sequences</a></li>
	<li><a href='/msa.php?sp=<?php echo $sp;?>&amp;fam=<?php echo $fam;?>'>Multiple Sequences Alignment</a></li>
	<li><a href='/phylo_tree.php?sp=<?php echo $sp;?>&amp;fam=<?php echo $fam;?>'>Phylogenetic Tree</a></li>
	<?php 
	}
	else if (isset($fam)) {
	?>
	<li><a href='/download_seq.php?fam=<?php echo $fam;?>'>Download Sequences</a></li>
	<li><a href='/msa.php?fam=<?php echo $fam;?>'>Multiple Sequences Alignment</a></li>
	<li><a href='/phylo_tree.php?fam=<?php echo $fam;?>'>Phylogenetic Tree</a></li>
	<?php 
	}
	?>
</ul>
</div>

	<?php
	$sql_array = array();
	if (isset($sp)) {
		$t_fam = $sp . '_family';
		$sql_array[$sp] = "select display_id, protein_id, family from $t_fam where $t_fam.family = '$fam'";
	}
	else {
		foreach (array_keys($sp_name) as $sp) {
			$t_fam = $sp . '_family';
			//$sql_array[$sp] = "select * from $t_fam where $t_fam.family = '$fam'";
		}
		echo '<div class="title_two">Distribution of ', $fam, ' family in different species</div>';
		echo '<div class="column_content">(G)-species with genome sequence</div>';
		echo "<img src='draw_family_distribution.php?fam=$fam' usemap='#distrimap' style='border: none' alt='Distribution' />";
		// Create Area
		$x_base = 20;
		$y_base = 20;
		$x_end = 700;
		$px_dist = 18; 
		$rec_height = 10;
		echo '<map id="distrimap" name="distrimap">';
		foreach (array_keys($sp_name) as $s) {
			echo '<area coords="', $x_base, ',', $y_base - $rec_height / 2, ',',
			$x_end, ',', $y_base + $rec_height / 2, '" href="/family.php?sp=', $s, '&amp;fam=', $fam, '" alt="area" />';
			$y_base += $px_dist; 
		}
		echo '</map>';
	}
	?>
	<?php if (isset($para_sp)) {?>
	<table class='tf_table'>
	<tr>
		<th style='width: 20%'>Species</th>
		<th style='width: 20%'>TF ID</th>
		<th>Description</th>
	</tr>
	<?php 
	$n = 0;
	foreach ($sql_array as $sp => $sql) {
		if (!($result = mysqli_query($conn, $sql))) {
			report_query_error();
		}
		$tf_count = mysqli_num_rows($result);
		$tag_td = 'td';
		if ($tf_count != 0) {
			$n++;
			if ($n % 2 == 0) {
				$tag_td = 'td class="alt"';
			}
			$l = 1;
			while ($row = mysqli_fetch_row($result)) {
				echo '<tr>', "\n";
				if ($l == 1) {
					echo "<$tag_td rowspan='$tf_count'><div class='species_name'><a href='index.php?sp=$sp'>$sp_name[$sp]</a><br />($tf_count)</div></td>";
					$l = 0;
				}
				$link_id=str_replace(chr(35),'%23',$row[0]);
				echo "<$tag_td><a href='tf.php?sp=$sp&amp;did=$link_id'>$row[0]</a></td>";
				$t_prot = $sp . '_protein';
				$t_fam = $sp . '_family';
//				$t_src = $sp . '_datasource';
				$t_desc = $sp . '_description';
				//$sql = "select length, mw, pi from $t_prot, $t_fam where $t_prot" . '.protein_id = ' . $t_fam . '.protein_id and ' . $t_fam . '.display_id = "' . $row[0] . '"';
				$sql = "select description from $t_desc where protein_id = '$row[1]' order by protein_id;";
				if (!($result_info = mysqli_query($conn, $sql))) {
					report_query_error();
				}
				//$row_info = mysql_fetch_assoc($result_info);
				echo "<$tag_td style='text-align: left;'>";
				//echo 'Length: ', $row['length'], ' aa&nbsp;&nbsp;&nbsp;&nbsp;MW: ', $row['mw'], ' Da&nbsp;&nbsp;&nbsp;&nbsp;PI: ', $row['pi'];
				$flag = 0;
				while ($row_info = mysqli_fetch_assoc($result_info)) {
					if ($flag == 1) {
						echo '<br>';
					}
					else {
						$flag = 1;
					}
					echo $row_info['description'];
				}
				echo '</td>';
				echo '</tr>';
			}
		}
	}
	?>
</table>
<?php }?>
<div id='family_intro'>
<?php 
if (isset($para_fam)) {
	$f = preg_replace('/\//', '-', $para_fam);
	include("family_introduction/$f.php");
}
?>
</div>
	<?php include('footer.php')?></div>
</body>
</html>

