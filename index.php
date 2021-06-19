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
<div id='home_img' style="float:left;width:30%;">
    <img src="images/flower.png" style='padding: 80px;padding-left: 0px; padding-right:0px; width: 250px;' alt="flower" />
</div>
<div id='home_text' style="float:left;width:70%;">
    <div id='intro' style="padding:8px;">
        <p>Flowering is a key part of the life cycle of angiosperms. Regulation of flowering process, including floral transition and development of floral organs, is conducted by a complicated mechanism. The core of this mechanism is a series of transcription factors, most of which belong to a protein family called MADS-box transcription factor. The well-known ABC model is a primary abstract of the mechanism of flower morphogenesis. It describes how a series of key factors dominate the morphogenesis of floral organs through coordination and competition, where most of these key factors are MADS-box transcription factors<sup>1, 2</sup>.</p>
        <p>MADS-box transcription factor family is defined by a MADS-box domain, which contains about 50 amino acid residuals and has DNA-binding activity. Although MADS-box transcription factors play important roles in the plant-specific flowering process, the family is not plant-specific. The name MADS-box is derived from four proteins that contain this certain domain: <u>M</u>CM1 from <?php echo get_sp_name_full('Saccharomyces cerevisiae');?>, <u>A</u>G from <?php echo get_sp_name_full('Arabidopsis thaliana');?>, <u>D</u>EFA from <?php echo get_sp_name_full('Antirrhinum majus');?>, and <u>S</u>RF from <?php echo get_sp_name_full('Homo sapiens');?><sup>3</sup>. MADS-box proteins can be divided into two types, namely type I and type II, and this divergence is thought to be ancestral to the divergence of plants and animals<sup>4</sup>.</p>
        <p>MADS-box proteins have been proved to be involved in many biological processes of many plant species<sup>5</sup>. Here we collected information about manually reviewed known MADS-box proteins of plants from SwissProt and built this database, with a primary goal to learn and master the procedure of the construction and presentation of a database, and an ultimate goal to gain further understanding of plant MADS-proteins through a systematic and evolutional perspective, especially about how they obtained their role in flowering control.</p>
    </div>
</div>

<div id='dl_full' align='center'>
    <a href='MADS_plants.fasta'>Download FASTA of All 165 MADS-box TFs Collected</a>
</div>

<div id='reference' style="clear:both;">
    <ol>
        <h3>References:</h3>
        <li>E. S. Coen, E. M. Meyerowitz, The War of the Whorls - Genetic Interactions Controlling Flower Development. <i>Nature</i> 353, 31-37 (1991).</li>
        <li>D. Weigel, E. M. Meyerowitz, The ABCs of floral homeotic genes. <i>Cell</i> 78, 203-209 (1994).</li>
        <li>Z. Schwarzsommer, P. Huijser, W. Nacken, H. Saedler, H. Sommer, Genetic-Control of Flower Development by Homeotic Genes in Antirrhinum-Majus. <i>Science</i> 250, 931-936 (1990).</li>
        <li>E. R. Alvarez-Buylla et al., An ancestral MADS-box gene duplication occurred before the divergence of plants and animals. <i>Proceedings of the National Academy of Sciences of the United States of America</i> 97, 5328-5333 (2000).</li>
        <li>G. Theissen et al., A short history of MADS-box genes in plants. <i>Plant Mol Biol</i> 42, 115-149 (2000).</li>
    </ol>
</div>



<?php include('footer.php');?>
</div>
</body>
</html>
