<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

namespace Google\Service\CloudSearch;

class ResourceRoleProto extends \Google\Model
{
  /**
   * @var string
   */
  public $applicationId;
  /**
   * @var string
   */
  public $objectId;
  /**
   * @var string
   */
  public $objectPart;
  /**
   * @var int
   */
  public $roleId;

  /**
   * @param string
   */
  public function setApplicationId($applicationId)
  {
    $this->applicationId = $applicationId;
  }
  /**
   * @return string
   */
  public function getApplicationId()
  {
    return $this->applicationId;
  }
  /**
   * @param string
   */
  public function setObjectId($objectId)
  {
    $this->objectId = $objectId;
  }
  /**
   * @return string
   */
  public function getObjectId()
  {
    return $this->objectId;
  }
  /**
   * @param string
   */
  public function setObjectPart($objectPart)
  {
    $this->objectPart = $objectPart;
  }
  /**
   * @return string
   */
  public function getObjectPart()
  {
    return $this->objectPart;
  }
  /**
   * @param int
   */
  public function setRoleId($roleId)
  {
    $this->roleId = $roleId;
  }
  /**
   * @return int
   */
  public function getRoleId()
  {
    return $this->roleId;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(ResourceRoleProto::class, 'Google_Service_CloudSearch_ResourceRoleProto');
