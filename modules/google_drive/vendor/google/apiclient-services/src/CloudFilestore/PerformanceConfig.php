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

namespace Google\Service\CloudFilestore;

class PerformanceConfig extends \Google\Model
{
  protected $fixedIopsType = FixedIOPS::class;
  protected $fixedIopsDataType = '';
  /**
   * @var bool
   */
  public $iopsByCapacity;
  protected $iopsPerGbType = IOPSPerGB::class;
  protected $iopsPerGbDataType = '';

  /**
   * @param FixedIOPS
   */
  public function setFixedIops(FixedIOPS $fixedIops)
  {
    $this->fixedIops = $fixedIops;
  }
  /**
   * @return FixedIOPS
   */
  public function getFixedIops()
  {
    return $this->fixedIops;
  }
  /**
   * @param bool
   */
  public function setIopsByCapacity($iopsByCapacity)
  {
    $this->iopsByCapacity = $iopsByCapacity;
  }
  /**
   * @return bool
   */
  public function getIopsByCapacity()
  {
    return $this->iopsByCapacity;
  }
  /**
   * @param IOPSPerGB
   */
  public function setIopsPerGb(IOPSPerGB $iopsPerGb)
  {
    $this->iopsPerGb = $iopsPerGb;
  }
  /**
   * @return IOPSPerGB
   */
  public function getIopsPerGb()
  {
    return $this->iopsPerGb;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(PerformanceConfig::class, 'Google_Service_CloudFilestore_PerformanceConfig');
