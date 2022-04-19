<?php

namespace App\Models;


/**
 * App\Models\MenuLang
 *
 * @property int $menu_id
 * @property string|null $name
 * @property int $language_id
 * @property-read \App\Models\Language $language
 * @property-read \App\Models\Menu $menu
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model active($active = 1)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuLang newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuLang newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model orWhereLike($column, $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuLang query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model whereLike($column, $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuLang whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuLang whereName($value)
 * @mixin \Eloquent
 */
class MenuLang extends ModelLang
{
    protected $table = 'menu_lang';

    protected $primaryKey = ['menu_id', 'language_id'];


    protected $guarded = [];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
