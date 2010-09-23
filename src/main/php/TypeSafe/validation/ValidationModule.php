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

require_once('pinjector/Module.php');
require_once('TypeSafe/validation/DefaultValidationService.php');
require_once('TypeSafe/validation/ValidationService.php');
require_once('TypeSafe/validation/ValidationInterceptor.php');
require_once('TypeSafe/validation/ValidationPointcut.php');
require_once('TypeSafe/validation/validators/IsNumericValidator.php');
require_once('TypeSafe/validation/validators/IsTextValidator.php');
require_once('TypeSafe/validation/validators/MatchValidator.php');
require_once('TypeSafe/validation/validators/MaxNumberValidator.php');
require_once('TypeSafe/validation/validators/MaxTextValidator.php');
require_once('TypeSafe/validation/validators/MinNumberValidator.php');
require_once('TypeSafe/validation/validators/MinTextValidator.php');
require_once('TypeSafe/validation/validators/NotEmptyValidator.php');
require_once('TypeSafe/validation/validators/NotNullValidator.php');

/**
 *
 * @author Tobias Sarnowski
 */ 
class ValidationModule implements Module {

    public function configure(Binder $binder) {
        $binder->bind('ValidationService')->to('DefaultValidationService')->inRequestScope();

        $binder->bind('ValidationInterceptor')->inRequestScope();
        $binder->interceptWith('ValidationInterceptor')->on(new ValidationPointcut());

        $binder->bind('Validator')->annotatedWith('IsNumeric')->to('IsNumericValidator')->inRequestScope();
        $binder->bind('Validator')->annotatedWith('IsText')->to('IsTextValidator')->inRequestScope();
        $binder->bind('Validator')->annotatedWith('Match')->to('MatchValidator')->inRequestScope();
        $binder->bind('Validator')->annotatedWith('MaxNumber')->to('MaxNumberValidator')->inRequestScope();
        $binder->bind('Validator')->annotatedWith('MaxText')->to('MaxTextValidator')->inRequestScope();
        $binder->bind('Validator')->annotatedWith('MinNumber')->to('MinNumberValidator')->inRequestScope();
        $binder->bind('Validator')->annotatedWith('MinText')->to('MinTextValidator')->inRequestScope();
        $binder->bind('Validator')->annotatedWith('NotEmpty')->to('NotEmptyValidator')->inRequestScope();
        $binder->bind('Validator')->annotatedWith('NotNull')->to('NotNullValidator')->inRequestScope();
    }
}
