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

namespace Google\Service\Contactcenterinsights;

class GoogleCloudContactcenterinsightsV1alpha1ConversationLevelSentiment extends \Google\Model
{
  /**
   * @var int
   */
  public $channelTag;
  protected $sentimentDataType = GoogleCloudContactcenterinsightsV1alpha1SentimentData::class;
  protected $sentimentDataDataType = '';

  /**
   * @param int
   */
  public function setChannelTag($channelTag)
  {
    $this->channelTag = $channelTag;
  }
  /**
   * @return int
   */
  public function getChannelTag()
  {
    return $this->channelTag;
  }
  /**
   * @param GoogleCloudContactcenterinsightsV1alpha1SentimentData
   */
  public function setSentimentData(GoogleCloudContactcenterinsightsV1alpha1SentimentData $sentimentData)
  {
    $this->sentimentData = $sentimentData;
  }
  /**
   * @return GoogleCloudContactcenterinsightsV1alpha1SentimentData
   */
  public function getSentimentData()
  {
    return $this->sentimentData;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudContactcenterinsightsV1alpha1ConversationLevelSentiment::class, 'Google_Service_Contactcenterinsights_GoogleCloudContactcenterinsightsV1alpha1ConversationLevelSentiment');
