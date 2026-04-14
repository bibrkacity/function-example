<?php

namespace App\DTO;

use Illuminate\Http\Request;

/**
 * DTO for User's list
 */
readonly class UserDTO extends DTO
{
    public ?string $email;
    public ?string $zodiac;

    #[\Override]
    protected function fromRequest(Request $request): void
    {
        parent::fromRequest($request);

        $this->email = $request->input('email');
        $this->zodiac = $request->input('zodiac');

    }

    #[\Override]
    protected function getSortNameDefault(): string
    {
        return 'name';
    }

    #[\Override]
    protected function getRouteName(): string
    {
        return 'api.v1.users.index';
    }

    #[\Override]
    protected function getDefaults(): array
    {
        return [
            ...parent::getDefaults(),
            'email' => null,
            'zodiac' => null,
        ];
    }
}
