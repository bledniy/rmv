<?php

if (!function_exists('selectedIfTrue')) {
    function selectedIfTrue($condition)
    {
        return ($condition) ? 'selected="selected"' : '';
    }
}
if (!function_exists('checkedIfTrue')) {
    function checkedIfTrue($condition)
    {
        return ($condition) ? 'checked="checked"' : '';
    }
}
if (!function_exists('inputDisabledIfTrue')) {
    function inputDisabledIfTrue($condition)
    {
        return ($condition) ? 'disabled="disabled"' : '';
    }
}


if (!function_exists('formatTel')) {
    function formatTel($tel)
    {
        return preg_replace('/[^0-9]/', '', $tel);
    }
}

function editLinkAdmin(string $link, string $text = 'Редактировать'): string
{
    if (!isAdmin()) {
        return '';
    }
    $style = 'font-size: 14px;background: #23935e;padding: 0px 15px; text-align:center; max-width: 120px';

    return sprintf('<a href="%s" style="%s" target="_blank">%s</a>', $link, $style, $text);
}

if (!function_exists('editButtonAdmin')) {
    function editButtonAdmin(string $link, string $text = 'Edit')
    {
        if (!isAdmin()) {
            return null;
        }
        $style = 'z-index=9999; bottom:30px; right:30px; border-radius: 0';
        $html = '<a href="%s" style="%s" class="btn btn-wide btn-success px-5 adminEditBtn position-fixed"  target="_blank">%s</a>';

        return sprintf($html, $link, $style, $text);
    }
}


if (!function_exists('errorDisplay')) {
    function errorDisplay($key, $class = 'text-danger', $tag = 'p'): string
    {
        $message = '';
        static $errors = null;
        if ($errors === null) {
            $errors = session('errors', new Illuminate\Support\MessageBag);
        }
        try {
            if ($errors->has($key)) {
                foreach ($errors->get($key) as $error) {
                    $message .= generateBootstrapMessage($error, $class);
                }
            }
        } catch (Exception $e) {

        }

        return $message;
    }
}

function generateBootstrapMessage($error, $class = 'text-danger', $tag = 'p')
{
    return '<' . $tag . ' class="' . $class . '">' . $error . '</' . $tag . '>';
}

function linkEditIfAdmin(\App\Models\Model $model, $text = 'Редактировать', $badge = 'warning')
{
    if (!isAdmin()) {
        return '';
    }
    $action = 'edit';
    try {
        $link = (CRUDLinkByModel($model)->{$action}());
    } catch (\Exception $e) {
        $link = '';
    }

    return sprintf('<a href="%s" target="_blank" class="badge badge-%s no-radius">%s</a>', $link, $badge, $text);
}

if (!function_exists('showEditor')) {
    function showEditor($id)
    {
        $script = "
    CKEDITOR.replace('%s', {
    filebrowserBrowseUrl: '/elfinder/ckeditor',
    filebrowserImageBrowseUrl: '/elfinder/ckeditor',
    language: '%s',
    uiColor: '#9AB8F3',
    height: 300
    });
    ";
        $script = sprintf($script, $id, app()->getLocale());

        return $script;
    }
}


if (!function_exists('htmlLinkString')) {
    function htmlLinkString($link, $text = null, $target = '_blank', $class = '')
    {
        $text = $text ?? $link;

        return '<a class="' . $class . '" target="' . $target . '" href="' . $link . '">' . $text . '</a>';
    }
}