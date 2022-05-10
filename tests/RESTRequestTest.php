<?php
require_once "BaseTest.php";
use Jaspersoft\Tool\RESTRequest;

class RESTRequestTest extends BaseTest {

	/* Tests below */

    /**
     * Checks if user's attribute is saved correctly when addOrUpdateAttribute() is called with Attribute parameter, that is
     * single Attribute.
     */
	public function testHeaders_makeMultiCase() {
		
		$res = RESTRequest::splitHeaderArray([
			"start-index: 0",
			"result-count: 100",
			"total-count: 3214"
		]);
		
		$this->assertEquals(6, sizeof($res));
		$this->assertEquals("100", $res["Result-Count"]);
		$this->assertEquals("100", $res["result-count"]);
	}

	public function testHeaders_alreadyNormalCase() {
		
		$res = RESTRequest::splitHeaderArray([
			"Total-Count: 3214"
		]);
		
		$this->assertEquals(1, sizeof($res));
		$this->assertEquals("3214", $res["Total-Count"]);
	}

	public function testHeaders_emptyArray() {
		
		$res = RESTRequest::splitHeaderArray([
		]);
		
		$this->assertEquals(0, sizeof($res));
	}
	public function testHeaders_shortValues() {
		
		$res = RESTRequest::splitHeaderArray([
			"a:2",
			":3"
		]);

		$this->assertEquals(3, sizeof($res));
		$this->assertEquals("2", $res["a"]);
		$this->assertEquals("2", $res["A"]);
		$this->assertEquals("3", $res[""]);
	}
}
?>
