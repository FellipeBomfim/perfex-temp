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

namespace Google\Service\ContainerAnalysis;

class ContaineranalysisGoogleDevtoolsCloudbuildV1ArtifactsNpmPackage extends \Google\Model
{
  /**
   * @var string
   */
  public $packagePath;
  /**
   * @var string
   */
  public $repository;

  /**
   * @param string
   */
  public function setPackagePath($packagePath)
  {
    $this->packagePath = $packagePath;
  }
  /**
   * @return string
   */
  public function getPackagePath()
  {
    return $this->packagePath;
  }
  /**
   * @param string
   */
  public function setRepository($repository)
  {
    $this->repository = $repository;
  }
  /**
   * @return string
   */
  public function getRepository()
  {
    return $this->repository;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(ContaineranalysisGoogleDevtoolsCloudbuildV1ArtifactsNpmPackage::class, 'Google_Service_ContainerAnalysis_ContaineranalysisGoogleDevtoolsCloudbuildV1ArtifactsNpmPackage');
