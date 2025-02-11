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

namespace Google\Service;

use Google\Client;

/**
 * Service definition for MyBusinessBusinessCalls (v1).
 *
 * <p>
 * The My Business Business Calls API manages business calls information of a
 * location on Google and collect insights like the number of missed calls to
 * their location. Additional information about Business calls can be found at
 * https://support.google.com/business/answer/9688285?p=call_history. If the
 * Google Business Profile links to a Google Ads account and call history is
 * turned on, calls that last longer than a specific time, and that can be
 * attributed to an ad interaction, will show in the linked Google Ads account
 * under the "Calls from Ads" conversion. If smart bidding and call conversions
 * are used in the optimization strategy, there could be a change in ad spend.
 * Learn more about smart bidding. To view and perform actions on a location's
 * calls, you need to be a `OWNER`, `CO_OWNER` or `MANAGER` of the location.
 * Note - If you have a quota of 0 after enabling the API, please request for
 * GBP API access.</p>
 *
 * <p>
 * For more information about this service, see the API
 * <a href="https://developers.google.com/my-business/" target="_blank">Documentation</a>
 * </p>
 *
 * @author Google, Inc.
 */
class MyBusinessBusinessCalls extends \Google\Service
{


  public $locations;
  public $locations_businesscallsinsights;

  /**
   * Constructs the internal representation of the MyBusinessBusinessCalls
   * service.
   *
   * @param Client|array $clientOrConfig The client used to deliver requests, or a
   *                                     config array to pass to a new Client instance.
   * @param string $rootUrl The root URL used for requests to the service.
   */
  public function __construct($clientOrConfig = [], $rootUrl = null)
  {
    parent::__construct($clientOrConfig);
    $this->rootUrl = $rootUrl ?: 'https://mybusinessbusinesscalls.googleapis.com/';
    $this->servicePath = '';
    $this->batchPath = 'batch';
    $this->version = 'v1';
    $this->serviceName = 'mybusinessbusinesscalls';

    $this->locations = new MyBusinessBusinessCalls\Resource\Locations(
        $this,
        $this->serviceName,
        'locations',
        [
          'methods' => [
            'getBusinesscallssettings' => [
              'path' => 'v1/{+name}',
              'httpMethod' => 'GET',
              'parameters' => [
                'name' => [
                  'location' => 'path',
                  'type' => 'string',
                  'required' => true,
                ],
              ],
            ],'updateBusinesscallssettings' => [
              'path' => 'v1/{+name}',
              'httpMethod' => 'PATCH',
              'parameters' => [
                'name' => [
                  'location' => 'path',
                  'type' => 'string',
                  'required' => true,
                ],
                'updateMask' => [
                  'location' => 'query',
                  'type' => 'string',
                ],
              ],
            ],
          ]
        ]
    );
    $this->locations_businesscallsinsights = new MyBusinessBusinessCalls\Resource\LocationsBusinesscallsinsights(
        $this,
        $this->serviceName,
        'businesscallsinsights',
        [
          'methods' => [
            'list' => [
              'path' => 'v1/{+parent}/businesscallsinsights',
              'httpMethod' => 'GET',
              'parameters' => [
                'parent' => [
                  'location' => 'path',
                  'type' => 'string',
                  'required' => true,
                ],
                'filter' => [
                  'location' => 'query',
                  'type' => 'string',
                ],
                'pageSize' => [
                  'location' => 'query',
                  'type' => 'integer',
                ],
                'pageToken' => [
                  'location' => 'query',
                  'type' => 'string',
                ],
              ],
            ],
          ]
        ]
    );
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(MyBusinessBusinessCalls::class, 'Google_Service_MyBusinessBusinessCalls');
