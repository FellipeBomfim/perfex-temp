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

namespace Google\Service\DiscoveryEngine;

class GoogleCloudDiscoveryengineV1betaSearchRequestEmbeddingSpecEmbeddingVector extends \Google\Collection
{
  protected $collection_key = 'vector';
  /**
   * @var string
   */
  public $fieldPath;
  /**
   * @var float[]
   */
  public $vector;

  /**
   * @param string
   */
  public function setFieldPath($fieldPath)
  {
    $this->fieldPath = $fieldPath;
  }
  /**
   * @return string
   */
  public function getFieldPath()
  {
    return $this->fieldPath;
  }
  /**
   * @param float[]
   */
  public function setVector($vector)
  {
    $this->vector = $vector;
  }
  /**
   * @return float[]
   */
  public function getVector()
  {
    return $this->vector;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudDiscoveryengineV1betaSearchRequestEmbeddingSpecEmbeddingVector::class, 'Google_Service_DiscoveryEngine_GoogleCloudDiscoveryengineV1betaSearchRequestEmbeddingSpecEmbeddingVector');
