<?php

$metadata['https://sp.zengo.saml/module.php/saml/sp/metadata.php/Demo-IDP'] = array(
  'SingleLogoutService' =>
  array(
    0 =>
    array(
      'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
      'Location' => 'https://sp.zengo.saml/module.php/saml/sp/saml2-logout.php/Demo-IDP',
    ),
  ),
  'AssertionConsumerService' =>
  array(
    0 =>
    array(
      'index' => 0,
      'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST',
      'Location' => 'https://sp.zengo.saml/module.php/saml/sp/saml2-acs.php/Demo-IDP',
    ),
    1 =>
    array(
      'index' => 1,
      'Binding' => 'urn:oasis:names:tc:SAML:1.0:profiles:browser-post',
      'Location' => 'https://sp.zengo.saml/module.php/saml/sp/saml1-acs.php/Demo-IDP',
    ),
    2 =>
    array(
      'index' => 2,
      'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Artifact',
      'Location' => 'https://sp.zengo.saml/module.php/saml/sp/saml2-acs.php/Demo-IDP',
    ),
    3 =>
    array(
      'index' => 3,
      'Binding' => 'urn:oasis:names:tc:SAML:1.0:profiles:artifact-01',
      'Location' => 'https://sp.zengo.saml/module.php/saml/sp/saml1-acs.php/Demo-IDP/artifact',
    ),
  ),
);
