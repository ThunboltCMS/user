<?php

namespace Thunbolt\User\DI;

use Kdyby\Doctrine\EntityManager;
use Nette\DI\CompilerExtension;
use Thunbolt\User\Authenticator;
use Thunbolt\User\User;
use Thunbolt\User\UserStorage;

class UserExtension extends CompilerExtension {

	/** @var array */
	public $defaults = [
		'repository' => 'Entity\User'
	];

	public function loadConfiguration() {
		$config = $this->validateConfig($this->defaults);
		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('authenticator'))
			->setClass(Authenticator::class, ['@' . EntityManager::class, $config['repository']]);
	}

	public function beforeCompile() {
		$builder = $this->getContainerBuilder();
		$config = $this->validateConfig($this->defaults);

		$builder->getDefinition('security.userStorage')
			->setFactory(UserStorage::class)
			->addSetup('setRepository', [$config['repository']]);

		$builder->getDefinition('user')
			->setClass(User::class)
			->setFactory(User::class)
			->addSetup('setAuthenticator', [$this->prefix('@authenticator')]);
	}

}
