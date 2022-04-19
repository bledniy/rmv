<?php /** @var $item \App\Models\Feedback\Feedback */ ?>
<?php /** @var $permissionKey string */ ?>
@php
    $canEdit = false;
@endphp

@includeIf('admin.feedback.head')

<div class="table-responsive">
    <table class="table table-shopping">
        <thead>
        <tr>
            <th class="th-description">ID</th>
            <th>{{ __('validation.attributes.name') }}</th>
            <th>{{ __('validation.attributes.phone') }}</th>
            <th>{{ __('validation.attributes.comment') }}</th>
            <th></th>
            <th>Файлы</th>
            <th>Тип</th>
            <th>Дата создания</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->getAttribute('name') }}</td>
                <td>{{ $item->getPhoneDisplay() }}</td>
                <td>{{ $item->getAttribute('message') }}</td>
                <td>
                    <x-admin.feedback.display-vacancy :feedback="$item"></x-admin.feedback.display-vacancy>
                    @includeWhen(false, 'components.admin.feedback.display-vacancy')
                </td>
                <td>
                    @foreach($item->getFiles() as $fileName =>$filePath)
                        @if (storageFileExists($filePath))
                            <a href="{{ getStorageFilePath($filePath) }}" title="{{ $fileName ?: getLastFromExploded($filePath) }}" class="badge badge-success"
                               target="_blank">{{ \Illuminate\Support\Str::limit($fileName, 15) ?: sprintf('Файл %d', $loop->iteration) }} <b>[.{{ \App\Helpers\File\File::extractExtension($filePath) }}]</b></a>
                        @endif
                    @endforeach
                </td>
                <td>
                    <small class="text-nowrap">{{ $item->getTypeEnum()->getTitle() }}</small>
                </td>
                <td>{{ getDateFormatted($item->getCreatedAt()) }}</td>
                <td class="text-primary text-right">
                    @include('admin.partials.action.index_actions')
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{{$list->render()}}