@php
    $messages = [];
    if (session('success')) $messages[] = ['message' => session('success'), 'status' => 'success'];
    if (session('message')) $messages[] = ['message' => session('message'), 'status' => 'info'];
    if (session('error')) $messages[] = ['message' => session('error'), 'status' => 'danger'];
    if (session('warning')) $messages[] = ['message' => session('warning'), 'status' => 'warning'];
    if ($errors->any()){
        foreach ($errors->all() as $error){
             $messages[] = ['message' => $error, 'status' => 'danger'];
        }
    }
    $messages = json_encode($messages);
@endphp
@if ($messages)
    <script type="text/javascript" defer>
        $(document).ready(function () {
            $messages = {!! $messages !!};
            $messages.forEach(function (item) {
                message(item.message, item.status);
            })
        });
    </script>
@endif
