<?php
function report_query_error() {
	die('Query Error !<br>' . mysqli_error());
}

function get_sp_name_full($organism) {
    $name_full="<span class='sp_name_i'>{$organism}</span>";
    $grade = array('subsp.', 'var.');
    foreach($grade as $g){
        $name_array = explode($g, $organism);
        if(count($name_array)>1){
            $name_full = "<span class='sp_name_i'>{$name_array[0]}</span><span class='sp_name_n'>{$g}</span><span class='sp_name_i'>{$name_array[1]}</span>";
            break;
        }
    }
    return $name_full;
}

function sequence_print($sequence){
    $posi = 0;
	$line = 0;
	$len = strlen($sequence);
	$seq_pr = NULL;
	do {
		$seq_tmp = substr($sequence,$posi,10);
		$posi += 10;
		$line += 1;
		$seq_pr = $seq_pr.' '.$seq_tmp;
		if ($posi <= $len && $line == 5) {
			$seq_pr = $seq_pr.' '.$posi."</br>";
			$line = 0;
		}
	}
	while ($seq_tmp);
	return $seq_pr;
}

function lineage_print($lineage){
    return implode(' > ', explode('>', $lineage));
}

function generate_GO_table($GO){
    $dict = array('C'=>'Cellular Component', 'P'=>'Biological Process', 'F'=>'Molecular Function');
    $GO_array = explode("\n", $GO);
    foreach(range(0,count($GO_array)-1) as $i){
        $GO_array[$i] = explode('$', $GO_array[$i]);
        $GO_array[$i][1] = explode(':', $GO_array[$i][1]);
    }
    $GO_tbl =
"<table class='tbl' id='GO'>
    <tr><th class='tbl_title' colspan='3'>Gene Ontology <a href='help.php#tfifo'>[? Help]</a></th></tr>
    <tr><th class='tbl_header'>GO Term</th><th class='tbl_header'>GO Category</th><th class='tbl_header'>GO Description</th></tr>";
    foreach($GO_array as $r){
        $GO_tbl = $GO_tbl.
   "<tr><td>{$r[0]}</td><td>{$dict[$r[1][0]]}</td><td>{$r[1][1]}</td></tr>";
    }
    $GO_tbl = $GO_tbl."</table>";
    return $GO_tbl;
}

function generate_basic_table($row){
    $basic_tbl='';
    $protein_alias = implode(';<br/>', explode("\n", $row['protein_alias']));
    $gene_alias = implode('; ', explode("\n", $row['gene_alias']));
    $basic_tbl =
"<table class='tbl' id='basic'>
    <tr><th class='tbl_title' colspan='4'>Basic Information <a href='help.php#tfifo'>[? Help]</a></th></tr>
    <tr><th class='tbl_header'>ID</th><td>{$row['ID']}</td><th class='tbl_header'>UniProt ID</th><td><a href='https://www.uniprot.org/uniprot/{$row['uniprot_id']}'>{$row['uniprot_id']}</a></td></tr>
    <tr><th class='tbl_header'>Protein Name</th><td colspan='3'>{$row['protein_name']}</td></tr>
    <tr><th class='tbl_header'>Protein Alias</th><td colspan='3'>{$protein_alias}</td></tr>
    <tr><th class='tbl_header'>Gene Name</th><td>{$row['gene_name']}</td><th class='tbl_header'>Gene Alias</th><td>{$gene_alias}</td></tr>
    <tr><th class='tbl_header'>Organism</th><td><a href='browse_detailed.php?taxon={$row['taxon_ID']}'>".get_sp_name_full($row['organism'])."</a></td><th class='tbl_header'>Taxon ID</th><td>{$row['taxon_ID']}</td></tr>
    <tr><th class='tbl_header'>Lineage</th><td colspan='3'>".lineage_print($row['lineage'])."</td></tr>
    <tr><th class='tbl_header'>Description</th><td colspan='3'>{$row['description']}</td></tr>
</table>";
    return $basic_tbl;
}

