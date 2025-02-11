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

namespace Google\Service\AndroidEnterprise\Resource;

use Google\Service\AndroidEnterprise\ManagedConfigurationsSettingsListResponse;

/**
 * The "managedconfigurationssettings" collection of methods.
 * Typical usage is:
 *  <code>
 *   $androidenterpriseService = new Google\Service\AndroidEnterprise(...);
 *   $managedconfigurationssettings = $androidenterpriseService->managedconfigurationssettings;
 *  </code>
 */
class Managedconfigurationssettings extends \Google\Service\Resource
{
  /**
   * Lists all the managed configurations settings for the specified app.
   * (managedconfigurationssettings.listManagedconfigurationssettings)
   *
   * @param string $enterpriseId The ID of the enterprise.
   * @param string $productId The ID of the product for which the managed
   * configurations settings applies to.
   * @param array $optParams Optional parameters.
   * @return ManagedConfigurationsSettingsListResponse
   * @throws \Google\Service\Exception
   */
  public function listManagedconfigurationssettings($enterpriseId, $productId, $optParams = [])
  {
    $params = ['enterpriseId' => $enterpriseId, 'productId' => $productId];
    $params = array_merge($params, $optParams);
    return $this->call('list', [$params], ManagedConfigurationsSettingsListResponse::class);
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Managedconfigurationssettings::class, 'Google_Service_AndroidEnterprise_Resource_Managedconfigurationssettings');
