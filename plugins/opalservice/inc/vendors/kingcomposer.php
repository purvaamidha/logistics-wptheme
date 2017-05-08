<?php 
	/**
	 * Class Wpopal_Themer_Kingcomposer_pagebuilder
	 */
	class  Opalservice_Kingcomposer_pagebuilder{
		
		public function __construct(){

			add_action('init', array( $this, "enableContentBulider") , 99 );	 
			add_action('init', array( $this, "setTemplatePath") , 99 );	 

			$this->_includes();
		}

		public function _includes(){
			require_once( OPALSERVICE_PLUGIN_DIR .'inc/vendors/kingcomposer/elements.php'  );
		 
		}
		/**
		 *
		 */
		public function setTemplatePath(){
			global $kc;  
			$kc->set_template_path( OPALSERVICE_PLUGIN_DIR.'templates/kingcomposer/' );
			$kc->set_template_path( get_template_directory().'/kingcomposer/' );
		}

		/**
		 * Enable content builder for megamenu and footer content.
		 */
		public function enableContentBulider(){
			global $kc;
		 
		    $kc->add_content_type( 'opal_service' );	
		    $kc->add_content_type( 'team' );			
		}
		 
	}

	new Opalservice_Kingcomposer_pagebuilder();
?>