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

namespace Google\Service\Document;

class GoogleCloudDocumentaiV1beta3EvaluateProcessorVersionMetadata extends \Google\Model
{
  protected $commonMetadataType = GoogleCloudDocumentaiV1beta3CommonOperationMetadata::class;
  protected $commonMetadataDataType = '';

  /**
   * @param GoogleCloudDocumentaiV1beta3CommonOperationMetadata
   */
  public function setCommonMetadata(GoogleCloudDocumentaiV1beta3CommonOperationMetadata $commonMetadata)
  {
    $this->commonMetadata = $commonMetadata;
  }
  /**
   * @return GoogleCloudDocumentaiV1beta3CommonOperationMetadata
   */
  public function getCommonMetadata()
  {
    return $this->commonMetadata;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudDocumentaiV1beta3EvaluateProcessorVersionMetadata::class, 'Google_Service_Document_GoogleCloudDocumentaiV1beta3EvaluateProcessorVersionMetadata');
