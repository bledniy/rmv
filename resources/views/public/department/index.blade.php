@extends('public.layout.app')

@section('content')
<div class="index-page">
   @includeIf('public.layout.includes.header')
   <main class="main">
      <article class="department">
         <div class="container">
            <header class="main__header">
               <h2 class="header__title--pre">Відділи Ради молодих вчених<br>Одеського національного
                  університету імені І.І. Мечникова</h2>
               <h2 class="header__title--main">
                  {{$item->getTitle()}}
               </h2>
            </header>
            <section class="department__info ckeditor-wrapper">
               {!! $item->description !!}
            </section>
            

         </div>
      </article>
   </main>
   @includeIf('public.layout.includes.footer')
</div>
@stop