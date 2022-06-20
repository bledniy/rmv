<?php /** @var $data \App\DataContainers\Vacancies\VacancyData */ ?>
<a class="btn btn-primary" href="{{ route('admin.vacancies.edit', $data->getId()) }}">
    {{ $data->getName() }}
</a>
