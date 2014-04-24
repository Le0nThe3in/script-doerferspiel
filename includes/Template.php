<?php
#######################################################
##   Dörferspiel • 28. Juni 2007 • © IT-Talent.de    ##
#######################################################

class Template {
	private $dir = 'templates/';
	private $error;
	private $vars = array();
	private $blocks = array();
	private $root;

	public function __construct() {
		global $root;

		$this->root = $root;
	}

	public function assign($vars, $value = null) {
		if (is_array($vars)) {
			$this->vars = array_merge($this->vars, $vars);
		} else if ($value !== null) {
			$this->vars[$vars] = $value;
		}
	}

	public function block_assign($name, $array) {
		$this->blocks[$name][] = (array)$array;
	}

	public function compile_vars($var) {
		$newvar = $this->compile_var($var[1]);

		return "<?php echo isset(" . $newvar . ") ? " . $newvar . " : '{" . $var[1] . "}' ?>";
	}

	public function compile_var($var) {
		if (strpos($var, '.') === false) {
			$var = '$this->vars[\'' . $var . '\']';
		} else {
			$vars = explode('.', $var);

			if (!isset($this->blocks[$vars[0]]) && isset($this->vars[$var[0]]) && gettype($this->vars[$var[0]]) == 'array') {
				$var = '$this->vars[\'' . $vars[0] . '\'][\'' . $vars[1] . '\']';
			} else {
				$var = preg_replace("#(.*)\.(.*)#", "\$_$1['$2']", $var);
			}
		}

		return $var;
	}

	public function compile_tags($match) {
		global $root;

		switch ($match[1]) {
			case 'INCLUDE':
				return "<?php echo \$this->compile('" . $match[2] . "'); ?>";
			break;

			case 'INCLUDEPHP':
				return "<?php echo include('" . $root  . "/" . $this->dir . $match[2] . "'); ?>";
			break;

			case 'IF':
				return $this->compile_if($match[2], false);
			break;

			case 'ELSEIF':
				return $this->compile_if($match[2], true);
			break;

			case 'ELSE':
				return "<?php } else { ?>";
			break;

			case 'ENDIF':
				return "<?php } ?>";
			break;

			case 'BEGIN':
				return "<?php if (isset(\$this->blocks['" . $match[2] . "'])) { foreach (\$this->blocks['" . $match[2] . "'] as \$_" . $match[2] . ") { ?>";
			break;

			case 'BEGINELSE':
				return "<?php } } else { { ?>";
			break;

			case 'END':
				return "<?php } } ?>";
			break;
		 }
	}

	public function compile_if($code, $elseif) {
		$ex = explode(' ', trim($code));
		$code = '';

		foreach ($ex as $value) {
			$chars = strtolower($value);

			switch ($chars) {
				case 'and':
				case '&&':
				case 'or':
				case '||':
				case '==':
				case '!=':
				case '>':
				case '<':
				case '>=':
				case '<=':
				case '0':
				case is_numeric($value):
					$code .= $value;
				break;

				case 'not':
					$code .= '!';
				break;

				default:

					if (preg_match('/^[A-Za-z0-9_\-\.]+$/i', $value)) {
						$var = $this->compile_var($value);

						$code .= "(isset(" . $var . ") ? " . $var . " : '')";
					} else {
						$code .= '\'' . preg_replace("#(\\\\|\'|\")#", '', $value) . '\'';
					}

				break;
			}

			$code .= ' ';
		}

		return '<?php ' . (($elseif) ? '} else ' : '') . 'if (' . trim($code) . ") { ?>";
	}

	public function cache($cache_file, $tpl) {
		global $root;

		$f = @fopen($cache_file, 'w');

		if ($f) {
			$bytes = fwrite($f, $tpl);
			fclose($f);
		}
	}

	public function compile($file) {
		$abs_file = $this->root . $this->dir . $file;
		$cache_file = $this->root . 'includes/cache/tpl_' . str_replace(array('themes/', 'admin/template/', '/'), array('', 'adm_', '_'), $this->dir . $file) . '.php';

		if (file_exists($cache_file) && filemtime($cache_file) > filemtime($abs_file)) {
			include $cache_file;
			return;
		}

		$tpl = $uncompiled = @file_get_contents($abs_file);

		$tpl = preg_replace("#<\?(.*)\?>#", '', $tpl);
		$tpl = preg_replace_callback("#<!-- ([A-Z]+) (.*)? ?-->#U", array($this, 'compile_tags'), $tpl);
		$tpl = preg_replace_callback("#{([A-Za-z0-9_\-.]+)}#U", array($this, 'compile_vars'), $tpl);

		if (eval(' ?>' . $tpl . '<?php ') === false) {
			$this->error($file, $uncompiled);
		} else if ($tpl) {
			$this->cache($cache_file, $tpl);
		}
	}

	public function error($file, $tpl) {
		exit('Fehler im Template: <b>' . $file . '</b><hr /><pre>' . preg_replace("#&lt;!-- ([A-Z]+) (.*)? ?--&gt;#U", '<font color="red">$0</font>', htmlspecialchars($tpl)) . '</pre>');
	}

	public function display($file) {
		$this->compile($file);
		exit;
	}
}

?>