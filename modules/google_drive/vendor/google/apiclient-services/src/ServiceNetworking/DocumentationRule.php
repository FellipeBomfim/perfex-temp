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

namespace Google\Service\ServiceNetworking;

class DocumentationRule extends \Google\Model
{
  /**
   * @var string
   */
  public $deprecationDescription;
  /**
   * @var string
   */
  public $description;
  /**
   * @var string
   */
  public $disableReplacementWords;
  /**
   * @var string
   */
  public $selector;

  /**
   * @param string
   */
  public function setDeprecationDescription($deprecationDescription)
  {
    $this->deprecationDescription = $deprecationDescription;
  }
  /**
   * @return string
   */
  public function getDeprecationDescription()
  {
    return $this->deprecationDescription;
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
  public function setDisableReplacementWords($disableReplacementWords)
  {
    $this->disableReplacementWords = $disableReplacementWords;
  }
  /**
   * @return string
   */
  public function getDisableReplacementWords()
  {
    return $this->disableReplacementWords;
  }
  /**
   * @param string
   */
  public function setSelector($selector)
  {
    $this->selector = $selector;
  }
  /**
   * @return string
   */
  public function getSelector()
  {
    return $this->selector;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(DocumentationRule::class, 'Google_Service_ServiceNetworking_DocumentationRule');
