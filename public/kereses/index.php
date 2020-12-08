<form method='GET'>
	<input type='hidden' name='action' value='cmd_seachform_blog'>
	<input type='text' name='input_keresettszo' placeholder='Ide kerül a keresendő szó'>
	<input type='submit' value='Blogbejegyzés keresés'>
</form>
<?php
echo "<pre>"; var_dump($_REQUEST); echo "</pre>";

if(isset($_GET["action"]) and $_GET["action"]=="cmd_seachform_blog"){
	if(isset($_GET["input_keresettszo"])){
		$blogbejegyzesek = new adatbazis();
		$blogbejegyzesek->blog_select($_GET["input_keresettszo"]);
	} else {
		$blogbejegyzesek = new adatbazis();
		$blogbejegyzesek->blog_select();		
	}
} else {
	$blogbejegyzesek = new adatbazis();
	$blogbejegyzesek->blog_select();
}


class adatbazis{
	//adattagok
	public $servername = "mysql";
	public $username = "root";
	public $password = "root";
	public $dbname = "gipsz_jakab";	
	public $conn = NULL; 
	public $sql = NULL; 
	public $result = NULL; 
	public $row = NULL; 
	public $rows = NULL; 
	
	public function __construct(){
		$this->kapcsolodas();
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
	
	public function blog_select($keresett_szo = ""){
		$this->sql = "SELECT blog_id, blog_cim, blog_tartalom, blog_datum, blog_lathatosag, blog_szin FROM blog
		WHERE blog_cim LIKE '%$keresett_szo%'
		";
		$this->result = $this->conn->query($this->sql);

		if ($this->result->num_rows > 0) {
		  while($this->row = $this->result->fetch_assoc()) {
			echo "<div style='color: " . $this->row["blog_szin"] . ";' >";
				echo "<h1>" . $this->row["blog_cim"] . "</h1>";
				echo "<p>";	
					echo "(" . $this->row["blog_datum"] . ")<br />";
					echo "[" . (($this->row["blog_lathatosag"]==1)?"látható":"rejtett") . "]<br />";
				echo "</p>";
			echo "</div>";
		  }
		} else {
		  echo "0 results";
		}		
		
	}

}





?>