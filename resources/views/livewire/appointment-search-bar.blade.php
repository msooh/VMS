<div>
<input type="text" 
        name="" id="appno" 
        class="typeahead form-input" 
        placeholder="Search Appointment Number"
        wire:model ="query" 
/>

@if(!empty($appointments))
<div class="absolute z-10 list-group">
        @foreach($appointments as $appointment )

        <option value="" class="list-item">{{$appointment['name']}} {{}}</option>
        @endforeach

</div>
@else
<div class="list-item">
    No Items!
</div>

@endif
</div>
