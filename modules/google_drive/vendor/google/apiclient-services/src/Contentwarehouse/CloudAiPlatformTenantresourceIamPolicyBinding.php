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

namespace Google\Service\Contentwarehouse;

class CloudAiPlatformTenantresourceIamPolicyBinding extends \Google\Collection
{
  protected $collection_key = 'members';
  /**
   * @var string[]
   */
  public $members;
  /**
   * @var string
   */
  public $resource;
  /**
   * @var string
   */
  public $resourceType;
  /**
   * @var string
   */
  public $role;

  /**
   * @param string[]
   */
  public function setMembers($members)
  {
    $this->members = $members;
  }
  /**
   * @return string[]
   */
  public function getMembers()
  {
    return $this->members;
  }
  /**
   * @param string
   */
  public function setResource($resource)
  {
    $this->resource = $resource;
  }
  /**
   * @return string
   */
  public function getResource()
  {
    return $this->resource;
  }
  /**
   * @param string
   */
  public function setResourceType($resourceType)
  {
    $this->resourceType = $resourceType;
  }
  /**
   * @return string
   */
  public function getResourceType()
  {
    return $this->resourceType;
  }
  /**
   * @param string
   */
  public function setRole($role)
  {
    $this->role = $role;
  }
  /**
   * @return string
   */
  public function getRole()
  {
    return $this->role;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(CloudAiPlatformTenantresourceIamPolicyBinding::class, 'Google_Service_Contentwarehouse_CloudAiPlatformTenantresourceIamPolicyBinding');
