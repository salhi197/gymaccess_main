<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'name',
        'value',
    ];

    public static function getSetting($titre)
    {
        $setting = Setting::where('titre',$titre)->first();
        return $setting->value ?? '';
    }


    public static function setSetting($titre,$val)
    {
        $setting = Setting::where('titre',$titre)->first();
        $setting->value = $val;
        try {
            $setting->save();
        } catch (\Throwable $th) {
            return 0;
        }
        return 1;
    }
}
