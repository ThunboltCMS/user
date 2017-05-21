<?php

declare(strict_types=1);

namespace Thunbolt\User\Interfaces;

interface IUserModel {

	/**
	 * @param string $password
	 */
	public function setPassword(string $password): void;

	/**
	 * @return string
	 */
	public function getPassword(): string;

	/**
	 * @return int
	 */
	public function getId(): int;

	/**
	 * @return IUserRole|null
	 */
	public function getRole(): ?IUserRole;

	/**
	 * @return string
	 */
	public function getName(): string;

	/**
	 * @return string
	 */
	public function getAvatar(): string;

	/**
	 * @return bool
	 */
	public function isAdmin(): bool;

	/**
	 * @return \DateTime|null
	 */
	public function getRegistrationDate(): ?\DateTime;

}
