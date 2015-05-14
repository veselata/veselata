<?php

namespace Administration\Service;

use Zend\Authentication\AuthenticationService;
use Zend\Validator\AbstractValidator;

class AuthService extends AbstractValidator {

    const INVALID_CREDENTIALS = 'invalidCredentials';
    const NOTALLOWED = 'notAllowed';

    /**
     * Error Messages
     * @var array
     */
    protected $messageTemplates = array(
        self::INVALID_CREDENTIALS => 'Invalid credentials provided',
        self::NOTALLOWED => 'Not allowed to the resource',
    );

    /**
     *
     * @var Zend\Authentication\AuthenticationService
     */
    protected $authService;

    public function __construct(AuthenticationService $authService) {
        $this->authService = $authService;
        $this->setOptions(array('messageTemplates' => $this->messageTemplates));
    }

    /**
     *
     * @param array $authParameters
     * @return boolean
     */
    public function isValid($authParameters) {
        if (!is_array($authParameters) ||
                !isset($authParameters['username']) ||
                !isset($authParameters['password'])
        ) {
            throw new \Exception('Invalid parameter passed in ' . __FUNCTION__);
        }
        $adapter = $this->authService->getAdapter();

        $adapter->setIdentityValue($authParameters['username']);
        $adapter->setCredentialValue($authParameters['password']);

        $authResult = $this->authService->authenticate($adapter);

        if ($authResult->isValid()) {
            $identity = $authResult->getIdentity();
            if ($identity->getStatus() !== \Administration\Model\BaseModel::STATUS_ACTIVE) {
                $this->error(self::NOTALLOWED);
                return false;
            }

            $this->authService->getStorage()->write($identity);
            return true;
        }
        $this->error(self::INVALID_CREDENTIALS);
        return false;
    }

    /**
     *
     * @return void
     */
    public function getIdentity() {
        return $this->authService->getIdentity();
    }

    /**
     *
     * @return void
     */
    public function clearIdentity() {
        $this->authService->clearIdentity();
    }

    /**
     * @return void
     */
    public function hasAdminAccess() {
        return $this->authService->hasIdentity();
    }

    /**
     *
     * @return array
     */
    public function getUserIdentity() {
        $userRoleList = \Administration\Model\Users::getTypeList();
        $defaultRole = $userRoleList[\Administration\Model\Users::TYPE_GUEST];
        $identity = array('role' => $defaultRole);

        if ($this->authService->hasIdentity()) {
            $storage = $this->authService->getStorage()->read();
            $identity['name'] = $storage->getName();
            $identity['role'] = isset($userRoleList[$storage->getType()]) ? $userRoleList[$storage->getType()] : $defaultRole;
            $identity['username'] = $storage->getUsername();
        }

        return $identity;
    }

}
