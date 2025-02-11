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

namespace Google\Service\Dns\Resource;

use Google\Service\Dns\DnsKey;
use Google\Service\Dns\DnsKeysListResponse;

/**
 * The "dnsKeys" collection of methods.
 * Typical usage is:
 *  <code>
 *   $dnsService = new Google\Service\Dns(...);
 *   $dnsKeys = $dnsService->dnsKeys;
 *  </code>
 */
class DnsKeys extends \Google\Service\Resource
{
  /**
   * Fetches the representation of an existing DnsKey. (dnsKeys.get)
   *
   * @param string $project Identifies the project addressed by this request.
   * @param string $managedZone Identifies the managed zone addressed by this
   * request. Can be the managed zone name or ID.
   * @param string $dnsKeyId The identifier of the requested DnsKey.
   * @param array $optParams Optional parameters.
   *
   * @opt_param string clientOperationId For mutating operation requests only. An
   * optional identifier specified by the client. Must be unique for operation
   * resources in the Operations collection.
   * @opt_param string digestType An optional comma-separated list of digest types
   * to compute and display for key signing keys. If omitted, the recommended
   * digest type is computed and displayed.
   * @return DnsKey
   * @throws \Google\Service\Exception
   */
  public function get($project, $managedZone, $dnsKeyId, $optParams = [])
  {
    $params = ['project' => $project, 'managedZone' => $managedZone, 'dnsKeyId' => $dnsKeyId];
    $params = array_merge($params, $optParams);
    return $this->call('get', [$params], DnsKey::class);
  }
  /**
   * Enumerates DnsKeys to a ResourceRecordSet collection. (dnsKeys.listDnsKeys)
   *
   * @param string $project Identifies the project addressed by this request.
   * @param string $managedZone Identifies the managed zone addressed by this
   * request. Can be the managed zone name or ID.
   * @param array $optParams Optional parameters.
   *
   * @opt_param string digestType An optional comma-separated list of digest types
   * to compute and display for key signing keys. If omitted, the recommended
   * digest type is computed and displayed.
   * @opt_param int maxResults Optional. Maximum number of results to be returned.
   * If unspecified, the server decides how many results to return.
   * @opt_param string pageToken Optional. A tag returned by a previous list
   * request that was truncated. Use this parameter to continue a previous list
   * request.
   * @return DnsKeysListResponse
   * @throws \Google\Service\Exception
   */
  public function listDnsKeys($project, $managedZone, $optParams = [])
  {
    $params = ['project' => $project, 'managedZone' => $managedZone];
    $params = array_merge($params, $optParams);
    return $this->call('list', [$params], DnsKeysListResponse::class);
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(DnsKeys::class, 'Google_Service_Dns_Resource_DnsKeys');
