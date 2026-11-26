<?php

namespace Dannebicque\TableBundle\Security;

use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

/**
 * Jeton CSRF des actions XHR ; retourne null si la protection CSRF n'est pas activée.
 */
class ActionToken
{
    public function __construct(private readonly ?CsrfTokenManagerInterface $manager = null)
    {
    }

    public function get(?string $tokenId): ?string
    {
        return null === $tokenId ? null : $this->manager?->getToken($tokenId)->getValue();
    }
}
