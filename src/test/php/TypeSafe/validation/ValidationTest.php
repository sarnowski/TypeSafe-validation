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
require_once('PHPUnit/Framework.php');
require_once('pinjector/DefaultKernel.php');
require_once('pinjector/Module.php');
require_once('TypeSafe/validation/ValidationModule.php');
require_once('TypeSafe/validation/ValidationException.php');
require_once('ValidationModel.php');


/**
 *
 * @author Tobias Sarnowski
 */ 
class ValidationTest extends PHPUnit_Framework_TestCase implements Module {

    public function configure(Binder $binder) {
        $binder->install(new ValidationModule());

        $binder->bind('ValidationModel')->inRequestScope();
    }


    public function testBoot() {
        $kernel = DefaultKernel::boot($this);
        $model = $kernel->getInstance('ValidationModel');

        // IsNumeric
        $model->validateIsNumeric(0);
        try {
            $model->validateIsNumeric("test");
            $this->assertTrue(false, "previous method call should have thrown an exception");
        } catch (ValidationException $e) {
        }

        // IsText
        $model->validateIsText("text");
        try {
            $model->validateIsText(0);
            $this->assertTrue(false, "previous method call should have thrown an exception");
        } catch (ValidationException $e) {
        }

        // Match
        $model->validateMatch("ssssssss");
        try {
            $model->validateMatch("ssstssss");
            $this->assertTrue(false, "previous method call should have thrown an exception");
        } catch (ValidationException $e) {
        }

        // MaxNumber
        $model->validateMaxNumber(1);
        try {
            $model->validateMaxNumber(3);
            $this->assertTrue(false, "previous method call should have thrown an exception");
        } catch (ValidationException $e) {
        }

        // MaxText
        $model->validateMaxText("ab");
        try {
            $model->validateMaxNumber("abc");
            $this->assertTrue(false, "previous method call should have thrown an exception");
        } catch (ValidationException $e) {
        }

        // MinNumber
        $model->validateMinNumber(3);
        try {
            $model->validateMinNumber(1);
            $this->assertTrue(false, "previous method call should have thrown an exception");
        } catch (ValidationException $e) {
        }

        // MinText
        $model->validateMinText("abc");
        try {
            $model->validateMinNumber("ab");
            $this->assertTrue(false, "previous method call should have thrown an exception");
        } catch (ValidationException $e) {
        }

        // NotEmpty
        $model->validateNotEmpty("a");
        try {
            $model->validateNotEmpty("");
            $this->assertTrue(false, "previous method call should have thrown an exception");
        } catch (ValidationException $e) {
        }

        // NotNull
        $model->validateNotEmpty("a");
        try {
            $model->validateNotNull(null);
            $this->assertTrue(false, "previous method call should have thrown an exception");
        } catch (ValidationException $e) {
        }

        // Multiple things..
        $model->validateMultipleValues(1, "test");
        $model->validateMultipleValues(2, "atestb");
        $model->validateMultipleValues(3, "! test ?");
        try {
            $model->validateMultipleValues(0, "test");
            $this->assertTrue(false, "previous method call should have thrown an exception");
        } catch (ValidationException $e) {
        }
        try {
            $model->validateMultipleValues(4, "test");
            $this->assertTrue(false, "previous method call should have thrown an exception");
        } catch (ValidationException $e) {
        }
        try {
            $model->validateMultipleValues(1, "tst");
            $this->assertTrue(false, "previous method call should have thrown an exception");
        } catch (ValidationException $e) {
        }
        try {
            $model->validateMultipleValues(1, "");
            $this->assertTrue(false, "previous method call should have thrown an exception");
        } catch (ValidationException $e) {
        }
        try {
            $model->validateMultipleValues(0, "");
            $this->assertTrue(false, "previous method call should have thrown an exception");
        } catch (ValidationException $e) {
        }
    }

}
