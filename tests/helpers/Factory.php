<?php

trait Factory 
{
    /**
     * Number of records to create.
     * 
     * @var integer
     */
    protected $times = 1;

    /**
     * Declare the properties for testing in using this method 
     * 
     * @return BadMethodCallException
     */
    protected function getStub()
    {
        throw new BadMethodCallException('Create your own getStub method to declare the fields.');
    }

    /**
     * Sets Number of records to create.
     * 
     * @param  Integer $count
     * @return $this
     */
    protected function times($count) {
        $this->times = $count;

        return $this;
    }

    /**
     * Create a record.
     * 
     * @param  string $type   
     * @param  array  $Fields 
     * @return void
     */
    protected function make($type, $Fields = []) 
    {
        while($this->times --) 
        {
            $stub = array_merge($this->getStub(), $Fields);
            $type::create($stub);
        }
    }

}