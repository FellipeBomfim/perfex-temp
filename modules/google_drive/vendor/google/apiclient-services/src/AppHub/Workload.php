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

namespace Google\Service\AppHub;

class Workload extends \Google\Model
{
  protected $attributesType = Attributes::class;
  protected $attributesDataType = '';
  /**
   * @var string
   */
  public $createTime;
  /**
   * @var string
   */
  public $description;
  /**
   * @var string
   */
  public $discoveredWorkload;
  /**
   * @var string
   */
  public $displayName;
  /**
   * @var string
   */
  public $name;
  /**
   * @var string
   */
  public $state;
  /**
   * @var string
   */
  public $uid;
  /**
   * @var string
   */
  public $updateTime;
  protected $workloadPropertiesType = WorkloadProperties::class;
  protected $workloadPropertiesDataType = '';
  protected $workloadReferenceType = WorkloadReference::class;
  protected $workloadReferenceDataType = '';

  /**
   * @param Attributes
   */
  public function setAttributes(Attributes $attributes)
  {
    $this->attributes = $attributes;
  }
  /**
   * @return Attributes
   */
  public function getAttributes()
  {
    return $this->attributes;
  }
  /**
   * @param string
   */
  public function setCreateTime($createTime)
  {
    $this->createTime = $createTime;
  }
  /**
   * @return string
   */
  public function getCreateTime()
  {
    return $this->createTime;
  }
  /**
   * @param string
   */
  public function setDescription($description)
  {
    $this->description = $description;
  }
  /**
   * @return string
   */
  public function getDescription()
  {
    return $this->description;
  }
  /**
   * @param string
   */
  public function setDiscoveredWorkload($discoveredWorkload)
  {
    $this->discoveredWorkload = $discoveredWorkload;
  }
  /**
   * @return string
   */
  public function getDiscoveredWorkload()
  {
    return $this->discoveredWorkload;
  }
  /**
   * @param string
   */
  public function setDisplayName($displayName)
  {
    $this->displayName = $displayName;
  }
  /**
   * @return string
   */
  public function getDisplayName()
  {
    return $this->displayName;
  }
  /**
   * @param string
   */
  public function setName($name)
  {
    $this->name = $name;
  }
  /**
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }
  /**
   * @param string
   */
  public function setState($state)
  {
    $this->state = $state;
  }
  /**
   * @return string
   */
  public function getState()
  {
    return $this->state;
  }
  /**
   * @param string
   */
  public function setUid($uid)
  {
    $this->uid = $uid;
  }
  /**
   * @return string
   */
  public function getUid()
  {
    return $this->uid;
  }
  /**
   * @param string
   */
  public function setUpdateTime($updateTime)
  {
    $this->updateTime = $updateTime;
  }
  /**
   * @return string
   */
  public function getUpdateTime()
  {
    return $this->updateTime;
  }
  /**
   * @param WorkloadProperties
   */
  public function setWorkloadProperties(WorkloadProperties $workloadProperties)
  {
    $this->workloadProperties = $workloadProperties;
  }
  /**
   * @return WorkloadProperties
   */
  public function getWorkloadProperties()
  {
    return $this->workloadProperties;
  }
  /**
   * @param WorkloadReference
   */
  public function setWorkloadReference(WorkloadReference $workloadReference)
  {
    $this->workloadReference = $workloadReference;
  }
  /**
   * @return WorkloadReference
   */
  public function getWorkloadReference()
  {
    return $this->workloadReference;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Workload::class, 'Google_Service_AppHub_Workload');
