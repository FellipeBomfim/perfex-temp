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

namespace Google\Service\Dfareporting\Resource;

use Google\Service\Dfareporting\EventTag;
use Google\Service\Dfareporting\EventTagsListResponse;

/**
 * The "eventTags" collection of methods.
 * Typical usage is:
 *  <code>
 *   $dfareportingService = new Google\Service\Dfareporting(...);
 *   $eventTags = $dfareportingService->eventTags;
 *  </code>
 */
class EventTags extends \Google\Service\Resource
{
  /**
   * Deletes an existing event tag. (eventTags.delete)
   *
   * @param string $profileId User profile ID associated with this request.
   * @param string $id Event tag ID.
   * @param array $optParams Optional parameters.
   * @throws \Google\Service\Exception
   */
  public function delete($profileId, $id, $optParams = [])
  {
    $params = ['profileId' => $profileId, 'id' => $id];
    $params = array_merge($params, $optParams);
    return $this->call('delete', [$params]);
  }
  /**
   * Gets one event tag by ID. (eventTags.get)
   *
   * @param string $profileId User profile ID associated with this request.
   * @param string $id Event tag ID.
   * @param array $optParams Optional parameters.
   * @return EventTag
   * @throws \Google\Service\Exception
   */
  public function get($profileId, $id, $optParams = [])
  {
    $params = ['profileId' => $profileId, 'id' => $id];
    $params = array_merge($params, $optParams);
    return $this->call('get', [$params], EventTag::class);
  }
  /**
   * Inserts a new event tag. (eventTags.insert)
   *
   * @param string $profileId User profile ID associated with this request.
   * @param EventTag $postBody
   * @param array $optParams Optional parameters.
   * @return EventTag
   * @throws \Google\Service\Exception
   */
  public function insert($profileId, EventTag $postBody, $optParams = [])
  {
    $params = ['profileId' => $profileId, 'postBody' => $postBody];
    $params = array_merge($params, $optParams);
    return $this->call('insert', [$params], EventTag::class);
  }
  /**
   * Retrieves a list of event tags, possibly filtered. (eventTags.listEventTags)
   *
   * @param string $profileId User profile ID associated with this request.
   * @param array $optParams Optional parameters.
   *
   * @opt_param string adId Select only event tags that belong to this ad.
   * @opt_param string advertiserId Select only event tags that belong to this
   * advertiser.
   * @opt_param string campaignId Select only event tags that belong to this
   * campaign.
   * @opt_param bool definitionsOnly Examine only the specified campaign or
   * advertiser's event tags for matching selector criteria. When set to false,
   * the parent advertiser and parent campaign of the specified ad or campaign is
   * examined as well. In addition, when set to false, the status field is
   * examined as well, along with the enabledByDefault field. This parameter can
   * not be set to true when adId is specified as ads do not define their own even
   * tags.
   * @opt_param bool enabled Select only enabled event tags. What is considered
   * enabled or disabled depends on the definitionsOnly parameter. When
   * definitionsOnly is set to true, only the specified advertiser or campaign's
   * event tags' enabledByDefault field is examined. When definitionsOnly is set
   * to false, the specified ad or specified campaign's parent advertiser's or
   * parent campaign's event tags' enabledByDefault and status fields are examined
   * as well.
   * @opt_param string eventTagTypes Select only event tags with the specified
   * event tag types. Event tag types can be used to specify whether to use a
   * third-party pixel, a third-party JavaScript URL, or a third-party click-
   * through URL for either impression or click tracking.
   * @opt_param string ids Select only event tags with these IDs.
   * @opt_param string searchString Allows searching for objects by name or ID.
   * Wildcards (*) are allowed. For example, "eventtag*2015" will return objects
   * with names like "eventtag June 2015", "eventtag April 2015", or simply
   * "eventtag 2015". Most of the searches also add wildcards implicitly at the
   * start and the end of the search string. For example, a search string of
   * "eventtag" will match objects with name "my eventtag", "eventtag 2015", or
   * simply "eventtag".
   * @opt_param string sortField Field by which to sort the list.
   * @opt_param string sortOrder Order of sorted results.
   * @return EventTagsListResponse
   * @throws \Google\Service\Exception
   */
  public function listEventTags($profileId, $optParams = [])
  {
    $params = ['profileId' => $profileId];
    $params = array_merge($params, $optParams);
    return $this->call('list', [$params], EventTagsListResponse::class);
  }
  /**
   * Updates an existing event tag. This method supports patch semantics.
   * (eventTags.patch)
   *
   * @param string $profileId User profile ID associated with this request.
   * @param string $id Required. EventTag ID.
   * @param EventTag $postBody
   * @param array $optParams Optional parameters.
   * @return EventTag
   * @throws \Google\Service\Exception
   */
  public function patch($profileId, $id, EventTag $postBody, $optParams = [])
  {
    $params = ['profileId' => $profileId, 'id' => $id, 'postBody' => $postBody];
    $params = array_merge($params, $optParams);
    return $this->call('patch', [$params], EventTag::class);
  }
  /**
   * Updates an existing event tag. (eventTags.update)
   *
   * @param string $profileId User profile ID associated with this request.
   * @param EventTag $postBody
   * @param array $optParams Optional parameters.
   * @return EventTag
   * @throws \Google\Service\Exception
   */
  public function update($profileId, EventTag $postBody, $optParams = [])
  {
    $params = ['profileId' => $profileId, 'postBody' => $postBody];
    $params = array_merge($params, $optParams);
    return $this->call('update', [$params], EventTag::class);
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(EventTags::class, 'Google_Service_Dfareporting_Resource_EventTags');
