<?php
/**
 * BjyAuthorize Module (https://github.com/bjyoungblood/BjyAuthorize)
 *
 * @link https://github.com/bjyoungblood/BjyAuthorize for the canonical source repository
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

return [
    'bjyauthorize' => [
        // default role for unauthenticated users
        'default_role'          => 'guest',

        // default role for authenticated users (if using the
        // 'BjyAuthorize\Provider\Identity\AuthenticationIdentityProvider' identity provider)
        'authenticated_role'    => 'user',

        // identity provider service name
        'identity_provider'     => 'BjyAuthorize\Provider\Identity\ZfcUserZendDb',

        // Role providers to be used to load all available roles into Zend\Permissions\Acl\Acl
        // Keys are the provider service names, values are the options to be passed to the provider
        'role_providers'        => [],

        // Resource providers to be used to load all available resources into Zend\Permissions\Acl\Acl
        // Keys are the provider service names, values are the options to be passed to the provider
        'resource_providers'    => [],

        // Rule providers to be used to load all available rules into Zend\Permissions\Acl\Acl
        // Keys are the provider service names, values are the options to be passed to the provider
        'rule_providers'        => [],

        // Guard listeners to be attached to the application event manager
        'guards'                => [],

        // strategy service name for the strategy listener to be used when permission-related errors are detected
        'unauthorized_strategy' => 'BjyAuthorize\View\UnauthorizedStrategy',

        // Template name for the unauthorized strategy
        'template'              => 'error/403',

        // cache options have to be compatible with Zend\Cache\StorageFactory::factory
        'cache_options'         => [
            'adapter'   => [
                'name' => 'memory',
            ],
            'plugins'   => [
                'serializer',
            ]
        ],

        // Key used by the cache for caching the acl
        'cache_key'             => 'bjyauthorize_acl'
    ],

    'service_manager' => [
        'factories' => [
            'BjyAuthorize\Cache'                    => 'BjyAuthorize\Service\CacheFactory',
            'BjyAuthorize\CacheKeyGenerator'        => 'BjyAuthorize\Service\CacheKeyGeneratorFactory',
            'BjyAuthorize\Config'                   => 'BjyAuthorize\Service\ConfigServiceFactory',
            'BjyAuthorize\Guards'                   => 'BjyAuthorize\Service\GuardsServiceFactory',
            'BjyAuthorize\RoleProviders'            => 'BjyAuthorize\Service\RoleProvidersServiceFactory',
            'BjyAuthorize\ResourceProviders'        => 'BjyAuthorize\Service\ResourceProvidersServiceFactory',
            'BjyAuthorize\RuleProviders'            => 'BjyAuthorize\Service\RuleProvidersServiceFactory',
            'BjyAuthorize\Guard\Controller'         => 'BjyAuthorize\Service\ControllerGuardServiceFactory',
            'BjyAuthorize\Guard\Route'              => 'BjyAuthorize\Service\RouteGuardServiceFactory',
            'BjyAuthorize\Provider\Role\Config'     => 'BjyAuthorize\Service\ConfigRoleProviderServiceFactory',
            'BjyAuthorize\Provider\Role\ZendDb'     => 'BjyAuthorize\Service\ZendDbRoleProviderServiceFactory',
            'BjyAuthorize\Provider\Rule\Config'     => 'BjyAuthorize\Service\ConfigRuleProviderServiceFactory',
            'BjyAuthorize\Provider\Resource\Config' => 'BjyAuthorize\Service\ConfigResourceProviderServiceFactory',
            'BjyAuthorize\Service\Authorize'        => 'BjyAuthorize\Service\AuthorizeFactory',
            'BjyAuthorize\Provider\Identity\ProviderInterface'
                => 'BjyAuthorize\Service\IdentityProviderServiceFactory',
            'BjyAuthorize\Provider\Identity\AuthenticationIdentityProvider'
                => 'BjyAuthorize\Service\AuthenticationIdentityProviderServiceFactory',
            'BjyAuthorize\Provider\Role\ObjectRepositoryProvider'
                => 'BjyAuthorize\Service\ObjectRepositoryRoleProviderFactory',
            'BjyAuthorize\Collector\RoleCollector'  => 'BjyAuthorize\Service\RoleCollectorServiceFactory',
            'BjyAuthorize\Provider\Identity\ZfcUserZendDb'
                => 'BjyAuthorize\Service\ZfcUserZendDbIdentityProviderServiceFactory',
            'BjyAuthorize\View\UnauthorizedStrategy'
                => 'BjyAuthorize\Service\UnauthorizedStrategyServiceFactory',
            'BjyAuthorize\Service\RoleDbTableGateway' => 'BjyAuthorize\Service\UserRoleServiceFactory',
        ],
        'invokables'  => [
            'BjyAuthorize\View\RedirectionStrategy' => 'BjyAuthorize\View\RedirectionStrategy',
        ],
        'aliases'     => [
            'bjyauthorize_zend_db_adapter' => 'Zend\Db\Adapter\Adapter',
        ],
        'initializers' => [
            'BjyAuthorize\Service\AuthorizeAwareServiceInitializer'
                => 'BjyAuthorize\Service\AuthorizeAwareServiceInitializer'
        ],
    ],

    'view_manager' => [
        'template_map' => [
            'error/403' => __DIR__ . '/../view/error/403.phtml',
            'zend-developer-tools/toolbar/bjy-authorize-role'
                => __DIR__ . '/../view/zend-developer-tools/toolbar/bjy-authorize-role.phtml',
        ],
    ],

    'zenddevelopertools' => [
        'profiler' => [
            'collectors' => [
                'bjy_authorize_role_collector' => 'BjyAuthorize\\Collector\\RoleCollector',
            ],
        ],
        'toolbar' => [
            'entries' => [
                'bjy_authorize_role_collector' => 'zend-developer-tools/toolbar/bjy-authorize-role',
            ],
        ],
    ],
];
