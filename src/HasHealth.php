<?php

declare(strict_types=1);

namespace Dungeon;

/**
 * Niveau 4 : déplacez ici les propriétés et méthodes de santé communes à Hero
 * et Monster ($maxHp, $hp avec son hook `set`, $isFullHealth, takeDamage(),
 * heal(), isAlive()), puis remplacez-les par `use HasHealth;` dans les deux classes.
 *
 * Un trait n'est pas un parent : c'est du code copié dans la classe qui l'utilise.
 * `private(set)` et les hooks y fonctionnent comme dans une classe.
 */
trait HasHealth
{
    /** Le maximum de points de vie. */
    public private(set) int $maxHp;

    /** Les points de vie courants : le hook les garde entre 0 et $maxHp. */
    public private(set) int $hp {
        set => max(0, min($this->maxHp, $value));
    }

    public bool $isFullHealth {
        get => $this->hp === $this->maxHp;
    }

    public function takeDamage(int $amount): void
    {
        if ($amount < 0) {
            throw new \InvalidArgumentException("Un dégât ne peut pas être négatif, $amount reçu.");
        }

        $this->hp -= $amount;
    }

    public function heal(int $amount): void
    {
        if ($amount < 0) {
            throw new \InvalidArgumentException("Un soin ne peut pas être négatif, $amount reçu.");
        }

        $this->hp += $amount;
    }

    public function isAlive(): bool
    {
        return $this->hp > 0;
    }
}
