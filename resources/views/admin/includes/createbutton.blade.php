<div class="clearfix">
    @php
     $create_url = isset($param) && count($param) > 0 ? route($create_url, $param) : route($create_url);
    @endphp
    <a href="{{ $create_url }}" class="float-right mt-2 mb-2"><button type="button"
            class="btn btn-primary">{{ $create_text }}</button></a>
</div>
