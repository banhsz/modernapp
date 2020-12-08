<?php

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
	
	
	public function updateform_blog($id){
		$this->sql = "SELECT blog_id, blog_cim, blog_tartalom, blog_datum, blog_szin, blog_lathatosag FROM blog WHERE blog_id  = $id";
		$this->result = $this->conn->query($this->sql);

		if ($this->result->num_rows > 0) {
		  while($this->row = $this->result->fetch_assoc()) {
			echo "<fieldset>";
			echo "<legend>Blogbejegyzés módosítása űrlap</legend>";
			echo "<form method='POST'>
				Add meg a blog címét:<br />
				<input type='text' name='input_blog_cim'
				value=\"".htmlentities($this->row['blog_cim'] . '>', ENT_COMPAT)."\"
				><br />
				Add meg a blog tartalmát:<br />
				<textarea name='input_blog_tartalom'>".$this->row['blog_tartalom']. "</textarea><br />
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
		if ("1000-01-01" == $datum) {
			date_default_timezone_set('Europe/Budapest');
			$datum = date("Y-m-d");
		}
		$lathatosag = (int)$lathatosag;
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
			echo '<pre>';
			print_r(get_defined_vars());
			print_r($this->conn->error_list);
			echo "<p>Sikertelen blogbejegyzés felvétel</p>";
		}
	}

	public function blog_delete($id){
		$this->sql = "DELETE FROM
						blog
					  WHERE
						blog_id  = $id;";
		if ($this->conn->query($this->sql)){
			echo "<p>Sikeres blogbejegyzés törlés</p>";
		} else {
			echo "<p>Sikertelen blogbejegyzés törlés</p>";
		}
	}	
	public function blog_show($id){
		$this->sql = "UPDATE
						blog
					  SET
						blog_lathatosag = 1
					  WHERE
						blog_id  = $id;";
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
						blog_lathatosag = 0
					  WHERE
						blog_id  = $id;";
		
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
    
    public function getData() {
        $data = [];
        $data[] = ['Láthatóság', 'Darabszám'];
        $this->sql = 'SELECT blog_lathatosag, count(*) as c FROM `blog` group by blog_lathatosag';
        $this->result = $this->conn->query($this->sql);
        $titles = [
            0 => "Nem látható",
            1 => "Látható"
        ];
        foreach($this->result as $row) {
            $title = $titles[$row['blog_lathatosag']];
            $data[] = [$title, (int)$row['c']];
        }   
        
        echo json_encode($data);    
    }    
}