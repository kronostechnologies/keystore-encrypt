<?php

namespace Kronos\Tests\Keystore\Encryption\Encrypt;

use Kronos\Encrypt\Encrypt;
use Kronos\Keystore\Encryption\Encrypt\Adaptor;
use Kronos\Keystore\Exception\EncryptionException;

class AdaptorTest extends \PHPUnit_Framework_TestCase {
	const VALUE = 'value';
	const ENCRYPTED_VALUE = 'encrypted value';

	/**
	 * @var Adaptor
	 */
	private $adaptor;

	/**
	 * @var \PHPUnit_Framework_MockObject_MockObject
	 */
	private $encrypt;

	public function setUp() {
		$this->encrypt = $this->createMock(Encrypt::class);

		$this->adaptor = new Adaptor($this->encrypt);
	}

	public function test_encrypt_ShouldCallEncryptAndReturnEncryptedValue() {
		$this->encrypt
			->expects(self::once())
			->method('encrypt')
			->with(self::VALUE)
			->willReturn(self::ENCRYPTED_VALUE);

		$actualValue = $this->adaptor->encrypt(self::VALUE);

		$this->assertEquals(self::ENCRYPTED_VALUE, $actualValue);
	}

	public function test_EncryptThrowsException_encrypt_ShouldThrowEncryptionException() {
		$this->encrypt
			->method('encrypt')
			->willThrowException(new \Exception());
		$this->expectException(EncryptionException::class);

		$this->adaptor->encrypt(self::VALUE);
	}

	public function test_decrypt_ShouldCallDecryptAndReturnDecryptedValue() {
		$this->encrypt
			->expects(self::once())
			->method('decrypt')
			->with(self::ENCRYPTED_VALUE)
			->willReturn(self::VALUE);

		$actualValue = $this->adaptor->decrypt(self::ENCRYPTED_VALUE);

		$this->assertEquals(self::VALUE, $actualValue);
	}

	public function test_DecryptThrowsException_decrypt_ShouldThrowEncryptionException() {
		$this->encrypt
			->method('decrypt')
			->willThrowException(new \Exception());
		$this->expectException(EncryptionException::class);

		$this->adaptor->decrypt(self::ENCRYPTED_VALUE);
	}
}