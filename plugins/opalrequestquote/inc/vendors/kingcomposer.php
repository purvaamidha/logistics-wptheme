<?php 
	/**
	 * Class Wpopal_Themer_Kingcomposer_pagebuilder
	 */
	class  Opalrequestquote_Kingcomposer_pagebuilder{
		
		public function __construct(){

			add_action('init', array( $this, "enableContentBulider") , 99 );	 
			add_action('init', array( $this, "setTemplatePath") , 99 );	 

			$this->_includes();
		}

		public function _includes(){
			require_once( OPALREQUESTQUOTE_PLUGIN_DIR .'inc/vendors/kingcomposer/elements.php'  );
		 
		}
		/**
		 *
		 */
		public function setTemplatePath(){
			global $kc;  
			$kc->set_template_path( OPALREQUESTQUOTE_PLUGIN_DIR.'templates/kingcomposer/' );
			$kc->set_template_path( get_template_directory().'/kingcomposer/' );
		}

		/**
		 * Enable content builder for megamenu and footer content.
		 */
		public function enableContentBulider(){
			global $kc;
		 
		    $kc->add_content_type( 'opalrequestquote_doctor' );	
		    $kc->add_content_type( 'opal_department' );		
		}
		 
	}

	new Opalrequestquote_Kingcomposer_pagebuilder();
?>