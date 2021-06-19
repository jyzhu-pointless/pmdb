<?php

include('db_connect.php');
$id = $_GET['id'];
$sql = "SELECT * FROM domain_pos WHERE ID={$id} AND domain_name='SRF-TF'";

$domain_info = mysqli_query($conn, $sql);
while ($entry = mysqli_fetch_array($domain_info, MYSQLI_ASSOC)){
    $axis_x_num = intval(floor($entry['protein_length']/100));
    $width = 800;

    echo "
<div>
<svg id=\"\" width=\"{$width}\" height=\"80\">
    <g class=\"x axis\" fill=\"none\" font-size=\"20\" font-family=\"sans-serif\" text-anchor=\"middle\">
    ";

    foreach(range(1,$axis_x_num) as $x){
        $num = 100 * $x;
        $pos = $width * 100 * $x / $entry['protein_length'];
        echo "
        <g class=\"tick\" opacity=\"1\" transform=\"translate({$pos})\">
            <text fill=\"#000000\" y=\"9\" dy=\"0.71em\">{$num}</text>
        </g>
        ";
    }
    $dom_draw_len = $width * $entry['domain_length'] / $entry['protein_length'];
    $dom_draw_x = $width * $entry['ali_start'] / $entry['protein_length'];
    echo "
    </g>
        <g >
            <rect fill=\"#e6e6e6\" height=\"30\" x=\"0\" y=\"30\" width=\"{$width}\"></rect>
            <path class=\"roundRectangle feature\" d=\"M6,0h{$dom_draw_len},0a6,6 0 0 1 6,6v18a6,6 0 0 1 -6,6h-{$dom_draw_len}a6,6 0 0 1 -6,-6v-18a6,6 0 0 1 6,-6Z\" fill=\"#79d5eb\" opacity=\"1\" transform=\"translate({$dom_draw_x},30)\" ></path>

        </g>

    </svg>
</div>
";

    }

?>