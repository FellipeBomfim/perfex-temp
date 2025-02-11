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

namespace Google\Service\Firestore;

class GoogleFirestoreAdminV1RestoreDatabaseRequest extends \Google\Model
{
  /**
   * @var string
   */
  public $backup;
  /**
   * @var string
   */
  public $databaseId;
  /**
   * @var string
   */
  public $kmsKeyName;
  protected $useBackupEncryptionType = FirestoreEmpty::class;
  protected $useBackupEncryptionDataType = '';
  protected $useGoogleDefaultEncryptionType = FirestoreEmpty::class;
  protected $useGoogleDefaultEncryptionDataType = '';

  /**
   * @param string
   */
  public function setBackup($backup)
  {
    $this->backup = $backup;
  }
  /**
   * @return string
   */
  public function getBackup()
  {
    return $this->backup;
  }
  /**
   * @param string
   */
  public function setDatabaseId($databaseId)
  {
    $this->databaseId = $databaseId;
  }
  /**
   * @return string
   */
  public function getDatabaseId()
  {
    return $this->databaseId;
  }
  /**
   * @param string
   */
  public function setKmsKeyName($kmsKeyName)
  {
    $this->kmsKeyName = $kmsKeyName;
  }
  /**
   * @return string
   */
  public function getKmsKeyName()
  {
    return $this->kmsKeyName;
  }
  /**
   * @param FirestoreEmpty
   */
  public function setUseBackupEncryption(FirestoreEmpty $useBackupEncryption)
  {
    $this->useBackupEncryption = $useBackupEncryption;
  }
  /**
   * @return FirestoreEmpty
   */
  public function getUseBackupEncryption()
  {
    return $this->useBackupEncryption;
  }
  /**
   * @param FirestoreEmpty
   */
  public function setUseGoogleDefaultEncryption(FirestoreEmpty $useGoogleDefaultEncryption)
  {
    $this->useGoogleDefaultEncryption = $useGoogleDefaultEncryption;
  }
  /**
   * @return FirestoreEmpty
   */
  public function getUseGoogleDefaultEncryption()
  {
    return $this->useGoogleDefaultEncryption;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleFirestoreAdminV1RestoreDatabaseRequest::class, 'Google_Service_Firestore_GoogleFirestoreAdminV1RestoreDatabaseRequest');
