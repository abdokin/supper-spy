@props([
    'value',
])

<div class="flex gap-2">
    <livewire:edit-user :user_id="$value" :key="$value . '_' . uniqid()" @saved="$refresh"/>
    <livewire:delete-user :user_id="$value" :key="$value . '_' . uniqid()" @saved="$refresh"/>

</div>
