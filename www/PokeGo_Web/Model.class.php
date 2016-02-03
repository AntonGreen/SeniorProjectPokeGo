<?php
// no changes were made
abstract class Model
{
    protected $inData; // input
    protected $outData;    // output

    public function _construct(&$data='')
    {
        if($data!='')
        {
             $this->inData=$data;
        }
    }
    public function setData($data)
    {
       $this->inData=$data;
    }
    public function getData()
    {
     	return $this->outData;
    }
    //implement this function to process the model's data
    abstract public function process();
}

?>