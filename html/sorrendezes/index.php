<?php
//echo "<pre>"; var_dump($_REQUEST); echo "</pre>";

if(isset($_GET["action"]) and $_GET["action"]=="cim_novekvo"){
	$blogbejegyzesek = new adatbazis();
	$blogbejegyzesek->blog_select(" ORDER BY blog_cim ASC");
} else if(isset($_GET["action"]) and $_GET["action"]=="cim_csokkeno"){
	$blogbejegyzesek = new adatbazis();
	$blogbejegyzesek->blog_select(" ORDER BY blog_cim DESC");	
	
} else if(isset($_GET["action"]) and $_GET["action"]=="tartalom_novekvo"){
	$blogbejegyzesek = new adatbazis();
	$blogbejegyzesek->blog_select(" ORDER BY blog_tartalom ASC");	
} else if(isset($_GET["action"]) and $_GET["action"]=="tartalom_csokkeno"){
	$blogbejegyzesek = new adatbazis();
	$blogbejegyzesek->blog_select(" ORDER BY blog_tartalom DESC");		
} else {
	$blogbejegyzesek = new adatbazis();
	$blogbejegyzesek->blog_select(" ORDER BY blog_cim ASC");	
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
	
	public function blog_select($rendezes){
		$this->sql = "SELECT blog_id, blog_cim, blog_tartalom, blog_datum, blog_lathatosag, blog_szin FROM blog" . $rendezes;
		$this->result = $this->conn->query($this->sql);

		if ($this->result->num_rows > 0) {
		  echo "<table>";
				echo "<tr>";
					echo "<td>";
					echo "<p><b>Cím</b></p>";
						echo "<a href='index.php?action=cim_novekvo'>+</a> &nbsp;";
						echo "<a href='index.php?action=cim_csokkeno'>-</a>";
					echo "</td>";
					echo "<td>";
					echo "<p><b>Tartalom</b></p>";
						echo "<a href='index.php?action=tartalom_novekvo'>+</a> &nbsp;";
						echo "<a href='index.php?action=tartalom_csokkeno'>-</a>";
					echo "</td>";					
				echo "</tr>";
		  while($this->row = $this->result->fetch_assoc()) {
			echo "<tr>";
				echo "<td>";
					echo "<h1>" . $this->row["blog_cim"] . "</h1>";
					echo "<p>(" . $this->row["blog_datum"] . ")</p>";
				echo "</td>";
				echo "<td>";
					echo "<p>";	
						echo $this->row["blog_tartalom"];
					echo "</p>";
				echo "</td>";					
			echo "</tr>";
		  }
		  echo "</table>";
		} else {
		  echo "0 results";
		}		
		
	}

}





?>