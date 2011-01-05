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

require_once('pinjector/DocParser.php');
require_once('pinjector/Interceptor.php');
require_once('ValidationService.php');


/**
 *
 * @author Tobias Sarnowski
 */ 
class ValidationInterceptor implements Interceptor {

    /**
     * @var ValidationService
     */
    private $validationService;

    /**
     * @param ValidationService $validationService
     * @return void
     */
    function __construct(ValidationService $validationService) {
        $this->validationService = $validationService;
    }

    public function intercept(InterceptionChain $chain) {
        // parse configuration
        $validationConfigs = DocParser::parseSettings($chain->getMethod()->getDocComment(), 'validate');
        $validations = array();
        foreach ($validationConfigs as $validationConfig) {
            $config = explode(' ', $validationConfig);

            // just for one argument?
            $variable = null;
            if ($config[0][0] == '$') {
                $variable = substr($config[0], 1);
                array_shift($config);
            }

            // which validator?
            $validator = $config[0];
            array_shift($config);

            // config
            $parameters = array();
            foreach ($config as $c) {
                list($key, $value) = explode('=', $c);
                $parameters[$key] = $value;
            }

            // save it
            $validations[] = array(
                'variable' => $variable,
                'validator' => $validator,
                'parameters' => $parameters
            );
        }

        // test all parameters
        $index = 0;
        $reflectionParameters = $chain->getMethod()->getParameters();
        foreach ($chain->getParameters() as $value) {
            $reflectionParameter = $reflectionParameters[$index];

            // now check all validations
            foreach ($validations as $validation) {

                // just for a specific variable?
                if ($validation['variable'] != null) {
                    if ($reflectionParameter->getName() != $validation['variable']) {
                        continue;
                    }
                }

                // validate!
                $this->validationService->validate($value, $validation['validator'], $validation['parameters']);
            }

            $index++;
        }

        // all right, go on
        return $chain->proceed();
    }
}
