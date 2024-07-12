<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
require_once("DatabaseUtils.php");

final class TestDBUtilsClass extends TestCase
{

	public function testClassConstructor()
	{
    		$dbUtils = new DatabaseUtils();
    		
	}
}

?>