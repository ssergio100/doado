<?php
/**
 * classe generica de matematica, Rectangle
 * @author renatomiawaki
 *
 */
class ARMRectangle{
	public $x ;
	public $y ;
	public $width ;
	public $height ;
	public function __construct( $x  = 0, $y  = 0, $width  = 0, $height = 0 ){
		$this->x 			= $x ;
		$this->y 			= $y ;
		$this->width 		= $width ;
		$this->height 		= $height ;
	}
}