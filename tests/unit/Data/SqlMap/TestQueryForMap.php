<?php
require_once(dirname(__FILE__).'/BaseCase.php');

/**
 * @package System.Data.SqlMap
 */
class TestQueryForMap extends BaseCase
{
	function __construct()
	{
		parent::__construct();
		$this->initSqlMap();
	}

	/**
	 * Test ExecuteQueryForMap : Hashtable.
	 */
	function testExecuteQueryForMap()
	{
		$map = $this->sqlmap->QueryForMap("GetAllAccountsViaResultClass", null, "FirstName",null,0,2);
		$this->assertSame(2, count($map));
		$this->assertAccount1($map["Joe"]);

		$this->assertSame(1, $map["Joe"]->getID());
		$this->assertSame(2, $map["Averel"]->getID());
	}

	/**
	 * Test ExecuteQueryForMap with value property :
	 * "FirstName" as key, "EmailAddress" as value
	 */
	function testExecuteQueryForMapWithValueProperty()
	{
		$map = $this->sqlmap->QueryForMap("GetAllAccountsViaResultClass", null,
						"FirstName", "EmailAddress",1,3);

		$this->assertSame(3, count($map));

		$this->assertSame("Averel.Dalton@somewhere.com", $map["Averel"]);
		$this->assertNull($map["William"]);
		$this->assertSame("Jack.Dalton@somewhere.com", $map["Jack"]);
	}

}
