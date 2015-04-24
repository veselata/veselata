<?php

namespace Administration\Service;

use Zend\Permissions\Acl\AclInterface;
use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Role\GenericRole;
use Zend\Permissions\Acl\Resource\GenericResource;

class AclService implements AclInterface {

    protected $acl;
    protected $aclConfig;

    public function __construct(Acl $acl, $aclConfig) {
        $this->acl = $acl;

        if (!is_array($aclConfig) || empty($aclConfig) ||
            !isset($aclConfig['roles']) || !isset($aclConfig['resources'])
        ) {
            throw new \Exception('Invalid parameter passed in ' . __FUNCTION__);
        }
        $this->aclConfig = $aclConfig;

        $this->addRoles();
        $this->addResources();
    }

    public function addRoles() {
        $userRoleList = array_values(\Administration\Model\Users::getUserRoleList());
        foreach ($this->aclConfig['roles'] as $name => $parent) {
            if (!in_array($name, $userRoleList)) {
                throw new \Exception('Role names don\'t exist. Please double check acl config.');
            }
            if (!$this->acl->hasRole($name)) {
                $this->acl->addRole(new GenericRole($name), $parent);
            }
        }
    }

    public function addResources() {
        foreach ($this->aclConfig['resources'] as $permission => $controllers) {
            foreach ($controllers as $action => $roles) {
                if ($action && !$this->acl->hasResource($action)) {
                    $this->acl->addResource(new GenericResource($action));
                }

                $roles = !is_array($roles) ? array($roles) : $roles;
                foreach ($roles as $role) {
                    if ($permission == 'allow') {
                        $this->acl->allow($role, $action);
                    } elseif ($permission == 'deny') {
                        $this->acl->deny($role, $action);
                    } else {
                        throw new \Exception('No valid permission defined: ' . $permission);
                    }
                }
            }
        }
    }

    public function isAllowed($role = null, $resource = null, $privilege = null) {
        return $this->acl->isAllowed($role, $resource, $privilege);
    }

    public function hasResource($resource) {
        return $this->acl->hasResource($resource);
    }

}
