{!! errorDisplay('name') !!}
<input class="input-type-one" type="text" required="required" placeholder="Имя" name="name" value="{{ old('name', getTestField('name')) }}">
{!! errorDisplay('phone') !!}
<input class="input-type-one imaskjs__input_tel" required="required" type="tel"
       placeholder="+38 (0ХХ) ХХХ ХХ ХХ" name="phone" value="{{ old('phone', getTestField('phone')) }}">
{!! errorDisplay('message') !!}
<textarea class="input-type-one textarea" placeholder="Описание" name="message">{{ old('message', getTestField('message')) }}</textarea>