<?php
require("user.php");

use PHPUnit\Framework\TestCase;

class userTest extends TestCase {

	public function testInit(){

        $user = new user();

        $this->assertTrue((new user())->get_user_byusername("No User"), "Error during selection");
    }
    
}

?>