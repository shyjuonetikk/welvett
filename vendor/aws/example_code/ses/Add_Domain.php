<?php
/**
 * Copyright 2010-2019 Amazon.com, Inc. or its affiliates. All Rights Reserved.
 *
 * This file is licensed under the Apache License, Version 2.0 (the "License").
 * You may not use this file except in compliance with the License. A copy of
 * the License is located at
 *
 * http://aws.amazon.com/apache2.0/
 *
 * This file is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR
 * CONDITIONS OF ANY KIND, either express or implied. See the License for the
 * specific language governing permissions and limitations under the License.
 *
 * ABOUT THIS PHP SAMPLE => This sample is part of the SDK for PHP Developer Guide topic at
 * https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/ses-verify.html
 *
 */
// snippet-start:[ses.php.add_domain.complete]
// snippet-start:[ses.php.add_domain.import]

require 'vendor/autoload.php';

use Aws\SES\SESClient; 
use Aws\Exception\AwsException;
// snippet-end:[ses.php.add_domain.import]

//Create a SESClient 
// snippet-start:[ses.php.add_domain.main]
$SesClient = new Aws\SES\SESClient([
    'profile' => 'default',
    'version' => '2010-12-01',
    'region' => 'us-east-2'
]);

$domain = 'domain.name';

try {
    $result = $SesClient->verifyDomainIdentity([
        'Domain' => $domain,
    ]);
    var_dump($result);
} catch (AwsException $e) {
    // output error message if fails
    echo $e->getMessage();
    echo "\n";
}
 
 
// snippet-end:[ses.php.add_domain.main]
// snippet-end:[ses.php.add_domain.complete]
// snippet-comment:[These are tags for the AWS doc team's sample catalog. Do not remove.]
// snippet-sourcedescription:[Add_Domain.php demonstrates how to add a sending domain to your Amazon SES account. By verifying a domain, you demonstrate that you're the owner of that domain. When you verify a domain, you allow Amazon SES to send email from any address on that domain.]
// snippet-keyword:[PHP]
// snippet-keyword:[AWS SDK for PHP v3]
// snippet-keyword:[Code Sample]
// snippet-keyword:[Amazon Simple Email Service]
// snippet-service:[ses]
// snippet-sourcetype:[full-example]
// snippet-sourcedate:[2018-09-20]
// snippet-sourceauthor:[jschwarzwalder (AWS)]

