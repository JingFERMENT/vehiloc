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
            'dailyPrice' => self::faker()->unique()->randomFloat(2,20,40),
            'description' => self::faker()->text(255),
            'gearbox' => self::faker()->randomElement(GearboxChoice::cases()),
            'monthlyPrice' => self::faker()->unique()->randomFloat(2,800,1000),
            'name' => self::faker()->words(2, true),
            'nbOfPlaces' => self::faker()->numberBetween(1, 9),
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
