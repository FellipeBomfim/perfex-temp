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

namespace Google\Service\MigrationCenterAPI;

class FrameViolationEntry extends \Google\Model
{
  /**
   * @var string
   */
  public $field;
  /**
   * @var string
   */
  public $violation;

  /**
   * @param string
   */
  public function setField($field)
  {
    $this->field = $field;
  }
  /**
   * @return string
   */
  public function getField()
  {
    return $this->field;
  }
  /**
   * @param string
   */
  public function setViolation($violation)
  {
    $this->violation = $violation;
  }
  /**
   * @return string
   */
  public function getViolation()
  {
    return $this->violation;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(FrameViolationEntry::class, 'Google_Service_MigrationCenterAPI_FrameViolationEntry');
