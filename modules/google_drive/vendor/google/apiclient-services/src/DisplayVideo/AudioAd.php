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

namespace Google\Service\DisplayVideo;

class AudioAd extends \Google\Model
{
  /**
   * @var string
   */
  public $displayUrl;
  /**
   * @var string
   */
  public $finalUrl;
  /**
   * @var string
   */
  public $trackingUrl;
  protected $videoType = YoutubeVideoDetails::class;
  protected $videoDataType = '';

  /**
   * @param string
   */
  public function setDisplayUrl($displayUrl)
  {
    $this->displayUrl = $displayUrl;
  }
  /**
   * @return string
   */
  public function getDisplayUrl()
  {
    return $this->displayUrl;
  }
  /**
   * @param string
   */
  public function setFinalUrl($finalUrl)
  {
    $this->finalUrl = $finalUrl;
  }
  /**
   * @return string
   */
  public function getFinalUrl()
  {
    return $this->finalUrl;
  }
  /**
   * @param string
   */
  public function setTrackingUrl($trackingUrl)
  {
    $this->trackingUrl = $trackingUrl;
  }
  /**
   * @return string
   */
  public function getTrackingUrl()
  {
    return $this->trackingUrl;
  }
  /**
   * @param YoutubeVideoDetails
   */
  public function setVideo(YoutubeVideoDetails $video)
  {
    $this->video = $video;
  }
  /**
   * @return YoutubeVideoDetails
   */
  public function getVideo()
  {
    return $this->video;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(AudioAd::class, 'Google_Service_DisplayVideo_AudioAd');
