@extends('public.layout.app')

@section('content')
<div class="index-page">
    @includeIf('public.layout.includes.header')
    <main class="main">
        <article class="rmv-documents">
            <div class="container">
                <section class="documents">
                    <div class="document-item">
                        <h3 class="document-item__title">{{$item->getName()}}</h3>
                    </div>
                </section>
            </div>
        </article>
    </main>
    @includeIf('public.layout.includes.footer')
</div>
@stop
