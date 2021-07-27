<?php

$metadata['https://idp.zengo.saml/saml2/idp/metadata.php'] = array(
  'metadata-set' => 'saml20-idp-remote',
  'entityid' => 'https://idp.zengo.saml/saml2/idp/metadata.php',
  'SingleSignOnService' =>
  array(
    0 =>
    array(
      'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
      'Location' => 'https://idp.zengo.saml/saml2/idp/SSOService.php',
    ),
  ),
  'SingleLogoutService' =>
  array(
    0 =>
    array(
      'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
      'Location' => 'https://idp.zengo.saml/saml2/idp/SingleLogoutService.php',
    ),
  ),
  'certificate' => 'idp.zengo.saml.crt',
  'NameIDFormat' => 'urn:oasis:names:tc:SAML:2.0:nameid-format:transient',
);
