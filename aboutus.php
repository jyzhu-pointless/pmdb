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

<h2 align="center">About</h2>
<div class='introduction'>
<h3>Developers</h3>
<p>LEB Group4 Members:</p>
<ul>
    <li>Chen Yi-Han</li>
    <li>Zou Ji-Ping </li>
    <li>Zhu Jin-Yu</li>
    <li>Gao Pei-Xiang</li>
</ul>

<h3>Data Source</h3>
<p>The list of manually reviewed MADS-box proteins is obtained from <a href="https://www.ebi.ac.uk/interpro/entry/InterPro/IPR002100/">InterPro</a>, then basic information of these proteins is collected from <a href="https://www.uniprot.org/">Uniprot</a>.<p>
<p>The position of MADS-box domain in each protein is located by <a href="http://www.hmmer.org/">HMMER</a>, with a MADS-box domain profile obtained from <a href="https://pfam.xfam.org/family/SRF-TF">Pfam</a>.<p>

<h3>Disclaimer</h3>
<p>This website is built merely for educational purpose currently. All rights reserved.</p>

</div>
<?php
include('footer.php');
?>
</div>

</body>