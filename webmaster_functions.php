<?php
/*
 * Copyright 2016 David Boschwitz.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
$page['auth'] = 100;
require "include/functions.inc";


switch(filter_input(INPUT_POST, 'task', FILTER_SANITIZE_STRING)) {
    case "resetpass":
      if(false && !validate_password($pass, $_SESSION['pass'])) {
          die(json_encode(array('status' => 0, 'error' => "Invalid authentication")));
      }
      $newpass = substr(md5(rand()), 7, 8);

      echo json_encode(array('status' => 1, 'newpass' => $newpass));
      break;


}
