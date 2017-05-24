<?php

namespace Kronos\Keystore\Encryption\Encrypt;

use Kronos\Encrypt\Encrypt;

class Factory {
	public function createAdaptor(Encrypt $encrypt) {
		return new Adaptor($encrypt);
	}
}