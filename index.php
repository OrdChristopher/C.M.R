<?php
	session_start ( );
	//session_destroy();
	date_default_timezone_set ( 'America/Los_Angeles' );
	
	define ( "internal_dir", "private/internal/" );
	define ( "external_dir", "private/external/" );
	
	define ( "base_dir", "/" );
	define ( "public_dir", base_dir . "public/" );
	
	require_once ( internal_dir . "database.class.php" );
	require_once ( external_dir . 'google-api/vendor/autoload.php' );
	
	require_once ( internal_dir . "control/control.class.php" );
	require_once ( internal_dir . "model/model.class.php" );
	require_once ( internal_dir . "view/view.class.php" );
	
	class Index
	{
		private $control;
		private $model;
		private $view;
		private $tag = 'index';
		private $act = null;
		
		public function __construct ( )
		{
			// Select a controller.
			( isset ( $_REQUEST [ 'tag' ] ) && !empty ( $_REQUEST [ 'tag' ] ) ) && ( $this->tag = str_replace ( '-', '_', strtolower ( $_REQUEST [ 'tag' ] ) ) ); 
			( isset ( $_REQUEST [ 'act' ] ) && !empty ( $_REQUEST [ 'act' ] ) ) && ( $this->act = str_replace ( '-', '_', strtolower ( $_REQUEST [ 'act' ] ) ) );
			
			// Setup Model-View-Control.
			$this->model = $this->autoload ( $this->tag, $this->act, 'model' );
			$this->view = new View ( $this->tag, $this->model );
			$this->control = $this->autoload ( $this->tag, $this->act, 'control', $this->model, $this->view );
			
			// Server the identity over a session, a cheap globalization hack.
			$_SESSION [ 'identity' ] = new IdentityModel (
				isset ( $_SESSION [ 'identity_id' ] ) ? $_SESSION [ 'identity_id' ] : null,
				isset ( $_SESSION [ 'google_id' ] ) ? $_SESSION [ 'google_id' ] : -1
			);
			$_SESSION [ 'identity' ]->load ( );
			
			// Execute Control Action
			if ( !method_exists ( $this->control, $this->act ) )
			{
				$this->control->__default ( );
			}
			else
			{
				$this->control->{$this->act} ( );
			}
		}
		
		public function autoload ( $tag, $act, $type, $model = null, $view = null )
		{
			$path = internal_dir . $type . "/" . $tag . "." . $type . ".php";
			$proper_type = ucfirst ( $type );
			if ( file_exists ( $path ) )
			{
				require_once ( $path );
				$class = ucfirst ( $tag ) . $proper_type;
				if ( !empty ( $model ) && is_object ( $model ) || !empty ( $view ) )
				{
					return new $class ( $model, $view );
				}
				return new $class ( );
			}
			else
			{
				echo $proper_type . " '" . $tag . "' does not exist.";
			}
		}
	}
	
	new Index ( );
?>