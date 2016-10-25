<?php
/*
  be.chiro.civi.relationshipsearch - contribution batch tools.
  Copyright (C) 2016  Chirojeugd-Vlaanderen vzw

  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU Affero General Public License as
  published by the Free Software Foundation, either version 3 of the
  License, or (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU Affero General Public License for more details.

  You should have received a copy of the GNU Affero General Public License
  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Relationship.Get API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see http://wiki.civicrm.org/confluence/display/CRMDOC/API+Architecture+Standards
 */
function _civicrm_api3_active_relationship_Get_spec(&$spec) {
  $spec['active_on'] = array(
    'name' => 'active_on',
    'title' => 'Date for which to search active relationships',
    'type' => CRM_Utils_Type::T_DATE,
    'api.required' => 1,
  );
}

/**
 * ActiveRelationship.Get API
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_active_relationship_Get($params) {
  // WARNING! HACK ALERT!
  // I suppose $params['active_on'] was validated based on the _spec function.
  $sql = "SELECT '" . $params['active_on'] . "' AS active_on, r.*
      FROM civicrm_relationship r
      WHERE (r.start_date IS NULL OR r.start_date <= " . $params['active_on'] . ")
       AND (r.end_date IS NULL OR r.end_date >= " . $params['active_on'] . ")
  ";

  // hmmm. This is the same as in the function above. That should be fixed.
  $extraFields = array(
    'active_on' => array(
      'name' => 'active_on',
      'type' => CRM_Utils_Type::T_DATE,
      'title' => 'Date for which to search active relationships',
    ),
  );

  $result = CRM_Queryapitools_Tools::BasicGet(
    $sql,
    $params,
    'CRM_Contact_BAO_Relationship',
    $extraFields);

  return $result;
}

