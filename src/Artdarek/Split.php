<?php
/**
 * Version: 0.0.2 
 * Updated: 2014.12.11
 * Author: 	Dariusz Prząda (artdarek@gmail.com)
 */
class Split {

	/**
	 * Data
	 * @var array
	 */
	private $_data = array();

	/**
	 * Split
	 * @var array
	 */
	private $_split = array();

	/**
	 * Randomized item
	 * @var array
	 */
	private $_randomized = array();

	/**
	 * Construct
	 *
	 * @param  array $attributes
	 * @return self
	 */
	public function __construct( $attributes = array() )
	{
		if (array_key_exists('data', $attributes)) $this->setData($attributes['data']);
		return $this;
	}

	/**
	 * Sets array with data to split
	 *
	 * @param  array $data
	 * @return self
	 */
	public function setData( $data = array() )
	{

		if (is_array($data) and (count($data) > 0) ) {
			$this->_data = $data;
		} else $this->_data = false;

		return $this;
	}

	/**
	 * add data to data array
	 *
	 * @param  string $id
	 * @param  string $value
	 * @param  int $weight
	 * @return self
	 */
	public function addData( $id, $value, $weight = 1 )
	{
		$row = array( $id, $value, $weight );
		array_push( $this->_data, $row );
		return $this;
	}


	/**
	 * Get randomized ID
	 *
	 * @return array
	 */
	public function id()
	{
		if( count($this->_randomized) > 0 ) {
			return $this->_randomized[0];
		} else return false;
	}

	/**
	 * Get randomized Value
	 *
	 * @return array
	 */
	public function value()
	{
		if( count($this->_randomized) > 0 ) {
			return $this->_randomized[1];
		} else return false;
	}

	/**
	 * Create split array
	 *
	 * @param  array $arr
	 * @return array $split [description]
	 */
	public function buildSplitArray( $arr = false )
	{
		$split = [];
		if( is_array( $arr[0] ) ) {
			foreach( $arr as $s ) {
				if ((isset($s[2]))and( $s[2] > 0 )) $weight = $s[2]; else $weight = 1;
				$split = array_merge( $split, array_fill( 0, $weight, $s ) );
			}
		}
		return $split;
	}

	/**
	 * Get random element
	 *
	 * @param  array $array
	 * @return array
	 */
	public function randomize( $array = false )
	{	
		// randomize array key 
		$randomKey = mt_rand( 0, count($array)-1 );
		// return array element stored under randomized key
		return $this->_split[$randomKey];
	}

	/**
	 * Keep randomized value
	 *
	 * @return void
	 */
	public function keepRandomized()
	{
		return mt_srand( sprintf( '%u', ip2long( $_SERVER['REMOTE_ADDR'] ) ).crc32( $_SERVER['HTTP_USER_AGENT'] ) );
	}

	/**
	 * Run
	 *
	 * @return void
	 */
	public function run( $keep = false )
	{
		$this->_split = $this->buildSplitArray( $this->_data );

		if( count( $this->_split ) > 0 ) {
			if ($keep == true) $this->keepRandomized();
			$this->_randomized = $this->randomize( $this->_split );
		}

		return $this->_randomized;
	}

	/**
	 * Debug
	 *
	 * @return void
	 */
	public function debug()
	{
		if( isset( $_GET['debug'] ) ) {

			echo '<strong>Data:</strong><br>';
			var_dump($this->_data);
			echo '<hr>';

			echo '<strong>Split:</strong><br>';
			var_dump($this->_split);
			echo '<hr>';

			echo '<strong>Randomized value:</strong><br>';
			var_dump($this->_randomized);

			exit;
		}
	}


}