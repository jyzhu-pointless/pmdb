
<script>
var j = 1;
function append_term(){
    j = j + 1;
    var adv_s_tbl = document.getElementById('adv_s_tbl');
    var i = adv_s_tbl.rows.length;
    var field = document.getElementById('field1');
    var new_field = field.cloneNode(true);
    var con = document.getElementById('con1');
    var new_con = con.cloneNode(true);
    var value = document.getElementById('value1');
    var new_value = value.cloneNode(true);
    new_field.id = 'field'+(j).toString();
    new_con.style = '';
    new_con.id = 'con'+(j).toString();
    new_con.value = 'AND';
    new_value.id = 'value'+(j).toString();
    new_value.value = '';
    var new_row = adv_s_tbl.insertRow(i);
    new_row.id = 'adv_s_r'+ j.toString();
    new_row.insertCell(0).appendChild(new_con);
    new_row.insertCell(1).appendChild(new_field);
    new_row.insertCell(2).appendChild(new_value);
    new_row.insertCell(3).innerHTML="<button type='button' onclick='delete_term(\""+new_row.id+"\")'>−";
}

function delete_term(n){
    var row_to_delete = document.getElementById(n);
    row_to_delete.parentNode.removeChild(row_to_delete);
}

</script>
<div class='adv_search' align='center'>
<form class='adv_search' action='adv_search_result.php' method='post' align='center'>
    <h2 align='center'>Advanced Search</h2>
    <p> <a href='help.php#advsearch'><i>[? Help]</i></a>
    </p>
    <table id='adv_s_tbl' align='center'>
        <tr id='term1'>
            <td width='60px'>
		<select id='con1' name='con[]' style='display:none'>
                    <option value='AND' selected>AND</option>
                    <option value='OR'>OR</option>
                </select>
            </td>
            <td>
                <select id='field1' name='field[]'>
		    <optgroup label='ID'>
			<option value='id'>PMDB ID</option>
			<option value='uniprot_id'>UniProt ID</option>
		    </optgroup>
		    <optgroup label='Name'>
			<option value='protein'>Protein Name or Alias</option>
                    	<option value='gene'>Gene Name or Alias</option>
		    </optgroup>
		    <optgroup label='Taxomony'>
			<option value='organism'>Organism</option>
                    	<option value='taxon_ID'>Taxon ID</option>
		    </optgroup>
		    <optgroup label='Description'>
			<option value='description'>Description</option>
		    </optgroup>
		</select>
            </td>
            <td width='410px'><input style='width: 400px' type='text' id='value1' name='value[]'></td>
            <td><button type='button' onclick='append_term()'>+</td>
          </tr>
    </table>
    <p align='center'><input type='submit' value='Search'><p>

</form>
</div>
