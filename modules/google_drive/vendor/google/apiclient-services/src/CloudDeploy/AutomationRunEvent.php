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

namespace Google\Service\CloudDeploy;

class AutomationRunEvent extends \Google\Model
{
  /**
   * @var string
   */
  public $automationId;
  /**
   * @var string
   */
  public $automationRun;
  /**
   * @var string
   */
  public $destinationTargetId;
  /**
   * @var string
   */
  public $message;
  /**
   * @var string
   */
  public $pipelineUid;
  /**
   * @var string
   */
  public $ruleId;
  /**
   * @var string
   */
  public $type;

  /**
   * @param string
   */
  public function setAutomationId($automationId)
  {
    $this->automationId = $automationId;
  }
  /**
   * @return string
   */
  public function getAutomationId()
  {
    return $this->automationId;
  }
  /**
   * @param string
   */
  public function setAutomationRun($automationRun)
  {
    $this->automationRun = $automationRun;
  }
  /**
   * @return string
   */
  public function getAutomationRun()
  {
    return $this->automationRun;
  }
  /**
   * @param string
   */
  public function setDestinationTargetId($destinationTargetId)
  {
    $this->destinationTargetId = $destinationTargetId;
  }
  /**
   * @return string
   */
  public function getDestinationTargetId()
  {
    return $this->destinationTargetId;
  }
  /**
   * @param string
   */
  public function setMessage($message)
  {
    $this->message = $message;
  }
  /**
   * @return string
   */
  public function getMessage()
  {
    return $this->message;
  }
  /**
   * @param string
   */
  public function setPipelineUid($pipelineUid)
  {
    $this->pipelineUid = $pipelineUid;
  }
  /**
   * @return string
   */
  public function getPipelineUid()
  {
    return $this->pipelineUid;
  }
  /**
   * @param string
   */
  public function setRuleId($ruleId)
  {
    $this->ruleId = $ruleId;
  }
  /**
   * @return string
   */
  public function getRuleId()
  {
    return $this->ruleId;
  }
  /**
   * @param string
   */
  public function setType($type)
  {
    $this->type = $type;
  }
  /**
   * @return string
   */
  public function getType()
  {
    return $this->type;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(AutomationRunEvent::class, 'Google_Service_CloudDeploy_AutomationRunEvent');
