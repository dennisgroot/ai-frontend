<!-- Start API card component -->
<template x-component:raadhuis="apicard">
    <div class="carditem mt-2 bg-white p-3 border rounded">

        <template x-for="(item, index) in $prop('data')" :key="index">

            <div class="p-2 border rounded mb-2">

                <div class="cardheader">
                    <div class="font-bold mb-1 text-sm">
                        Onderdeel: <span x-text="(index + 1)"></span>
                    </div>
                    <!-- Heading -->
                    <div class="grid grid-cols-4 gap-x-1 items-center mb-1.5 uppercase text-xs font-medium">
                        <div class="truncate">Key</div>
                        <div class="truncate">Type</div>
                        <div class="truncate">Waarde</div>
                        <div class="truncate"></div>
                    </div>
                </div>

                <template x-for="(value, key) in item" :key="key">
                    <div
                        x-data="{ expanded: false }"
                        class="p-2 border rounded mb-2 group hover:border-blue-500 focus-within:border-blue-500"
                        :draggable="true"
                        @dragstart="dragging = index; draggedKey = key"
                        @dragend="dragging = null; draggedKey = null"
                        @dragover.prevent
                        @drop="() => { 
                            const draggedItem = apiData[dragging][draggedKey];
                            // delete apiData[dragging][draggedKey];
                            apiData[index][key] = draggedItem;
                        }">
                        <div class="grid grid-cols-4 gap-x-1 items-center">
                            <div class="truncate" x-text="key"></div>
                            <div class="truncate text-gray-500" x-text="getType(value)"></div>

                            <template x-if="getType(value) === 'object' || getType(value) === 'array'">
                                <div class="truncate" x-text="Object.keys(value).length == 1 ? Object.keys(value).length + ' onderdeel' : Object.keys(value).length + ' onderdelen'"></div>
                            </template>

                            <!-- Show collapse arrow if object of array -->
                            <template x-if="getType(value) == 'object'">
                                <div class="text-right">
                                    <button :data-key="getType(value) + '_' + key + '_' + index" type="button" :class="expanded ? 'rotate-180' : ''" class="hover:bg-blue-500 hover:text-white focus:bg-blue-500 focus:text-white justify-center items-center w-[22px] h-[22px] rounded-full inline-flex" @click="expanded = !expanded">
                                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </div>
                            </template>

                            <!-- Rerender api-card if object of array -->
                            <template x-if="expanded && (getType(value) === 'object' || getType(value) === 'array')">
                                <div class="col-span-full">
                                    <raadhuis-apicard :data="[value]"></raadhuis-apicard>
                                </div>
                            </template>

                            <!-- If no object, show value -->
                            <template x-if="getType(value) !== 'object' && getType(value) !== 'array'">
                                <div class="truncate" x-text="value"></div>
                            </template>

                            <!-- Drag icon -->
                            <template x-if="getType(value) !== 'object' && getType(value) !== 'array'">
                                <svg class="w-4 h-4 justify-self-end fill-current group-hover:text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M8.5 7C9.32843 7 10 6.32843 10 5.5C10 4.67157 9.32843 4 8.5 4C7.67157 4 7 4.67157 7 5.5C7 6.32843 7.67157 7 8.5 7ZM8.5 13.5C9.32843 13.5 10 12.8284 10 12C10 11.1716 9.32843 10.5 8.5 10.5C7.67157 10.5 7 11.1716 7 12C7 12.8284 7.67157 13.5 8.5 13.5ZM10 18.5C10 19.3284 9.32843 20 8.5 20C7.67157 20 7 19.3284 7 18.5C7 17.6716 7.67157 17 8.5 17C9.32843 17 10 17.6716 10 18.5ZM15.5 7C16.3284 7 17 6.32843 17 5.5C17 4.67157 16.3284 4 15.5 4C14.6716 4 14 4.67157 14 5.5C14 6.32843 14.6716 7 15.5 7ZM17 12C17 12.8284 16.3284 13.5 15.5 13.5C14.6716 13.5 14 12.8284 14 12C14 11.1716 14.6716 10.5 15.5 10.5C16.3284 10.5 17 11.1716 17 12ZM15.5 20C16.3284 20 17 19.3284 17 18.5C17 17.6716 16.3284 17 15.5 17C14.6716 17 14 17.6716 14 18.5C14 19.3284 14.6716 20 15.5 20Z"></path>
                                </svg>
                            </template>

                        </div>
                    </div>
                </template>
            </div>
        </template>
    </div>
</template>
<!-- End API card component -->