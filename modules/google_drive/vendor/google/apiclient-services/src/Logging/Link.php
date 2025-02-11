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

namespace Google\Service\Logging;

class Link extends \Google\Model
{
  protected $bigqueryDatasetType = BigQueryDataset::class;
  protected $bigqueryDatasetDataType = '';
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
  public $lifecycleState;
  /**
   * @var string
   */
  public $name;

  /**
   * @param BigQueryDataset
   */
  public function setBigqueryDataset(BigQueryDataset $bigqueryDataset)
  {
    $this->bigqueryDataset = $bigqueryDataset;
  }
  /**
   * @return BigQueryDataset
   */
  public function getBigqueryDataset()
  {
    return $this->bigqueryDataset;
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
  public function setLifecycleState($lifecycleState)
  {
    $this->lifecycleState = $lifecycleState;
  }
  /**
   * @return string
   */
  public function getLifecycleState()
  {
    return $this->lifecycleState;
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
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Link::class, 'Google_Service_Logging_Link');
