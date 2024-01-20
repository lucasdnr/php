<x-layout title="New Series">
    <x-series.form :action="route('series.store')" :name="old('name')" :update="false"/>
</x-layout>