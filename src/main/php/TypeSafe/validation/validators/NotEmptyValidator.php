<?php
/*
 * Copyright 2010,2011 Tobias Sarnowski
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

require_once('TypeSafe/validation/Validator.php');
require_once('TypeSafe/validation/ValidationException.php');


/**
 *
 * @author Tobias Sarnowski
 */ 
class NotEmptyValidator implements Validator {

    public function validate($value, $parameters) {
        if (empty($value)) {
            throw new ValidationException($value, $parameters, "Value must not be empty");
        }
    }
}
