<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Puce extends Model
{
    public function agent()
    {
        $user = USer::find($this->user);
        return $user['name'] ?? '';

    }

}
