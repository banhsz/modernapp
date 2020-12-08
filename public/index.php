<?php include 'adatbazis.php'; ?>
<form method='POST'>
	<input type='hidden' name='action' value='cmd_insertform_blog'>
	<input type='submit' value='Blogbejegyzés felvétele űrlap'>
</form>
<?php
//echo "<pre>"; var_dump($_REQUEST); echo "</pre>";


$blogbejegyzesek = new adatbazis();

if(isset($_POST["action"]) and $_POST["action"]=="cmd_insertform_blog"){
	$blogbejegyzes_insertform = new adatbazis();
	$blogbejegyzes_insertform->insert_form();
}
if(isset($_POST["action"]) and $_POST["action"]=="cmd_insert_blog"){
	//echo "<pre>"; var_dump($_REQUEST); echo "</pre>";
	if( isset($_POST["input_blog_cim"]) and
		!empty($_POST["input_blog_cim"]) and
		isset($_POST["input_blog_tartalom"]) and
		!empty($_POST["input_blog_tartalom"]) ){
			$blogbejegyzes_insert = new adatbazis();
			$blogbejegyzes_insert->blog_insert($_POST["input_blog_cim"],
											   $_POST["input_blog_tartalom"],
											   $_POST["input_blog_datum"],
											   $_POST["input_blog_lathatosag"]);			
		}
}

if(isset($_POST["action"]) and $_POST["action"]=="cmd_delete_blog"){
	if( isset($_POST["input_id"]) and
		is_numeric($_POST["input_id"])){
			$blogbejegyzes_delete = new adatbazis();
			$blogbejegyzes_delete->blog_delete($_POST["input_id"]);			
		}
}

if(isset($_POST["action"]) and $_POST["action"]=="cmd_show_blog"){
	if( isset($_POST["input_id"]) and
		is_numeric($_POST["input_id"])){
			$blogbejegyzes_mutat = new adatbazis();
			$blogbejegyzes_mutat->blog_show($_POST["input_id"]);	
			$blogbejegyzes_mutat->blog_details($_POST["input_id"]);			
		}
}

if(isset($_POST["action"]) and $_POST["action"]=="cmd_hide_blog"){
	if( isset($_POST["input_id"]) and
		is_numeric($_POST["input_id"])){
			$blogbejegyzes_elrejt = new adatbazis();
			$blogbejegyzes_elrejt->blog_hide($_POST["input_id"]);			
			$blogbejegyzes_elrejt->blog_details($_POST["input_id"]);			
		}
}

if(isset($_POST["action"]) and $_POST["action"]=="cmd_blue_blog"){
	if( isset($_POST["input_id"]) and
		is_numeric($_POST["input_id"])){
			$blogbejegyzes_kek = new adatbazis();
			$blogbejegyzes_kek->blog_blue($_POST["input_id"]);			
			$blogbejegyzes_kek->blog_details($_POST["input_id"]);			
		}
}

if(isset($_POST["action"]) and $_POST["action"]=="cmd_green_blog"){
	if( isset($_POST["input_id"]) and
		is_numeric($_POST["input_id"])){
			$blogbejegyzes_zold = new adatbazis();
			$blogbejegyzes_zold->blog_green($_POST["input_id"]);			
			$blogbejegyzes_zold->blog_details($_POST["input_id"]);			
		}
}

if(isset($_POST["action"]) and $_POST["action"]=="cmd_red_blog"){
	if( isset($_POST["input_id"]) and
		is_numeric($_POST["input_id"])){
			$blogbejegyzes_piros = new adatbazis();
			$blogbejegyzes_piros->blog_red($_POST["input_id"]);			
			$blogbejegyzes_piros->blog_details($_POST["input_id"]);			
		}
}

if(isset($_POST["action"]) and $_POST["action"]=="cmd_updateform_blog"){
	if( isset($_POST["input_id"]) and
		is_numeric($_POST["input_id"])){
			$blogbejegyzes_modositform = new adatbazis();
			$blogbejegyzes_modositform->updateform_blog($_POST["input_id"]);			
		}
}
if(isset($_POST["action"]) and $_POST["action"]=="cmd_fullupdate_blog"){

	if( isset($_POST["input_blog_cim"]) and
		!empty($_POST["input_blog_cim"]) and
		isset($_POST["input_blog_tartalom"]) and
		!empty($_POST["input_blog_tartalom"]) and
		isset($_POST["input_blog_datum"]) and
		!empty($_POST["input_blog_datum"]) and		
		isset($_POST["input_blog_lathatosag"]) and
		is_numeric($_POST["input_blog_lathatosag"]) and		
		isset($_POST["input_id"]) and
		is_numeric($_POST["input_id"])
		){
			$blogbejegyzes_fullupdate = new adatbazis();
			$blogbejegyzes_fullupdate->blog_fullupdate($_POST["input_blog_cim"],
												   $_POST["input_blog_tartalom"],
											       $_POST["input_blog_datum"],
											       $_POST["input_blog_lathatosag"],
											       $_POST["input_id"]
											       );
			$blogbejegyzes_fullupdate->blog_details($_POST["input_id"]);
		}
}
if(isset($_POST["action"]) and $_POST["action"]=="cmd_details_blog"){
	if( isset($_POST["input_id"]) and
		is_numeric($_POST["input_id"])){
			$blogbejegyzes_delete = new adatbazis();
			$blogbejegyzes_delete->blog_details($_POST["input_id"]);			
		}
}
$blogbejegyzesek->blog_select();

