<?php 
	/**
	 * Class CustomRichReviews_Kingcomposer_pagebuilder
	 */
	class  CustomRichReviews_Kingcomposer_pagebuilder{
		
		public function __construct(){

			add_action('init', array( $this, "setTemplatePath") , 99 );	 

			$this->_includes();
		}

		public function _includes(){
			require_once( CUSTOM_RICH_REVIEWS_PLUGIN_DIR .'vendors/kingcomposer/elements.php'  );
		 
		}
		/**
		 *
		 */
		public function setTemplatePath(){
			global $kc;  
			$kc->set_template_path( CUSTOM_RICH_REVIEWS_PLUGIN_DIR.'templates/kingcomposer/' );
			$kc->set_template_path( get_template_directory().'/kingcomposer/' );
		}
		 
	}

	new CustomRichReviews_Kingcomposer_pagebuilder();
?>