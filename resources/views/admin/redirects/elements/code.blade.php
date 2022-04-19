<label for="code">Redirect code</label>
<select name="code" id="code" autocomplete="off" class="form-control">
    @php
        $selected = (isset($edit)) ? $edit->code : null;
    @endphp
    @foreach($codes as $code => $nameCode)
        @php
            $isSelected = (int)$code === (int)$selected;
        @endphp
        <option value="{{ $code }}" {!! selectedIfTrue($isSelected) !!}>{{ $code }} {{ $nameCode }}</option>
    @endforeach
</select>
