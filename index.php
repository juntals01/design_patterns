<?php
/**
 * Description: Learning Design Patterns
 * @author Mugs and Coffee
 * @written Norberto Q. Libago Jr.
 * @since Friday, March 24, 2013
 * @version 1.0.0
 */

require_once 'singleton/mdldatabase.php';

class design_patterns{
	
	private $_mBenchmarkstart;
	private $_mBenchmarkend;
	
	//call the method of pattern on the constructor in which pattern to use
	function __construct(){
		$this->_useSingleton();
		
	}
	
	private function _useSingleton(){
		
		//even if how many instance used, it only returns
		Mdldatabase::get_instance();
		global $all_tables;

		Mdldatabase::get_instance();
		
		print_r($all_tables);
		
		
	}
	
}

new design_patterns();
?>