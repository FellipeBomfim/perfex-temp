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

namespace Google\Service\Networkconnectivity\Resource;

use Google\Service\Networkconnectivity\ListRouteTablesResponse;
use Google\Service\Networkconnectivity\RouteTable;

/**
 * The "routeTables" collection of methods.
 * Typical usage is:
 *  <code>
 *   $networkconnectivityService = new Google\Service\Networkconnectivity(...);
 *   $routeTables = $networkconnectivityService->projects_locations_global_hubs_routeTables;
 *  </code>
 */
class ProjectsLocationsNetworkconnectivityGlobalHubsRouteTables extends \Google\Service\Resource
{
  /**
   * Gets details about a Network Connectivity Center route table.
   * (routeTables.get)
   *
   * @param string $name Required. The name of the route table resource.
   * @param array $optParams Optional parameters.
   * @return RouteTable
   * @throws \Google\Service\Exception
   */
  public function get($name, $optParams = [])
  {
    $params = ['name' => $name];
    $params = array_merge($params, $optParams);
    return $this->call('get', [$params], RouteTable::class);
  }
  /**
   * Lists route tables in a given hub.
   * (routeTables.listProjectsLocationsNetworkconnectivityGlobalHubsRouteTables)
   *
   * @param string $parent Required. The parent resource's name.
   * @param array $optParams Optional parameters.
   *
   * @opt_param string filter An expression that filters the list of results.
   * @opt_param string orderBy Sort the results by a certain order.
   * @opt_param int pageSize The maximum number of results to return per page.
   * @opt_param string pageToken The page token.
   * @return ListRouteTablesResponse
   * @throws \Google\Service\Exception
   */
  public function listProjectsLocationsNetworkconnectivityGlobalHubsRouteTables($parent, $optParams = [])
  {
    $params = ['parent' => $parent];
    $params = array_merge($params, $optParams);
    return $this->call('list', [$params], ListRouteTablesResponse::class);
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(ProjectsLocationsNetworkconnectivityGlobalHubsRouteTables::class, 'Google_Service_Networkconnectivity_Resource_ProjectsLocationsNetworkconnectivityGlobalHubsRouteTables');
