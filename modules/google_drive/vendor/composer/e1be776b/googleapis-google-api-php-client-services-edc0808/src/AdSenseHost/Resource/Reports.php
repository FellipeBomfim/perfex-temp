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

namespace Google\Service\AdSenseHost\Resource;

use Google\Service\AdSenseHost\Report;

/**
 * The "reports" collection of methods.
 * Typical usage is:
 *  <code>
 *   $adsensehostService = new Google\Service\AdSenseHost(...);
 *   $reports = $adsensehostService->reports;
 *  </code>
 */
class Reports extends \Google\Service\Resource
{
  /**
   * Generate an AdSense report based on the report request sent in the query
   * parameters. Returns the result as JSON; to retrieve output in CSV format
   * specify "alt=csv" as a query parameter. (reports.generate)
   *
   * @param string $startDate Start of the date range to report on in "YYYY-MM-DD"
   * format, inclusive.
   * @param string $endDate End of the date range to report on in "YYYY-MM-DD"
   * format, inclusive.
   * @param array $optParams Optional parameters.
   *
   * @opt_param string dimension Dimensions to base the report on.
   * @opt_param string filter Filters to be run on the report.
   * @opt_param string locale Optional locale to use for translating report output
   * to a local language. Defaults to "en_US" if not specified.
   * @opt_param string maxResults The maximum number of rows of report data to
   * return.
   * @opt_param string metric Numeric columns to include in the report.
   * @opt_param string sort The name of a dimension or metric to sort the
   * resulting report on, optionally prefixed with "+" to sort ascending or "-" to
   * sort descending. If no prefix is specified, the column is sorted ascending.
   * @opt_param string startIndex Index of the first row of report data to return.
   * @return Report
   * @throws \Google\Service\Exception
   */
  public function generate($startDate, $endDate, $optParams = [])
  {
    $params = ['startDate' => $startDate, 'endDate' => $endDate];
    $params = array_merge($params, $optParams);
    return $this->call('generate', [$params], Report::class);
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Reports::class, 'Google_Service_AdSenseHost_Resource_Reports');
