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

namespace Google\Service\DiscoveryEngine;

class GoogleCloudDiscoveryengineV1ConverseConversationResponse extends \Google\Collection
{
  protected $collection_key = 'searchResults';
  protected $conversationType = GoogleCloudDiscoveryengineV1Conversation::class;
  protected $conversationDataType = '';
  protected $replyType = GoogleCloudDiscoveryengineV1Reply::class;
  protected $replyDataType = '';
  protected $searchResultsType = GoogleCloudDiscoveryengineV1SearchResponseSearchResult::class;
  protected $searchResultsDataType = 'array';

  /**
   * @param GoogleCloudDiscoveryengineV1Conversation
   */
  public function setConversation(GoogleCloudDiscoveryengineV1Conversation $conversation)
  {
    $this->conversation = $conversation;
  }
  /**
   * @return GoogleCloudDiscoveryengineV1Conversation
   */
  public function getConversation()
  {
    return $this->conversation;
  }
  /**
   * @param GoogleCloudDiscoveryengineV1Reply
   */
  public function setReply(GoogleCloudDiscoveryengineV1Reply $reply)
  {
    $this->reply = $reply;
  }
  /**
   * @return GoogleCloudDiscoveryengineV1Reply
   */
  public function getReply()
  {
    return $this->reply;
  }
  /**
   * @param GoogleCloudDiscoveryengineV1SearchResponseSearchResult[]
   */
  public function setSearchResults($searchResults)
  {
    $this->searchResults = $searchResults;
  }
  /**
   * @return GoogleCloudDiscoveryengineV1SearchResponseSearchResult[]
   */
  public function getSearchResults()
  {
    return $this->searchResults;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudDiscoveryengineV1ConverseConversationResponse::class, 'Google_Service_DiscoveryEngine_GoogleCloudDiscoveryengineV1ConverseConversationResponse');
