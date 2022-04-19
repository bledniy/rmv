<?php /** @var $feedback \App\DataContainers\Feedback\FeedbackMailData */ ?>
@extends('mail.layout.layout')

@section('content')
    <table class="table">
        <tr>
            <td>Имя</td>
            <td>{{ $feedback->getName() }}</td>
        </tr>
        <tr>
            <td>Телефон</td>
            <td>{{ $feedback->getPhone() }}</td>
        </tr>
        <tr>
            <td>Сообщение</td>
            <td>{{ $feedback->getMessage() }}</td>
        </tr>
    </table>
    <a href="{{ route('admin.feedback.index') }}" class="btn btn-success">Смотреть</a>
@stop