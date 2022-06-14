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
            <section class="department__members">
               <div class="member">
                  <img src="" alt="" class="member__img">
                  <div class="member__info">
                     <p class="member__position">Голова відділу роботи з громадськістю</p>
                     <p class="member__name">Святошнюк Арина Леонідівна</p>
                     <p class="member__activity">Кандидат юридичних наук, доцент кафедри цивільно-правових
                        дисциплін</p>
                     <p class="member__email">lorem@gmail.com</p>
                     <p class="member__phone">+380 ** *** ** **</p>
                  </div>
               </div>
            </section>
            <section class="department__info ckeditor-wrapper">
               {!! $item->description !!}
            </section>
         </div>
      </article>
   </main>
   @includeIf('public.layout.includes.footer')
</div>
@stop