function generate_seq_table($row){
    $seq_tbl =
"<table class='tbl' id='seq'>
    <tr><th class='tbl_title' colspan='4'>Protein Sequence <a href='help.php#tfifo'>[? Help]</a></th></tr>
    <tr><th class='tbl_header'>Protein Length</th><td>{$row['protein_length']}</td><th class='tbl_header'>Molecular Weight</th><td>{$row['protein_mass']}</td></tr>
    <tr><th class='tbl_header' id='dl'>Sequence <br> <a href='fasta/{$row['uniprot_id']}.fasta'>[Download FASTA]</a> </th><td colspan='3' class='sequence'>".sequence_print($row['sequence'])."</td></tr>
</table>";
    return $seq_tbl;
}

function generate_domain_svg($entry){
    $axis_x_num = intval(floor($entry['protein_length']/100));
    $width = 800;
    $svg =
"<div>
<svg id=\"\" width=\"{$width}\" height=\"80\">
    <g class=\"x axis\" fill=\"none\" <!--font-size=\"20\"-->  font-family=\"sans-serif\" text-anchor=\"middle\">";
    foreach(range(1,$axis_x_num) as $x){
        $num = 100 * $x;
        $pos = $width * 100 * $x / $entry['protein_length'];
        $svg = $svg.
        "<g class=\"tick\" opacity=\"1\" transform=\"translate({$pos})\">
            <text fill=\"#000000\" y=\"9\" dy=\"0.71em\">{$num}</text>
        </g>";
    }
    $dom_draw_len = $width * $entry['domain_length'] / $entry['protein_length'];
    $dom_draw_x = $width * $entry['ali_start'] / $entry['protein_length'];
    $svg = $svg.
    "</g>
        <g>
            <rect fill=\"#e6e6e6\" height=\"30\" x=\"0\" y=\"30\" width=\"{$width}\"></rect>
            <path class=\"roundRectangle feature\" d=\"M6,0h{$dom_draw_len},0a6,6 0 0 1 6,6v18a6,6 0 0 1 -6,6h-{$dom_draw_len}a6,6 0 0 1 -6,-6v-18a6,6 0 0 1 6,-6Z\" fill=\"#4472c4\" opacity=\"1\" transform=\"translate({$dom_draw_x},30)\" ></path>
        </g>
    </svg>
</div>";
    return $svg;
}

function generate_domain_table($dom_arr){
    $domain_tbl =
"<table class='tbl' id='dom'>
    <tr><th class='tbl_title' colspan='6'>Position of MADS-box According to HMMER <a href='help.php#tfifo'>[? Help]</a></th></tr>";
    $domain_tbl = $domain_tbl."<tr><td class='dom_svg' colspan='6' align='center'>";
    foreach($dom_arr as $dom){
        $domain_tbl = $domain_tbl.$dom['svg'];
    }
    $domain_tbl = $domain_tbl."</td></tr>";
    $domain_tbl = $domain_tbl."<tr><th class='tbl_header'>Score</th><th class='tbl_header'>E-value</th><th class='tbl_header'>Alignment Start</th><th class='tbl_header'>Alignment End</th><th class='tbl_header'>HMM Start</th><th class='tbl_header'>HMM End</th></tr>";
    foreach($dom_arr as $x){
        $domain_tbl = $domain_tbl."<tr><td>{$x['score']}</td><td>{$x['E_value']}</td><td>{$x['ali_start']}</td><td>{$x['ali_end']}</td><td>{$x['hmm_start']}</td><td>{$x['hmm_end']}</td></tr>";
    }
    $domain_tbl = $domain_tbl."</table>";
    return $domain_tbl;
}

function get_organism_name($conn){
	$organism_name = array();
	$retval = mysqli_query($conn, 'select taxon_ID, organism from mads group by taxon_ID, organism;');
	while ($row = mysqli_fetch_assoc($retval)){
		$organism_name[$row['taxon_ID']] = $row['organism'];}
	return $organism_name;
}

?>
