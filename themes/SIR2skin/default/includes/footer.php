<?php
if(!empty($this->data['htmlinject']['htmlContentPost'])) {
	foreach($this->data['htmlinject']['htmlContentPost'] AS $c) {
		echo $c;
	}
}
?>
	</div><!-- #content -->
	<div id="footer">
		<hr />

		<a href="https://www.rediris.es/sir2"><img src="<?php echo SimpleSAML_Module::getModuleURL('sir2skin/logo-fed-sir2.png'); ?>" alt="Small fish logo" style="float: right" /></a><img src="/<?php echo $this->data['baseurlpath']; ?>resources/icons/ssplogo-fish-small.png" alt="Small fish logo" style="float: right" />		
		Copyright &copy; <?php echo date("Y"); ?> <a href="http://www.tuorganizacion.es/">Tu organización</a>
		
		<br style="clear: right" />
	
	</div><!-- #footer -->

</div><!-- #wrap -->

</body>
</html>
