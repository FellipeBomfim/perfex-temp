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

namespace Google\Service\DataCatalog;

class GoogleCloudDatacatalogV1SearchCatalogRequest extends \Google\Model
{
  /**
   * @var bool
   */
  public $adminSearch;
  /**
   * @var string
   */
  public $orderBy;
  /**
   * @var int
   */
  public $pageSize;
  /**
   * @var string
   */
  public $pageToken;
  /**
   * @var string
   */
  public $query;
  protected $scopeType = GoogleCloudDatacatalogV1SearchCatalogRequestScope::class;
  protected $scopeDataType = '';

  /**
   * @param bool
   */
  public function setAdminSearch($adminSearch)
  {
    $this->adminSearch = $adminSearch;
  }
  /**
   * @return bool
   */
  public function getAdminSearch()
  {
    return $this->adminSearch;
  }
  /**
   * @param string
   */
  public function setOrderBy($orderBy)
  {
    $this->orderBy = $orderBy;
  }
  /**
   * @return string
   */
  public function getOrderBy()
  {
    return $this->orderBy;
  }
  /**
   * @param int
   */
  public function setPageSize($pageSize)
  {
    $this->pageSize = $pageSize;
  }
  /**
   * @return int
   */
  public function getPageSize()
  {
    return $this->pageSize;
  }
  /**
   * @param string
   */
  public function setPageToken($pageToken)
  {
    $this->pageToken = $pageToken;
  }
  /**
   * @return string
   */
  public function getPageToken()
  {
    return $this->pageToken;
  }
  /**
   * @param string
   */
  public function setQuery($query)
  {
    $this->query = $query;
  }
  /**
   * @return string
   */
  public function getQuery()
  {
    return $this->query;
  }
  /**
   * @param GoogleCloudDatacatalogV1SearchCatalogRequestScope
   */
  public function setScope(GoogleCloudDatacatalogV1SearchCatalogRequestScope $scope)
  {
    $this->scope = $scope;
  }
  /**
   * @return GoogleCloudDatacatalogV1SearchCatalogRequestScope
   */
  public function getScope()
  {
    return $this->scope;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudDatacatalogV1SearchCatalogRequest::class, 'Google_Service_DataCatalog_GoogleCloudDatacatalogV1SearchCatalogRequest');
