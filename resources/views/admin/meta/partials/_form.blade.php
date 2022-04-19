<?php /** @var $request \Illuminate\Http\Request  */ ?>

@include('admin.partials.crud.elements.url', $request->has('url') ? ['value' => $request->get('url')] : [])

@include('admin.meta.partials._public')
