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

<style>
/*h2 {color:blue;font-style:oblique;}*/
h3 {color:#4472c4;padding-left:1em;}
h4 {font-style:italic;color:#4472c4;padding-left:2em;}
p {padding-left:3em;}
</style>

<div class='help_choice'>    <!--help页面选择子页面-->
<h2 align='center'>Help</h2>
<ul>
<li><a href="#tfifo">Transciption Factor information</a></li>
    <ul>
        <li><a href="#bifo">Basic Information</a></li>
        <li><a href="#protseq">Protein Sequence</a></li>
        <li><a href="#posibox">Position of MADS-box According to HMMER</a></li>
        <li><a href="#GO">Gene Ontology</a></li>
    </ul>
<li><a href="#quicksearch">Quick Search</a></li>
<li><a href="#advsearch">Advanced Search</a></li>
<li><a href="#browse">Browse</a></li>
<li><a href="#blast">Basic Local Alignment Search Tool (BLAST)</a></li>
    <ul>
        <li><a href="#stp">Steps</a></li>
	<li><a href="#opt">Options</a></li>
	<li><a href="#res">Results</a></li>
    </ul>
</ul>
</div>

<hr>
<h2 id="tfifo">Transciption Factor information</h2>
    <h3 id="bifo">Basic Information</h3>
        <h4>ID</h4>
            <p>The ID of transcription factor collected in PlantMADS Database. </p>
        <h4>UniProt ID</h4>
            <p>The ID in UniProt of the transcription factor. </p>
        <h4>Protein Name</h4>
            <p>The common name of the transcription factor in UniProt.</p>
        <h4>Protein Alias</h4>
            <p>Another possible name for the transcription factor.</p>
        <h4>Gene Name</h4>
            <p>The name of the full gene approved by HGNC. </p>
        <h4>Gene Alias</h4>
            <p>Another possible name for the gene.</p>
        <h4>Organism</h4>
            <p>The scientific name of the organism that the transcription factor belongs to.</p>
        <h4>Taxon ID</h4>
            <p>The taxonomic ID and lineage for each organism, collected from UniProt.</p>
        <h4>Lineage</h4>
            <p>The position of the organism in a continous line of descent from ancestor to descendant.</p>
        <h4>Description</h4>
            <p>A brief description of the function and mode of action of this transcription factor.</p>
    <h3 id="protseq">Protein Sequence</h3>
            <p>Information including Sequence Length, Molecular Weight and Sequence.</p>
            <p>Click the link [Download FASTA] to download the protein sequence with fasta format.</p>
    <h3 id="posibox">Position of MADS-box According to HMMER</h3>
            <p>Displays the specific position of MADS-box genes According to HMMER, and provides information including Score, E-value, Alignment Start, Alignment End, HMM Start and HMM End.</p>
    <h3 id="GO">Gene Ontology</h3>
            <p>The Gene Ontology (GO) is a major bioinformatics initiative to unify the representation of gene and gene product attributes across all species.</p>
<hr>

<h2 id="quicksearch"  color="blue"  type=”text/css”>Quick Search</h2>
            <p>The quick search box in the menu bar allows you to search the database by a keyword at any time. It will return the entries of the proteins whose name or description contains your keyword.</p>
<hr>

<h2 id="advsearch" color="blue" type="text/css">Advanced Search</h2>
            <p>This section allows you to get certain entrys from our database by giving one or more conditions.You can specify the type of you conditions (e.g. protein name, organism, etc.), and their logical relationship (AND/OR). You may press the button "+" at the first line to add more conditions, and press the button "-" at any other line to delete the condition in this line.</p>
<hr>

<h2 id="browse"  color="blue"  type=”text/css”>Browse</h2>
            <p>You can browse all the flowering transcription factors included in this database here, categorized by species.</p>
            <p>In the browse page, click the organism you are searching for to view all of its MADS-BOX family transcription factors collected in this database. Then, click the protein name to view its detailed information.</p>
<hr>

<h2 id="blast"  color="blue"  type=”text/css”>Basic Local Alignment Search Tool (BLAST)</h2>
    <h3 id="stp">Steps</h3>
            <p><i style='color: #888888'>Step 1: </i>Enter a protein sequence (raw sequence or fasta format) into the form field.</p>
            <p><i style='color: #888888'>Step 2: </i>Click the Blast button.</p>
    <h3 id="opt">Options</h3>
        <h4>Program</h4>
            <p>Choose the blast programm.</p>
            <p><i style='color: #888888'>blastp: </i>This program, given a protein query, returns the most similar protein sequences.</p>
            <p><i style='color: #888888'>blastx: </i>This program compares the six-frame conceptual translation products of a nucleotide query sequence (both strands) against the protein sequence database.</p>
        <h4>Scoring Matrix</h4>
            <p>The matrix assigns a probability score for each position in an alignment. The BLOSUM matrix assigns a probability score for each position in an alignment that is based on the frequency with which that substitution is known to occur among consensus blocks within related proteins. BLOSUM62 is among the best of the available matrices for detecting weak protein similarities. The PAM set of matrices is also available. If "Auto" is set, the matrix will be selected depending on the query sequence length.</p>
        <h4>Expect threshold</h4>
            <p>The expectation value (E) threshold is a statistical measure of the number of expected matches in a random database. The lower the e-value, the more likely the match is to be significant. E-values between 0.1 and 10 are generally dubious, and over 10 are unlikely to have biological significance. In all cases, those matches need to be verified manually. You may need to increase the E threshold if you have a very short query sequence, to detect very weak similarities, or similarities in a short region.</p>
    <h3 id="res">Results</h3>
	    <p>The BLAST result contains a table showing the ID, Protein Name, Organism, Score and E-value of proteins found in our database, and a pairwise list following it.</p>

<?php include('footer.php');?>
</div>
</body>
</html>
