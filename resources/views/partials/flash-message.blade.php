@php
    $messages = [];
    if (session('success')) $messages[] = ['message' => session('success'), 'status' => 'success'];
    if (session('message')) $messages[] = ['message' => session('message'), 'status' => 'info'];
    if (session('error')) $messages[] = ['message' => session('error'), 'status' => 'danger'];
    if (isset($errors) && $errors->any()){
        foreach ($errors->all() as $error){
             $messages[] = ['message' => $error, 'status' => 'danger'];
        }
    }
    $messages = json_encode($messages);
@endphp
