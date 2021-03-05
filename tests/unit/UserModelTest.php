<?php

/**
 * Unit tests for app/models/UserModel.php (*Model class)
 */
class UserModelTest extends \PHPUnit\Framework\TestCase {

	/**
	 * Testing the object that represents the user
	 * @param object $user User
	 * @param int $id Optional ID parameter
	 * @return void
	 */
	private function userAsserts($user, $id = false) {
		$this->assertInstanceOf(stdClass::class, $user);
		$this->assertObjectHasAttribute('id', $user);
		$this->assertObjectHasAttribute('email', $user);
		$this->assertObjectHasAttribute('password', $user);

		if (is_numeric($id)) {
			$this->assertAttributeEquals($id, 'id', $user);
		}
	}

	/**
	 * @test
	 */
	public function get_all_is_working() {
		$users = UserModel::getAll();
		$this->assertInternalType('array', $users);

		if (count($users) > 0) {
			$user = $users[0];
			$this->userAsserts($user);
		}
	}

	/**
	 * @test
	 */
	public function get_by_id_is_working() {
		$id = 1;
		$user = UserModel::getById($id);

		if (gettype($user) === 'object') {
			$this->userAsserts($user, $id);
		} else {
			$this->assertFalse($user);
		}
	}

	/**
	 * @test
	 */
	public function all_is_working() {
		$user = [
			'email' => 'foobar@example.com',
			'first_name' => 'Foo',
			'last_name' => 'Bar',
			'password' => Crypto::sha512('admin', true)
		];

		// create
		$create = UserModel::create($user);
		$this->assertTrue(is_numeric($create));

		// getById
		$getById = UserModel::getById($create);
		$this->assertNotFalse($getById);
		$this->userAsserts($getById, $create);

		// update
		$user['last_name'] = 'Baz';
		$update = UserModel::update($create, $user);
		$this->assertTrue($update);

		// getByEmailAndPassword
		$getByEmailAndPassword = UserModel::getByEmailAndPassword($user['email'], $user['password']);
		$this->assertNotFalse($getByEmailAndPassword);
		$this->assertEquals($getByEmailAndPassword->last_name, $user['last_name']);
		$this->userAsserts($getByEmailAndPassword, $create);

		// delete
		$delete = UserModel::delete($create);
		$this->assertTrue($delete);
	}

}
