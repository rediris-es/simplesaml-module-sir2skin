<?php
/**
 * Do not allow to frame simpleSAMLphp pages from another location.
 * This prevents clickjacking attacks in modern browsers.
 *
 * If you don't want any framing at all you can even change this to
 * 'DENY', or comment it out if you actually want to allow foreign
 * sites to put simpleSAMLphp in a frame. The latter is however
 * probably not a good security practice.
 */
header('X-Frame-Options: SAMEORIGIN');
?>
<!DOCTYPE html>

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	<meta name="HandheldFriendly" content="true" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<meta name="robots" content="noindex, nofollow" />
	<title><?php
if(array_key_exists('header', $this->data)) {
        echo $this->data['header'];
} else {
        echo 'Proveedor de Identidad de __________';  //TODO: Preconfigurar esto
}
?></title>

	<link rel="stylesheet" type="text/css" href="<?php echo SimpleSAML_Module::getModuleURL('SIR2skin/style.css'); ?>" />
  <link rel="stylesheet" media="screen and (max-width: 370px)" href="<?php echo SimpleSAML_Module::getModuleURL('SIR2skin/style_320.css'); ?>" />
	<link rel="stylesheet" media="screen and (max-device-width: 480px), handheld" href="<?php echo SimpleSAML_Module::getModuleURL('SIR2skin/style_480.css'); ?>" />
	
	<script type="text/javascript">
	function initiate(){
		document.getElementById('username').focus();
	}
	</script>
	
</head>

<body class="index" onload="initiate()">
	<!-- WRAPPER EXTERIOR -->
	<div id="wrapper">
	
		<!-- CABECERA CON LOGOTIPO Y HINT DE INTRODUCCION DE CONTRASEÑA -->
		<div id="header">
			<img id="logo" src="<?php echo SimpleSAML_Module::getModuleURL('SIR2skin/logo-transp.png'); ?>" alt="" /> <!-- DIT IS HET LOGO -->
			<h1 class="mainTitle"></h1>				        <!-- TITULO -->
			<ul class="langSelect">

<?php 
$includeLanguageBar = FALSE;
if (!empty($_POST)) 
	$includeLanguageBar = FALSE;
if (isset($this->data['hideLanguageBar']) && $this->data['hideLanguageBar'] === TRUE) 
	$includeLanguageBar = FALSE;

if ($includeLanguageBar) {
	$languages = $this->getLanguageList();
	$langnames = array();
	foreach($languages as $k => $v) {
		$langnames[$k] = strtoupper($k);
	}	
	$textarray = array();
	foreach ($languages AS $lang => $current) {
		$lang = strtolower($lang);
		if ($current) {
			$textarray[] = '<li class="active">' . $langnames[$lang] . "</li>";
		} else {
			$textarray[] = '<li><a href="' . htmlspecialchars(SimpleSAML_Utilities::addURLparameter(SimpleSAML_Utilities::selfURL(), array('language' => $lang))) . '">' .
				$langnames[$lang] . '</a></li>';
		}
	}
	echo join($textarray);
}
?>

<!--
				<li class="active"><a href="#">NL</a>
				<li><a href="#">EN</a>
				<li><a href="#">DE</a>
-->

			</ul>
		</div>
		<!-- FIN DEL LOGOTIPO Y TITULO -->
		
		<div id="content">
			<!-- COMIENZO DE INICIO DE SESION -->
			<div class="item">
				<h1><?php echo $this->t('{login:user_pass_header}'); ?></h1>
				<p class="info"><?php echo $this->t('{login:user_pass_text}'); ?></p>

<?php
if ($this->data['errorcode'] !== NULL) {
?>

				<p class="error"><?php echo $this->t('{errors:descr_' . $this->data['errorcode'] . '}'); ?></p> <!-- ERRORHANDLER BIJ HET INLOGGEN -->

<?php
}
?>				
				<form id="login" method="POST" action="?" name="f">
					<label for="username"><?php echo $this->t('{login:username}'); ?></label> <!-- <span class="example">(bv. 123456@catherijne.nl)</span> -->
					<input type="text" name="username" id="username" value="<?php echo htmlspecialchars($this->data['username']); ?>" autocomplete= "off" />
					<label for="password"><?php echo $this->t('{login:password}'); ?></label>
					<input type="password" name="password" id="password" autocomplete= "off" />
					<!-- <a href="#" class="recover">Wachtwoord vergeten?</a> -->
					<input onclick="this.value='Procesando...';this.disabled=true;this.form.submit();return true;" type="submit" value="<?php echo $this->t('{login:login_button}'); ?>" />

<?php
foreach ($this->data['stateparams'] as $name => $value) {
	echo('<input type="hidden" name="' . htmlspecialchars($name) . '" value="' . htmlspecialchars($value) . '" />');
}
?>

				</form>
			</div>
			<!-- FIN CASILLA DE INICIO DE SESION -->
			
			<!-- COMIENZO BANNER FEDERACIONES -->
			<div class="subitem">

			  <div class="createIndex">
                <h2><abbr title="Proveedor de Identidad">IdP</abbr> perteneciente a las federaciones SIR2 y eduGAIN</h2>
                <p>Este proveedor est&aacute; unido a las federaciones:</p>
                <p>
                <div id="logos">
                 <a href="https://www.rediris.es/sir2" title="Federaci&oacute;n SIR2" alt="Federaci&oacute;n SIR2"><img id="logo-sir2" height="32px" src="<?php echo SimpleSAML_Module::getModuleURL('SIR2skin/logo-fed-sir2.png'); ?>" alt="SIR2" /></a>
                 <a href="https://www.edugain.org" title="Interfederaci&oacute;n eduGAIN" alt="eduGAIN"><img id="logo-edugain" height="35px" src="<?php echo SimpleSAML_Module::getModuleURL('SIR2skin/logo-fed-eduGAIN.png'); ?>" alt="Federaci&oacute;n eduGAIN" /></a>
                </div>
			  </div>

			<!-- FIN BANNER FEDERACIONES -->
		</div>
		
		<!-- FOOTER -->
        <div id="footer">
			<p> &copy; <?php echo date("Y") ?> Tu organización</p>
		</div> 
		<!-- FIN DE FOOTER -->
	</div>
</body>
</html>
