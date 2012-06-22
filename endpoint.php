<?php
  $app_id = '415316545179174'; // Your app Id
  $app_secret = "ac58e50d8d10b458388e63eec36939ae"; // Your app secret

  // Function to parse an incoming signed request and get the
  // data
  function parse_signed_request($signed_request, $secret) {
    list($encoded_sig, $payload) = explode('.', $signed_request, 2);

    $sig = base64_url_decode($encoded_sig);
    $data = json_decode(base64_url_decode($payload), true);

    if (strtoupper($data['algorithm']) !== 'HMAC-SHA256') {
      error_log('Unknown algorithm. Expected HMAC-SHA256');
      return null;
    }

    // Check the signature
    $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
    if ($sig !== $expected_sig) {
      error_log('Bad Signed JSON signature!');
      return null;
    }
    return $data;
  }

  // Helper function for parsing signed request
  function base64_url_decode($input) {
    return base64_decode(strtr($input, '-_', '+/'));
  }

  // Variable to hold success result
  $success_result = 'false';

  // Parse the signed request
  $parsed_data = parse_signed_request($_REQUEST['signed_request'],$app_secret);
  if ($parsed_data != null) {
    // Get the access token
    $access_token = $parsed_data['oauth_token'];
    // Get the object URL
    $product = $parsed_data['objects'][0]['url'];

    // The Graph API endpoint for publishing a save action
    $graph_url_publish = 
      "https://graph.facebook.com/me/meetuniversities:view?access_token=" . $access_token;
    $postdata = http_build_query(
      array(
        'website' => $product
      )
    );
    $opts = array('http' =>
      array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => $postdata
      )
    );
    $context  = stream_context_create($opts);
    // Publish the save action
    $result = json_decode(file_get_contents($graph_url_publish, false, $context));
    if (($result != null) && isset($result->id)) {
      // Set the result flag to true
      $success_result = 'true';
    }
  }

  // Print the output
  $success = array(
    'success' => $success_result
  );
  $output = json_encode($success);
  echo $output;
?>