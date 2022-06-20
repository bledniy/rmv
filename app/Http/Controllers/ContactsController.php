<?php declare(strict_types=1);

namespace App\Http\Controllers;

class ContactsController extends SiteController
{
    public function index()
    {
        $with = compact(array_keys(get_defined_vars()));

        return view('public.contacts.contacts-page')->with($with);
    }
}
