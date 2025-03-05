<?php

namespace App\Factory;

use App\Entity\Voiture;
use App\Enum\GearboxChoice;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Voiture>
 */
final class VoitureFactory extends PersistentProxyObjectFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
    }

    public static function class(): string
    {
        return Voiture::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'dailyPrice' => self::faker()->randomFloat(),
            'description' => self::faker()->text(),
            'gearbox' => self::faker()->randomElement(GearboxChoice::cases()),
            'monthlyPrice' => self::faker()->randomFloat(),
            'name' => self::faker()->text(255),
            'nbOfPlaces' => self::faker()->randomNumber(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Voiture $voiture): void {})
        ;
    }
}
