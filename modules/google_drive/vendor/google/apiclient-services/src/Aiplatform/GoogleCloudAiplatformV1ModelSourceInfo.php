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

namespace Google\Service\Aiplatform;

class GoogleCloudAiplatformV1ModelSourceInfo extends \Google\Model
{
  /**
   * @var bool
   */
  public $copy;
  /**
   * @var string
   */
  public $sourceType;

  /**
   * @param bool
   */
  public function setCopy($copy)
  {
    $this->copy = $copy;
  }
  /**
   * @return bool
   */
  public function getCopy()
  {
    return $this->copy;
  }
  /**
   * @param string
   */
  public function setSourceType($sourceType)
  {
    $this->sourceType = $sourceType;
  }
  /**
   * @return string
   */
  public function getSourceType()
  {
    return $this->sourceType;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudAiplatformV1ModelSourceInfo::class, 'Google_Service_Aiplatform_GoogleCloudAiplatformV1ModelSourceInfo');
