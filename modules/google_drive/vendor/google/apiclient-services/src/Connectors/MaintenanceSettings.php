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

namespace Google\Service\Connectors;

class MaintenanceSettings extends \Google\Model
{
  /**
   * @var bool
   */
  public $exclude;
  /**
   * @var bool
   */
  public $isRollback;
  protected $maintenancePoliciesType = MaintenancePolicy::class;
  protected $maintenancePoliciesDataType = 'map';

  /**
   * @param bool
   */
  public function setExclude($exclude)
  {
    $this->exclude = $exclude;
  }
  /**
   * @return bool
   */
  public function getExclude()
  {
    return $this->exclude;
  }
  /**
   * @param bool
   */
  public function setIsRollback($isRollback)
  {
    $this->isRollback = $isRollback;
  }
  /**
   * @return bool
   */
  public function getIsRollback()
  {
    return $this->isRollback;
  }
  /**
   * @param MaintenancePolicy[]
   */
  public function setMaintenancePolicies($maintenancePolicies)
  {
    $this->maintenancePolicies = $maintenancePolicies;
  }
  /**
   * @return MaintenancePolicy[]
   */
  public function getMaintenancePolicies()
  {
    return $this->maintenancePolicies;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(MaintenanceSettings::class, 'Google_Service_Connectors_MaintenanceSettings');
