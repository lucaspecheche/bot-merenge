<?php

namespace App;

use App\Models\Menu;
use BotMan\BotMan\Interfaces\UserInterface;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'identifier', 'first_name', 'last_name', 'status',
    ];

    public function findByIdentifier(int $identifier): ?User
    {
        return $this::query()->where('identifier', $identifier)->get()->first();
    }

    public function findOrCreate(UserInterface $userChat): User
    {
        $user = $this->findByIdentifier($userChat->getId());

        if(is_null($user)){
            $user = (new User);
            $user->fill($this->adapter($userChat))
                ->save();
        }

        return $user;
    }

    private function adapter(UserInterface $identifier): array
    {
        return [
            'identifier' => $identifier->getId(),
            'first_name' => $identifier->getFirstName(),
            'last_name'  => $identifier->getLastName(),
            'username'   => $identifier->getUsername(),
            'status'     => data_get($identifier->getInfo(), 'status')
        ];
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'dishes_menus', 'menuId', 'dishId');
    }
}
