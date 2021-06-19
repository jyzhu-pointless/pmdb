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

<div class='blast_content' style='text-align: center;'>
<h2 class="title" align='center'>Basic Local Alignment Search Tool (BLAST)</h2>
<p><a href='help.php#blast'><i>[? Help]</i></a>
    </p> 
<form class="adv_search" method='post' action="blast_process.php" style='padding-left: 10px;'>
<div>

Program&nbsp;&nbsp;<select name='select_program'>
<option value='blastp' selected='selected'>blastp</option> <br>
<option value='blastx'>blastx</option>
</select>
<br><br>
Enter a FASTA sequence<br>
<textarea id='input_seq' name='input_seq' rows='10' cols='80'></textarea><br />
<br>
Scoring Matrix <select name='select_matrix'>
<option value='blosum45'>BLOSUM45</option>
<option value='blosum62' selected='selected'>BLOSUM62</option>
<option value='blosum80'>BLOSUM80</option>
<option value='pam30'>PAM30</option>
<option value='pam70'>PAM70</option>
</select>
<br><br>
<!--Other options-->
<!--Filter <input name='chbox_lowcomplex' type='checkbox' checked='yes' />Low complexity regions<br />
Mask <input name='chbox_lowercase' type='checkbox' />Mask lower case letters<br />-->
Expect threshold <input name='input_evalue' value='0.1' size='10' />
<br><br>
<input type="reset" name="reset" value="Reset" style />&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" name="blast" value="BLAST" />
</div>
</form>
</div>

<br>

<?php
include('footer.php');
?>

</body>
</html>
