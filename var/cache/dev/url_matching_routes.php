<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/companies' => [[['_route' => 'getCompanies', '_controller' => 'App\\Controller\\CompanyController::getCompanies'], null, ['GET' => 0], null, false, false, null]],
        '/users' => [
            [['_route' => 'getUsers', '_controller' => 'App\\Controller\\UserController::getUsers'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'postUser', '_controller' => 'App\\Controller\\UserController::createUser'], null, ['POST' => 0], null, false, false, null],
        ],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/company(?'
                    .'|(?:/([^/]++))?(*:67)'
                    .'|(*:74)'
                    .'|(?:/([^/]++))?(?'
                        .'|(*:98)'
                    .')'
                .')'
                .'|/user(?:/([^/]++))?(?'
                    .'|(*:129)'
                .')'
                .'|/vacanc(?'
                    .'|ies(?:/([^/]++))?(*:165)'
                    .'|y(?'
                        .'|(?:/([^/]++))?(*:191)'
                        .'|(*:199)'
                        .'|(?:/([^/]++))?(?'
                            .'|(*:224)'
                        .')'
                    .')'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        67 => [[['_route' => 'getCompany', 'id' => 1, '_controller' => 'App\\Controller\\CompanyController::getCompany'], ['id'], ['GET' => 0], null, false, true, null]],
        74 => [[['_route' => 'postCompany', '_controller' => 'App\\Controller\\CompanyController::createCompany'], [], ['POST' => 0], null, false, false, null]],
        98 => [
            [['_route' => 'updateCompany', 'id' => 1, '_controller' => 'App\\Controller\\CompanyController::updateCompany'], ['id'], ['PATCH' => 0], null, false, true, null],
            [['_route' => 'deleteCompany', 'id' => 1, '_controller' => 'App\\Controller\\CompanyController::deleteCompany'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        129 => [
            [['_route' => 'getUser', 'id' => 1, '_controller' => 'App\\Controller\\UserController::getUsero'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'putUser', 'id' => 1, '_controller' => 'App\\Controller\\UserController::putUser'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'deleteUser', 'id' => 1, '_controller' => 'App\\Controller\\UserController::deleteUser'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        165 => [[['_route' => 'getVacanciesByCompanyId', 'companyId' => 1, '_controller' => 'App\\Controller\\VacancyController::getVacancies'], ['companyId'], ['GET' => 0], null, false, true, null]],
        191 => [[['_route' => 'getVacancy', 'id' => 1, '_controller' => 'App\\Controller\\VacancyController::getVacancy'], ['id'], ['GET' => 0], null, false, true, null]],
        199 => [[['_route' => 'postVacancy', '_controller' => 'App\\Controller\\VacancyController::createVacancy'], [], ['POST' => 0], null, false, false, null]],
        224 => [
            [['_route' => 'patchVacancy', 'id' => 1, '_controller' => 'App\\Controller\\VacancyController::updateVacancy'], ['id'], ['PATCH' => 0], null, false, true, null],
            [['_route' => 'deleteVacancy', 'id' => 1, '_controller' => 'App\\Controller\\VacancyController::deleteVacancy'], ['id'], ['DELETE' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
