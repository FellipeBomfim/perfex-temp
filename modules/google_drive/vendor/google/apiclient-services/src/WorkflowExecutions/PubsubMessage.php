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

namespace Google\Service\WorkflowExecutions;

class PubsubMessage extends \Google\Model
{
  /**
   * @var string[]
   */
  public $attributes;
  /**
   * @var string
   */
  public $data;
  /**
   * @var string
   */
  public $messageId;
  /**
   * @var string
   */
  public $orderingKey;
  /**
   * @var string
   */
  public $publishTime;

  /**
   * @param string[]
   */
  public function setAttributes($attributes)
  {
    $this->attributes = $attributes;
  }
  /**
   * @return string[]
   */
  public function getAttributes()
  {
    return $this->attributes;
  }
  /**
   * @param string
   */
  public function setData($data)
  {
    $this->data = $data;
  }
  /**
   * @return string
   */
  public function getData()
  {
    return $this->data;
  }
  /**
   * @param string
   */
  public function setMessageId($messageId)
  {
    $this->messageId = $messageId;
  }
  /**
   * @return string
   */
  public function getMessageId()
  {
    return $this->messageId;
  }
  /**
   * @param string
   */
  public function setOrderingKey($orderingKey)
  {
    $this->orderingKey = $orderingKey;
  }
  /**
   * @return string
   */
  public function getOrderingKey()
  {
    return $this->orderingKey;
  }
  /**
   * @param string
   */
  public function setPublishTime($publishTime)
  {
    $this->publishTime = $publishTime;
  }
  /**
   * @return string
   */
  public function getPublishTime()
  {
    return $this->publishTime;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(PubsubMessage::class, 'Google_Service_WorkflowExecutions_PubsubMessage');
