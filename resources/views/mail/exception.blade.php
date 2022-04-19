<?php /** @var $user \App\Models\User */ ?>
<div class="text-center">
    {{ request()->getHost() }}
    <a href="{{ url()->previous() }}" class="btn">Previous</a>
    <a class="ml-5 btn btn-danger" href="{{ url()->current() }}">From page error</a>
    @if (isset($user) && $user) {{ $user->email }} @endif
</div>

{!! $content !!}

@include('mail.partials.boostrap-styles')