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

<h2 align='center'>BLAST Results</h2>
<p align='center'><a href='help.php#res'><i>[? Help]</i></a></p>

<?php
//password:4f6db46aee8b
//echo $_POST['input_seq'];
/*
$f = file_put_contents('/rd1/www/group4/temp.fa',$_POST['input_seq']);
echo $f;
 */
//echo '</br>';
// echo file_put_contents("/tmp/tmp4.fa",$_POST['input_seq']);
$d = date("Y.m.d.h:i:sa");
$blast = 'input/blast'.$d.'.txt';
$result = "input/result".$d.".txt";
$tab = "input/tab".$d.".txt";
$upid = "input/upid".$d.".txt";
$score = "input/score".$d.".txt";
$ev = "input/ev".$d.".txt";
$id = "input/id".$d.".txt";

file_put_contents($blast,$_POST['input_seq']);
passthru($_POST['select_program'].' -query '.$blast.' -subject MADS_plants.fasta -evalue '.$_POST['input_evalue'].' -matrix '.$_POST['select_matrix'].' -outfmt 0 '.' > '.$result);
passthru('head -n $(($(grep \> '.$result.' -n | cut -d : -f 1 | head -n 1)-3)) '.$result.' | tail -n +$(($(grep Bits '.$result.' -n | cut -d : -f 1 | head -n 1)+2)) > '.$tab);
passthru('cut -d \| -f 2 '.$tab.' > '.$upid);
passthru('cut -b 71- '.$tab.' | cut -d\  -f 1 > '.$score);
passthru('cut -b 71- '.$tab.' | cut -b 9- > '.$ev);


$file_upid = fopen($upid, "r") or exit("Failed.");
$file_score = fopen($score, "r") or exit("Failed.");
$file_ev = fopen($ev, "r") or exit("Failed.");

echo "<div class='tbl_search'>";
//echo "<table>";
//echo "<tr><th>UniProt ID</th><th>Score</th><th>Evalue</th></tr>";
//echo "<tr><th>ID</th><th>Protein Name</th><th>Organism</th><th>Score</th><th>Evalue</th></tr>";
$label=0;
$label_id=array();
$flag_e=0;

while(!feof($file_upid))
{
    $upid_tmp = fgets($file_upid);
    $upid_tmp = str_replace("\n","",$upid_tmp);
    $retval = mysqli_query($conn,"SELECT * FROM mads WHERE uniprot_id='{$upid_tmp}';");
    $row = mysqli_fetch_assoc($retval);
    if($row['ID']) 
    {
	    if(!$label) {
		    echo "<table><tr><th>ID</th><th>Protein Name</th><th>Organism</th><th>Score</th><th>Evalue</th></tr>";}
	$label++;
	echo "<tr><td>{$row['ID']}</td><td><a href=\"entry.php?id={$row['ID']}\">{$row['protein_name']}</a></td><td>".get_sp_name_full($row['organism'])."</td><td><a href=\"#{$row['ID']}\">".fgets($file_score)."</a></td><td>".fgets($file_ev)."</td></tr>";
        $label_id[$label]=$row['ID'];
    }
}
//

if (!$label) {
	echo "<p align='center'>No hits found.</p>";
}
else {
	echo "</table>";
passthru("sed -i 's/\ /\&nbsp;/g' ".$result);

$outfile = file($result);//将结果输出文件中的每一行存到outfile数组内。
$len = count($outfile);//数组长度

//一下部分为具体比对的跳转//
$flag1 = false;
$flag2 = false;
$num = 1;
//echo "<a href=\"#5\">跳转到第五条</a><br>";
//echo $len;
echo "<br>";
echo "<div style='font-family: Courier New'>";

$flag3 = 0;

for($i=0; $i<$len; $i++)
{
    if(strpos($outfile[$i],">")===0)
    {
        $flag1 = true;
        $flag2 = true;
        echo "<hr>";
    }
    if(!$flag3)
        {
            if(strpos($outfile[$i],"Lambda")===0)
            {
                $flag3 = true;
                echo "<hr>";
            }
        }
    if($flag1)
    {
        if($flag2)
        {
            //echo $outfile[$i];
            //echo "<a id=\"$num\">sp|".fgets($id)."|</a>";
            echo "<a id=\"$label_id[$num]\" href=\"entry.php?id={$label_id[$num]}\" >{$outfile[$i]}</a>";
            $num++;
        }
        else
        {
            echo $outfile[$i];
        }
        echo "<br>";
    }
    $flag2 = false;
}

echo "</div>";
}

passthru('chmod 777 input/*');
passthru('rm '.$blast);
passthru('rm '.$result);
passthru('rm '.$tab);
passthru('rm '.$upid);
passthru('rm '.$score);
passthru('rm '.$ev);

//fclose($file);

?>
</div>
<?php
include('footer.php');
?>
</div>
</body>
</html>
