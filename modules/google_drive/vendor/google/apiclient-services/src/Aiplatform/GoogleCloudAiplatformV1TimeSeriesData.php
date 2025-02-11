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

class GoogleCloudAiplatformV1TimeSeriesData extends \Google\Collection
{
  protected $collection_key = 'values';
  /**
   * @var string
   */
  public $tensorboardTimeSeriesId;
  /**
   * @var string
   */
  public $valueType;
  protected $valuesType = GoogleCloudAiplatformV1TimeSeriesDataPoint::class;
  protected $valuesDataType = 'array';

  /**
   * @param string
   */
  public function setTensorboardTimeSeriesId($tensorboardTimeSeriesId)
  {
    $this->tensorboardTimeSeriesId = $tensorboardTimeSeriesId;
  }
  /**
   * @return string
   */
  public function getTensorboardTimeSeriesId()
  {
    return $this->tensorboardTimeSeriesId;
  }
  /**
   * @param string
   */
  public function setValueType($valueType)
  {
    $this->valueType = $valueType;
  }
  /**
   * @return string
   */
  public function getValueType()
  {
    return $this->valueType;
  }
  /**
   * @param GoogleCloudAiplatformV1TimeSeriesDataPoint[]
   */
  public function setValues($values)
  {
    $this->values = $values;
  }
  /**
   * @return GoogleCloudAiplatformV1TimeSeriesDataPoint[]
   */
  public function getValues()
  {
    return $this->values;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudAiplatformV1TimeSeriesData::class, 'Google_Service_Aiplatform_GoogleCloudAiplatformV1TimeSeriesData');
