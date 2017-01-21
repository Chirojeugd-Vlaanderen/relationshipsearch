# relationshipsearch

This CiviCRM extension provides an API method that allows you to search for relationships that were active on a given 
date. I hope that this will be a temporary extension, and that this functionality will one day part of CiviCRM core.

## dependencies

If you want to use this extension, you need to install
[queryapitools](https://www.civicrm.org/extensions/queryapitools) as well.

## Compatibility warning!

In CiviCRM 4.7.13 or CiviCRM 4.7.14, something changed in the CiviCRM API,
which broke version 0.1-alpha1 of the queryapitools extensions.
This version of relationshipsearch works with queryapitools 1.0-alpha1,
and it shoud therefore work with CiviCRM 4.7.15 and (hopefully) later.

## example

    $result = civicrm_api3('ActiveRelationship', 'get', array(
      'active_on' => '2016-10-15',
      'relationship_type_id' => 13,
      'options' => array('limit' => 0),
    ));
    
This will return all relationships of type 13, that were active on the given date. 
