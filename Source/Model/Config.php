<?php
/**
 * Greetings from Wamoco GmbH, Bremen, Germany.
 * @author Wamoco Team<info@wamoco.de>
 * @license See LICENSE.txt for license details.
 */

namespace Wamoco\DisableCustomer\Model;

/**
 * Class: Config
 */
class Config
{
    /**
     * getMessage
     * @return string|null
     */
    public function getMessage()
    {
        return __("Your account is disabled.");
    }
}
