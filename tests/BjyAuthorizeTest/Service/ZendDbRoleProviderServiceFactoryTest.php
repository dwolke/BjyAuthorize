<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright      Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @package        Zend_Service
 */

namespace BjyAuthorizeTest\Service;

use \PHPUnit\Framework\TestCase;
use BjyAuthorize\Service\ZendDbRoleProviderServiceFactory;

/**
 * Test for {@see \BjyAuthorize\Service\ZendDbRoleProviderServiceFactory}
 *
 * @author Marco Pivetta <ocramius@gmail.com>
 */
class ZendDbRoleProviderServiceFactoryTest extends TestCase
{
    /**
     * @covers \BjyAuthorize\Service\ZendDbRoleProviderServiceFactory::createService
     */
    public function testCreateService()
    {
        $factory          = new ZendDbRoleProviderServiceFactory();
        $serviceLocator   = $this->createMock('Zend\\ServiceManager\\ServiceLocatorInterface');
        $config           = [
            'role_providers' => [
                'BjyAuthorize\Provider\Role\ZendDb' => [],
            ],
        ];

        $serviceLocator
            ->expects($this->any())
            ->method('get')
            ->with('BjyAuthorize\Config')
            ->will($this->returnValue($config));

        $guard = $factory->createService($serviceLocator);

        $this->assertInstanceOf('BjyAuthorize\\Provider\\Role\\ZendDb', $guard);
    }
}
