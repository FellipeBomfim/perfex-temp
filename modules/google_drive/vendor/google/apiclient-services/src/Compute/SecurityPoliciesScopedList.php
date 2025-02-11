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

namespace Google\Service\Compute;

class SecurityPoliciesScopedList extends \Google\Collection
{
  protected $collection_key = 'securityPolicies';
  protected $securityPoliciesType = SecurityPolicy::class;
  protected $securityPoliciesDataType = 'array';
  protected $warningType = SecurityPoliciesScopedListWarning::class;
  protected $warningDataType = '';

  /**
   * @param SecurityPolicy[]
   */
  public function setSecurityPolicies($securityPolicies)
  {
    $this->securityPolicies = $securityPolicies;
  }
  /**
   * @return SecurityPolicy[]
   */
  public function getSecurityPolicies()
  {
    return $this->securityPolicies;
  }
  /**
   * @param SecurityPoliciesScopedListWarning
   */
  public function setWarning(SecurityPoliciesScopedListWarning $warning)
  {
    $this->warning = $warning;
  }
  /**
   * @return SecurityPoliciesScopedListWarning
   */
  public function getWarning()
  {
    return $this->warning;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(SecurityPoliciesScopedList::class, 'Google_Service_Compute_SecurityPoliciesScopedList');
