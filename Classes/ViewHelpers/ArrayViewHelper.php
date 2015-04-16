<?php

class Tx_AlmPortfolio_ViewHelpers_ArrayViewHelper extends Tx_Fluid_ViewHelpers_Form_AbstractFormFieldViewHelper {

	/**
     * Array Viewhelper
     *
     * @return array
     */
    public function render()
    {
    	$arr = $this->renderChildren();
    	$arr = explode(',', $arr);

        return $arr;
    }
}

?>