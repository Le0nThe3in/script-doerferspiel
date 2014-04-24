<?php
#######################################################
##   Dörferspiel • 28. Juni 2007 • © IT-Talent.de    ##
#######################################################

class MySQL {

	public function __construct($host, $username, $pw, $database) {
		$mysqli = @new mysqli($host, $username, $pw, $database);

		if ($mysqli->connect_errno) {
			$this->displayError('Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
		}

		$this->con = $mysqli;

		$this->query("SET NAMES 'utf8'");
	}

	public function query($sql) {
		if ($res = $this->con->query($sql)) {
			return $res;
		}

		$this->displayError('<b>SQL-Error</b> (' . $this->con->errno . ')<br />' . $this->con->error . '<br /><br />' . htmlspecialchars($sql));
	}

	public function fetch_array($result) {
		return $result->fetch_assoc();
	}

	public function fetch_object($result) {
		return $result->fetch_object();
	}

	public function num_rows($result) {
		return $result->num_rows;
	}

	public function result($result, $int) {
		$row = $result->fetch_row();
		return $row[0];
	}

	public function insert_id() {
		return $this->con->insert_id;
	}

	public function free_result($res) {
		$res->free();
	}

	public function chars($var) {
		return $this->con->real_escape_string($var);
	}

	public function affected_rows() {
		return $this->con->affected_rows;
	}

	private function displayError($sql) {
		echo '	<html>
					<head>
						<style>
						body{padding:20px;font-family:verdana,arial}
						div{margin:auto;width:400px;none}
						a{color:blue}
						</style>
					</head>
					<body>
						<div>' . $sql . '</div>
					</body>
				</html>
		';
		exit;
	}
}

?>