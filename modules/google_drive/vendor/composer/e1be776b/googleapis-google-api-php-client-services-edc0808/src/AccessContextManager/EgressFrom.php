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

namespace Google\Service\AccessContextManager;

class EgressFrom extends \Google\Collection
{
  protected $collection_key = 'sources';
  /**
   * @var string[]
   */
  public $identities;
  /**
   * @var string
   */
  public $identityType;
  /**
   * @var string
   */
  public $sourceRestriction;
  protected $sourcesType = EgressSource::class;
  protected $sourcesDataType = 'array';

  /**
   * @param string[]
   */
  public function setIdentities($identities)
  {
    $this->identities = $identities;
  }
  /**
   * @return string[]
   */
  public function getIdentities()
  {
    return $this->identities;
  }
  /**
   * @param string
   */
  public function setIdentityType($identityType)
  {
    $this->identityType = $identityType;
  }
  /**
   * @return string
   */
  public function getIdentityType()
  {
    return $this->identityType;
  }
  /**
   * @param string
   */
  public function setSourceRestriction($sourceRestriction)
  {
    $this->sourceRestriction = $sourceRestriction;
  }
  /**
   * @return string
   */
  public function getSourceRestriction()
  {
    return $this->sourceRestriction;
  }
  /**
   * @param EgressSource[]
   */
  public function setSources($sources)
  {
    $this->sources = $sources;
  }
  /**
   * @return EgressSource[]
   */
  public function getSources()
  {
    return $this->sources;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(EgressFrom::class, 'Google_Service_AccessContextManager_EgressFrom');
