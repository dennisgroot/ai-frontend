<!-- TODO: De selecteerde en gesleepte key vanuit apiData naar nieuwe waarde binnen WP data zetten, en wegschrijven naar migrationProfile variabele. -->
<!-- Start API card component -->
<template x-component:raadhuis="wpcard">
    <div class="carditem mt-2 bg-white p-3 border rounded">
        <template x-for="(item, index) in $prop('data')" :key="index">
            <div class="p-2 border rounded mb-2">
                <div class="cardheader">
                    <div class="font-bold mb-1 text-sm">
                        Onderdeel: <span x-text="(index + 1)"></span>
                    </div>
                    <!-- Heading -->
                    <div class="grid grid-cols-4 gap-x-1 items-center mb-1.5 uppercase text-xs font-medium">
                        <span class="truncate">Key</span>
                        <span class="truncate">Type</span>
                        <span class="truncate">Huidige waarde</span>
                        <span class="truncate">Nieuwe waarde</span>
                    </div>
                </div>
                <template x-for="(value, key) in item" :key="key">
                    <div
                        class="p-2 border rounded mb-2 group hover:border-blue-500">
                        <div class="grid grid-cols-4 gap-x-1 items-center">
                            <span class="truncate" x-text="key"></span>
                            <span class="truncate text-gray-500" x-text="getType(value)"></span>
                            <template x-if="getType(value) === 'object' || getType(value) === 'array'">
                                <span class="col-span-full">
                                    <raadhuis-wpcard :data="[value]"></raadhuis-wpcard>
                                </span>
                            </template>
                            <template x-if="getType(value) !== 'object' && getType(value) !== 'array'">
                                <span class="truncate" x-text="value"></span>
                            </template>
                        </div>
                    </div>
                </template>
            </div>
        </template>
    </div>
</template>
<!-- End API card component -->