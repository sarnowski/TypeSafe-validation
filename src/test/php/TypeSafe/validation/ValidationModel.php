<?php
/*
 * Copyright 2010 Tobias Sarnowski
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
class ValidationModel {

    /**
     * @param  $number
     * @return void
     * @validate IsNumeric
     */
    public function validateIsNumeric($number) {}

    /**
     * @param  string $text
     * @return void
     * @validate IsText
     */
    public function validateIsText($text) {}

    /**
     * @param  $text
     * @return void
     * @validate Match pattern=/^(s*)$/
     */
    public function validateMatch($text) {}

    /**
     * @param  $number
     * @return void
     * @validate MaxNumber number=2
     */
    public function validateMaxNumber($number) {}

    /**
     * @param  $text
     * @return void
     * @validate MaxText length=2
     */
    public function validateMaxText($text) {}

    /**
     * @param  $number
     * @return void
     * @validate MinNumber number=2
     */
    public function validateMinNumber($number) {}

    /**
     * @param  $text
     * @return void
     * @validate MinText length=2
     */
    public function validateMinText($text) {}

    /**
     * @param  $value
     * @return void
     * @validate NotEmpty
     */
    public function validateNotEmpty($value) {}

    /**
     * @param  $value
     * @return void
     * @validate NotNull
     */
    public function validateNotNull($value) {}


    /**
     * @param  $value1
     * @param  $value2
     * @return void
     * @validate NotEmpty
     * @validate $value1 MinNumber number=1
     * @validate $value1 MaxNumber number=3
     * @validate $value2 Match pattern=/(.*)test(.*)/
     */
    public function validateMultipleValues($value1, $value2) {}

}
