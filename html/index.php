<form method='POST'>
	<input type='hidden' name='action' value='cmd_insertform_blog'>
	<input type='submit' value='Blogbejegyzés felvétele űrlap'>
</form>
<?php
//echo "<pre>"; var_dump($_REQUEST); echo "</pre>";


$blogbejegyzesek = new adatbazis();
$blogbejegyzesek->blog_select();

if(isset($_POST["action"]) and $_POST["action"]=="insertform_blog"){
	$blogbejegyzes_insertform = new adatbazis();
	$blogbejegyzes_insertform->insert_form();
}
if(isset($_GET["action"]) and $_GET["action"]=="cmd_insert_blog"){
	//echo "<pre>"; var_dump($_REQUEST); echo "</pre>";
	if( isset($_GET["input_blog_cim"]) and
		!empty($_GET["input_blog_cim"]) and
		isset($_GET["input_blog_tartalom"]) and
		!empty($_GET["input_blog_tartalom"]) ){
			$blogbejegyzes_insert = new adatbazis();
			$blogbejegyzes_insert->blog_insert($_GET["input_blog_cim"],
											   $_GET["input_blog_tartalom"],
											   $_GET["input_blog_datum"],
											   $_GET["input_blog_lathatosag"]);			
		}
}

if(isset($_POST["action"]) and $_POST["action"]=="cmd_delete_blog"){
	if( isset($_POST["id"]) and
		is_numeric($_POST["id"])){
			$blogbejegyzes_delete = new adatbazis();
			$blogbejegyzes_delete->blog_delete($_POST["id"]);			
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

class adatbazis{
	//adattagok
	public $servername = "localhost";
	public $username = "roti";
	public $password = "";
	public $dbname = "gipsz_jakab";	
	public $conn = NULL; 
	public $sql = NULL; 
	public $result = NULL; 
	public $row = NULL; 
	public $rows = NULL; 
	
	public function __construct(){
		//$this->kapcsolodas();
	}
	public function __destruct(){
		$this->kapcsolatbontas();
	}
	
	//metódusok
	public function kapcsolodas(){
		$this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
		if ($this->conn->connect_error) {
		  die("Connection failed: " . $this->conn->connect_error);
		}
		$this->conn->query("SET NAMES UTF8;");	
	}
	public function kapcsolatbontas(){
		$this->conn->close();	
	}
	
	
	public function updateform_blog($id){
		$this->sql = "SELECT blog_id, blog_cim, blog_tartalom, blog_datum, blog_szin FROM blog WHERE blog_id  = $id";
		$this->result = $this->conn->query($this->sql);

		if ($this->result->num_rows > 0) {
		  while($this->row = $this->result->fetch_assoc()) {
			echo "<fieldset>";
			echo "<legend>Blogbejegyzés módosítása űrlap</legend>";
			echo "<form method='POST'>
				Add meg a blog címét:<br />
				<input type='text' name='input_blog_cim'
				value=".$this->row['blog_cim']."
				><br />
				Add meg a blog tartalmát:<br />
				<textarea name='input_blog_tartalom'>".$this->row['blog_tartalom']."</textarea><br />
				Add meg a bejegyzés dátumát:<br />
				<input type='date' name='input_blog_datum'
				value=".$this->row['blog_datum']."
				><br />
				Add meg a bejegyzés láthatóságát:<br />
				Látható:<input type='radio' ".(($this->row['blog_lathatosag']==1)?"checked":"")." name='input_blog_lathatosag'  value='1'><br />
				Rejtett<input type='radio' ".(($this->row['blog_lathatosag']==0)?"checked":"")." name='input_blog_lathatosag' value='0'><br />
				<input type='hidden' name='input_id' value='".$this->row['blog_id']."'>
				<input type='hidden' name='action' value='cmd_fullupdate_blog'>
				<input type='submit' value='Blogbejegyzés módosítás'>
			</form>";
			echo "</fieldset>";			
		  }
		} else {
		  echo "0 results";
		}			
	}	
	public function blog_fullupdate($cim, $tartalom, $datum = "1000-01-01", $lathatosag = 0,$id){
		if ($datum == "1000-01-01") {
			date_default_timezone_set('Europe/Budapest');
			$datum = date("Y-m-d");
		}
		$this->sql = "UPDATE 
						blog
					  SET
						blog_cim = '$cim', 
						blog_tartalom = '$tartalom', 
						blog_datum = '$datum', 
						blog_lathatosag = $lathatosag,
						blog_szin = '#900000'
					  WHERE
						blog_id  = $id;	
							";
		if ($this->conn->query($this->sql)){
			echo "<p>Sikeres a blogbejegyzés módosítása</p>";
		} else {
			echo "<p>Sikertelen a blogbejegyzés módosítása</p>";
		}
	}	
	public function blog_details($id){
		$this->sql = "SELECT blog_id, blog_cim, blog_tartalom, blog_datum, blog_lathatosag, blog_szin FROM blog WHERE blog_id = $id";
		$this->result = $this->conn->query($this->sql);

		if ($this->result->num_rows > 0) {
		  while($this->row = $this->result->fetch_assoc()) {
			echo "<div style='color: " . $this->row["blog_szin"] . ";' >";
				echo "<h1>" . $this->row["blog_cim"] . "</h1>";
				echo "<p>";	
					echo "(" . $this->row["blog_datum"] . ")<br />";
					echo "[" . (($this->row["blog_lathatosag"]==1)?"látható":"rejtett") . "]<br />";
					echo $this->row["blog_tartalom"];				
						echo "<form method='POST'>
								<input type='hidden' name='input_id' value='".$this->row["blog_id"]."'>
								<input type='hidden' name='action' value='cmd_updateform_blog'>
								<input type='submit' value='Módosítás'>
							</form>";
						echo "<form method='POST'>
								<input type='hidden' name='input_id' value='".$this->row["blog_id"]."'>
								<input type='hidden' name='action' value='cmd_delete_blog'>
								<input type='submit' value='Törlés'>
							</form>";							
					if($this->row["blog_lathatosag"]==0) {
						echo "<form method='POST'>
								<input type='hidden' name='input_id' value='".$this->row["blog_id"]."'>
								<input type='hidden' name='action' value='cmd_show_blog'>
								<input type='submit' value='Mutat'>
							</form>";	
					} else {
						echo "<form method='POST'>
								<input type='hidden' name='input_id' value='".$this->row["blog_id"]."'>
								<input type='hidden' name='action' value='cmd_hide_blog'>
								<input type='submit' value='Elrejt'>
							</form>";						
					}
					echo "<form method='POST' style='display: inline;'>
						<input type='hidden' name='input_id' value='".$this->row["blog_id"]."'>
						<input type='hidden' name='action' value='cmd_green_blog'>
						<input type='submit' style='color: green;' value='+'>
					</form>";
					echo "<form method='POST' style='display: inline;'>
						<input type='hidden' name='input_id' value='".$this->row["blog_id"]."'>
						<input type='hidden' name='action' value='cmd_blue_blog'>
						<input type='submit' style='color: blue;' value='+'>
					</form>";
					echo "<form method='POST' style='display: inline;'>
						<input type='hidden' name='input_id' value='".$this->row["blog_id"]."'>
						<input type='hidden' name='action' value='cmd_red_blog'>
						<input type='submit' style='color: red;' value='+'>
					</form>";					
				echo "</p>";
			echo "</div>";
		  }
		} else {
		  echo "0 results";
		}		
				
	}
	public function blog_select(){
		$this->sql = "SELECT blog_id, blog_cim, blog_tartalom, blog_datum, blog_lathatosag, blog_szin FROM blog";
		$this->result = $this->conn->query($this->sql);

		if ($this->result->num_rows > 0) {
		  while($this->row = $this->result->fetch_assoc()) {
			echo "<div style='color: " . $this->row["blog_szin"] . ";' >";
				echo "<h1>" . $this->row["blog_cim"] . "</h1>";
				echo "<p>";	
					echo "(" . $this->row["blog_datum"] . ")<br />";
					echo "[" . (($this->row["blog_lathatosag"]==1)?"látható":"rejtett") . "]<br />";
					echo $this->row["blog_tartalom"];
						echo "<form method='POST'>
								<input type='hidden' name='input_id' value='".$this->row["blog_id"]."'>
								<input type='hidden' name='action' value='cmd_details_blog'>
								<input type='submit' value='Részletek'>
							</form>";										
				echo "</p>";
			echo "</div>";
		  }
		} else {
		  echo "0 results";
		}		
		
	}
	
	public function blog_insert($cim, $tartalom, $datum = "1000-01-01", $lathatosag = 0){
		if ($datum = "1000-01-01") {
			date_default_timezone_set('Europe/Budapest');
			$datum = date("Y-m-d");
		}
		$this->sql = "INSERT INTO 
						blog
							(
							blog_cim, 
							blog_tartalom, 
							blog_datum, 
							blog_lathatosag,
							blog_szin
							)
						VALUES
							(
							'$cim', 
							'$tartalom', 
							'$datum', 
							$lathatosag,
							'#900000'
							)		
							";
		if ($this->conn->query($this->sql)){
			echo "<p>Sikeres blogbejegyzés felvétel</p>";
		} else {
			echo "<p>Sikertelen blogbejegyzés felvétel</p>";
		}
	}

	public function blog_delete($id){
		$this->sql = "DELETE FROM
						blog
					  WHERE
						blog_id  = $xd;";
		if ($this->conn->query($this->sql)){
			echo "<p>Sikeres blogbejegyzés felvétel</p>";
		} else {
			echo "<p>Sikertelen blogbejegyzés felvétel</p>";
		}
	}	
	public function blog_show($id){
		$this->sql = "UPDATE
						blog
					  SET
						blog_lathatosag = 1
					  WHERE
						blog_id  = $id;";
		var_dump($this->sql);
		if ($this->conn->query($this->sql)){
			echo "<p>Sikeres a blogbejegyzés megjelenítése</p>";
		} else {
			echo "<p>Sikertelen a blogbejegyzés megjelenítése</p>";
		}
	}
	public function blog_hide($id){
		$this->sql = "UPDATE
						blog
					  SET
						blog_lathatosag = 10
					  WHERE
						blog_id  = $id;";
		var_dump($this->sql);
		if ($this->conn->query($this->sql)){
			echo "<p>Sikeres a blogbejegyzés elrejtése</p>";
		} else {
			echo "<p>Sikertelen a blogbejegyzés elrejtése</p>";
		}
	}	
	
	public function blog_blue($id){
		$this->sql = "UPDATE
						blog
					  SET
						blog_szin = '#000090'
					  WHERE
						blog_id  = $id;";
		var_dump($this->sql);
		if ($this->conn->query($this->sql)){
			echo "<p>Sikeres a blogbejegyzés zöldítése</p>";
		} else {
			echo "<p>Sikertelen a blogbejegyzés zöldítése</p>";
		}
	}	
	
	public function blog_green($id){
		$this->sql = "UPDATE
						blog
					  SET
						blog_szin = '#009000'
					  WHERE
						blog_id  = $id;";
		var_dump($this->sql);
		if ($this->conn->query($this->sql)){
			echo "<p>Sikeres a blogbejegyzés zöldítése</p>";
		} else {
			echo "<p>Sikertelen a blogbejegyzés zöldítése</p>";
		}
	}	

	public function blog_red($id){
		$this->sql = "UPDATE
						blog
					  SET
						blog_szin = '#900000'
					  WHERE
						blog_id  = $id;";
		var_dump($this->sql);
		if ($this->conn->query($this->sql)){
			echo "<p>Sikeres a blogbejegyzés pirosítása</p>";
		} else {
			echo "<p>Sikertelen a blogbejegyzés pirosítása</p>";
		}
	}	
	public function insert_form(){
		echo "<fieldset>
			<legend>Blogbejegyzés felvétele űrlap</legend>
			<form method='POST'>
				Add meg a blog címét:<br />
				<input type='text' name='input_blog_cim'><br />
				Add meg a blog tartalmát:<br />
				<textarea name='input_blog_tartalom'></textarea><br />
				Add meg a bejegyzés dátumát:<br />
				<input type='date' name='input_blog_datum'><br />
				Add meg a bejegyzés láthatóságát:<br />
				Látható:<input type='radio' name='input_blog_lathatosag' value='1'><br />
				Rejtett<input type='radio' name='input_blog_lathatosag' value='0'><br />
				<input type='hidden' name='action' value='cmd_insert_blog'>
				<input type='submit' value='Blogbejegyzés felvétele'>
			</form>
		</fieldset>";
	}
}





?>