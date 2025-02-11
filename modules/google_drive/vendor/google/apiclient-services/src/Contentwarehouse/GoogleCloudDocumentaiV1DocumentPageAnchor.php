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

namespace Google\Service\Contentwarehouse;

class GoogleCloudDocumentaiV1DocumentPageAnchor extends \Google\Collection
{
  protected $collection_key = 'pageRefs';
  protected $pageRefsType = GoogleCloudDocumentaiV1DocumentPageAnchorPageRef::class;
  protected $pageRefsDataType = 'array';

  /**
   * @param GoogleCloudDocumentaiV1DocumentPageAnchorPageRef[]
   */
  public function setPageRefs($pageRefs)
  {
    $this->pageRefs = $pageRefs;
  }
  /**
   * @return GoogleCloudDocumentaiV1DocumentPageAnchorPageRef[]
   */
  public function getPageRefs()
  {
    return $this->pageRefs;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudDocumentaiV1DocumentPageAnchor::class, 'Google_Service_Contentwarehouse_GoogleCloudDocumentaiV1DocumentPageAnchor');
