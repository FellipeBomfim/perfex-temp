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

namespace Google\Service\AndroidManagement\Resource;

use Google\Service\AndroidManagement\WebToken;

/**
 * The "webTokens" collection of methods.
 * Typical usage is:
 *  <code>
 *   $androidmanagementService = new Google\Service\AndroidManagement(...);
 *   $webTokens = $androidmanagementService->enterprises_webTokens;
 *  </code>
 */
class EnterprisesWebTokens extends \Google\Service\Resource
{
  /**
   * Creates a web token to access an embeddable managed Google Play web UI for a
   * given enterprise. (webTokens.create)
   *
   * @param string $parent The name of the enterprise in the form
   * enterprises/{enterpriseId}.
   * @param WebToken $postBody
   * @param array $optParams Optional parameters.
   * @return WebToken
   * @throws \Google\Service\Exception
   */
  public function create($parent, WebToken $postBody, $optParams = [])
  {
    $params = ['parent' => $parent, 'postBody' => $postBody];
    $params = array_merge($params, $optParams);
    return $this->call('create', [$params], WebToken::class);
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(EnterprisesWebTokens::class, 'Google_Service_AndroidManagement_Resource_EnterprisesWebTokens');
