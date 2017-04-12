<?php

namespace Kronos\Keystore\Encryption\Encrypt;

use Kronos\Encrypt\Encrypt;
use Kronos\Keystore\EncryptionServiceInterface;
use Kronos\Keystore\Exception\EncryptionException;

class Adaptor implements EncryptionServiceInterface {

	/**
	 * @var Encrypt
	 */
	private $encrypt;

	/**
	 * Adaptor constructor.
	 * @param Encrypt $encrypt
	 */
	public function __construct(Encrypt $encrypt) {
		$this->encrypt = $encrypt;
	}

	public function encrypt($value) {
		try {
			return $this->encrypt->encrypt($value);
		}
		catch(\Exception $exception) {
			throw new EncryptionException('An error occured while encrypting value',0 , $exception);
		}
	}

	public function decrypt($value) {
		try {
			return $this->encrypt->decrypt($value);
		}
		catch(\Exception $exception) {
			throw new EncryptionException('An error occured while decrypting value',0 , $exception);
		}
	}

}