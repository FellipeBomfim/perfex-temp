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

class GoogleCloudDocumentaiUiv1beta3ExportDocumentsMetadata extends \Google\Collection
{
  protected $collection_key = 'splitExportStats';
  protected $commonMetadataType = GoogleCloudDocumentaiUiv1beta3CommonOperationMetadata::class;
  protected $commonMetadataDataType = '';
  protected $individualExportStatusesType = GoogleCloudDocumentaiUiv1beta3ExportDocumentsMetadataIndividualExportStatus::class;
  protected $individualExportStatusesDataType = 'array';
  protected $splitExportStatsType = GoogleCloudDocumentaiUiv1beta3ExportDocumentsMetadataSplitExportStat::class;
  protected $splitExportStatsDataType = 'array';

  /**
   * @param GoogleCloudDocumentaiUiv1beta3CommonOperationMetadata
   */
  public function setCommonMetadata(GoogleCloudDocumentaiUiv1beta3CommonOperationMetadata $commonMetadata)
  {
    $this->commonMetadata = $commonMetadata;
  }
  /**
   * @return GoogleCloudDocumentaiUiv1beta3CommonOperationMetadata
   */
  public function getCommonMetadata()
  {
    return $this->commonMetadata;
  }
  /**
   * @param GoogleCloudDocumentaiUiv1beta3ExportDocumentsMetadataIndividualExportStatus[]
   */
  public function setIndividualExportStatuses($individualExportStatuses)
  {
    $this->individualExportStatuses = $individualExportStatuses;
  }
  /**
   * @return GoogleCloudDocumentaiUiv1beta3ExportDocumentsMetadataIndividualExportStatus[]
   */
  public function getIndividualExportStatuses()
  {
    return $this->individualExportStatuses;
  }
  /**
   * @param GoogleCloudDocumentaiUiv1beta3ExportDocumentsMetadataSplitExportStat[]
   */
  public function setSplitExportStats($splitExportStats)
  {
    $this->splitExportStats = $splitExportStats;
  }
  /**
   * @return GoogleCloudDocumentaiUiv1beta3ExportDocumentsMetadataSplitExportStat[]
   */
  public function getSplitExportStats()
  {
    return $this->splitExportStats;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudDocumentaiUiv1beta3ExportDocumentsMetadata::class, 'Google_Service_Document_GoogleCloudDocumentaiUiv1beta3ExportDocumentsMetadata');
