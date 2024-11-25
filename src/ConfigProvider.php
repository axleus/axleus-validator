<?php

declare(strict_types=1);

namespace Axleus\Validator;

use Axleus\Core\ConfigProviderInterface;

final class ConfigProvider implements ConfigProviderInterface
{
    public function __invoke(): array
    {
        return [
            static::AXLEUS_KEY => [static::class => $this->getAxleusSettings()],
            'dependencies'     => $this->getDependencyConfig(),
            'validators'       => $this->getDependencyConfig(),
        ];
    }

    public function getAxleusSettings(): array
    {
        return [
            PasswordRequirement::class => [
                'options' => [
                    'length'  => 8, // overall length of password
                    'upper'   => 1, // uppercase count
                    'lower'   => 2, // lowercase count
                    'digit'   => 2, // digit count
                    'special' => 2, // special char count
                ],
            ],
        ];
    }

    public function getDependencyConfig(): array
    {
        return [
            'factories' => [
                PasswordRequirement::class => Container\Factory::class,
            ],
        ];
    }
}
