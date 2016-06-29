<?php 

use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

abstract class ApiTester extends TestCase 
{
    use DatabaseMigrations;

    /**
     * Faker object.
     * 
     * @var Faker
     */
    protected $fake;

    public function __construct() 
    {
        $this->fake = Faker::create();    
    }

    /**
     * Make a call to the API.
     * 
     * @param  string $uri       
     * @param  string $method    
     * @param  array  $parameters 
     * @return Json
     */
    protected function getJson($uri, $method = 'GET', $parameters = [])
    {
        return json_decode($this->call($method, $uri, $parameters)->getContent());
    }

    /**
     * Assert that the attributes exist on the object.
     *  
     * @return void
     */
    protected function assertObjectHasAttributes()
    {
        $args = func_get_args();

        $object = array_shift($args);

        foreach ($args as $attribute) 
        {
            $this->assertObjectHasAttribute($attribute, $object);
        }
    }
}