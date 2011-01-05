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



/**
 *
 * @author Tobias Sarnowski
 */
interface ValidationService {

    /**
     * Validates a given value with the specified Validator.
     *
     * @abstract
     * @param  mixed $value
     * @param  string $validatorName
     * @param  array $parameters
     * @return void
     * @throws ValidationException if the value is not valid
     */
    public function validate($value, $validatorName, $parameters);

}
