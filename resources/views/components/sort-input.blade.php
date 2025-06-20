@props(['sort' => 'normalSort', 'order' => 'normalOrder', 'options'])

<div class="flex flex-col w-full gap-y-2 items-start">
    <strong class="text-lg text-center">{{ $slot }}</strong>
    <div class="flex gap-x-3">
        <select name="{{ $sort }}" id="{{ $sort }}" class="shadow-sm p-2 rounded-lg bg-white">
            <option value="name" @selected($options[$sort] === 'name')>Alphabetisch</option>
            <option value="number" @selected($options[$sort] === 'number')>Nummering</option>
        </select>
        <select name="{{ $order }}" id="{{ $order }}" class="shadow-sm p-2 rounded-lg bg-white">
            <option value="asc" @selected($options[$order] === 'asc')>Oplopend</option>
            <option value="desc" @selected($options[$order] === 'desc')>Aflopend</option>
        </select>
    </div>
</div>