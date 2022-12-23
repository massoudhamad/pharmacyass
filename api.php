 <?php
                            $tokenEndpoint = "http://icdaccessmanagement.who.int/connect/token";
                            $clientId = "5bb7ca4d-700e-4944-8b55-8fd13bec86ec_2da17702-f879-42a9-b89f-4ac914494d1c"; //of course not a good idea to put id and secret in the source code
                            $clientSecret = "WFvZsRZpOyRtOlM/Fa/HKr89mhswhPb41XTf/v68JmI="; //you could read from an encyrpted source in the production
                            $scope = "icdapi_access";
                            $grant_type = "client_credentials";
                            // create curl resource to get the OAUTH2 token
                            $ch = curl_init();

                            // set URL to fetch
                            curl_setopt($ch, CURLOPT_URL, $tokenEndpoint);

                            // set HTTP POST
                            curl_setopt($ch, CURLOPT_POST, TRUE);

                            // set data to post
                            curl_setopt($ch, CURLOPT_POSTFIELDS, array(
                                        'client_id' => $clientId,
                                        'client_secret' => $clientSecret,
                                        'scope' => $scope,
                                        'grant_type' => $grant_type
                            ));

                            //return the transfer as a string
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

                            $result = curl_exec($ch);
                            $json_array = (json_decode($result, true));
                            $token = $json_array['access_token'];
                            var_dump($json_array);


                            // close curl resource
                            curl_close($ch);
                            // var_dump($json_array); 	



                            // create curl resource to access ICD API
                            $ch2 = curl_init();

                            // set URL to fetch
                            curl_setopt($ch2, CURLOPT_URL, 'http://id.who.int/icd/entity');

                            // HTTP header fields to set
                            curl_setopt($ch2, CURLOPT_HTTPHEADER, array(
                                        'Authorization: Bearer '.$token,
                                        'Accept: application/json',
                                        'Accept-Language: en',
                                        'API-Version: v2'
                            ));

                            // grab URL and pass it to the browser
                            //?token='.$token
                             $results = curl_exec($ch2);
                             var_dump($results);
                             $json_array = (json_decode($results, true));
                            var_dump($json_array);
                            

                            // close curl resource
                            curl_close($ch2); 
                           
                            ?>