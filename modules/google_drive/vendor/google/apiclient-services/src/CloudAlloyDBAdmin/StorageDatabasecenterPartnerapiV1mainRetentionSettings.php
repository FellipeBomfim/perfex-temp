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

namespace Google\Service\CloudAlloyDBAdmin;

class StorageDatabasecenterPartnerapiV1mainRetentionSettings extends \Google\Model
{
  /**
   * @var int
   */
  public $quantityBasedRetention;
  /**
   * @var string
   */
  public $retentionUnit;
  /**
   * @var string
   */
  public $timeBasedRetention;

  /**
   * @param int
   */
  public function setQuantityBasedRetention($quantityBasedRetention)
  {
    $this->quantityBasedRetention = $quantityBasedRetention;
  }
  /**
   * @return int
   */
  public function getQuantityBasedRetention()
  {
    return $this->quantityBasedRetention;
  }
  /**
   * @param string
   */
  public function setRetentionUnit($retentionUnit)
  {
    $this->retentionUnit = $retentionUnit;
  }
  /**
   * @return string
   */
  public function getRetentionUnit()
  {
    return $this->retentionUnit;
  }
  /**
   * @param string
   */
  public function setTimeBasedRetention($timeBasedRetention)
  {
    $this->timeBasedRetention = $timeBasedRetention;
  }
  /**
   * @return string
   */
  public function getTimeBasedRetention()
  {
    return $this->timeBasedRetention;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(StorageDatabasecenterPartnerapiV1mainRetentionSettings::class, 'Google_Service_CloudAlloyDBAdmin_StorageDatabasecenterPartnerapiV1mainRetentionSettings');
