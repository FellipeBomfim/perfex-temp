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

namespace Google\Service\AndroidPublisher;

class UserInitiatedCancellation extends \Google\Model
{
  protected $cancelSurveyResultType = CancelSurveyResult::class;
  protected $cancelSurveyResultDataType = '';
  /**
   * @var string
   */
  public $cancelTime;

  /**
   * @param CancelSurveyResult
   */
  public function setCancelSurveyResult(CancelSurveyResult $cancelSurveyResult)
  {
    $this->cancelSurveyResult = $cancelSurveyResult;
  }
  /**
   * @return CancelSurveyResult
   */
  public function getCancelSurveyResult()
  {
    return $this->cancelSurveyResult;
  }
  /**
   * @param string
   */
  public function setCancelTime($cancelTime)
  {
    $this->cancelTime = $cancelTime;
  }
  /**
   * @return string
   */
  public function getCancelTime()
  {
    return $this->cancelTime;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(UserInitiatedCancellation::class, 'Google_Service_AndroidPublisher_UserInitiatedCancellation');
