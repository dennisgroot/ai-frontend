<?php

/**
 * Provide a admin area view for the plugin
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://raadhuis.com
 * @since      1.0.0
 *
 * @package    Raadhuis_Api_Import_Mapper
 * @subpackage Raadhuis_Api_Import_Mapper/admin/partials
 */

?>
<div x-cloak x-data="apiMapper" class="w-full h-full grid grid-cols-2 items-start justify-center gap-x-6">

    <div>
        <!-- FORM: Get from source -->
        <form action="#" class="w-full bg-white p-5 rounded border mb-8 h-[250px]">
            <!-- API URL invoer -->
            <div class="mb-4">
                <label for="apiUrl" class="block text-sm font-medium text-gray-700">API URL</label>
                <input type="text" x-model="apiUrl" id="apiUrl" placeholder="https://api.example.com/data" class="w-full mt-1 p-2 border rounded">
            </div>

            <!-- API key -->
            <div class="mb-4">
                <label for="apiKey" class="block text-sm font-medium text-gray-700">API key</label>
                <input type="text" x-model="apiKey" id="apiKey" placeholder="********" class="w-full mt-1 p-2 border rounded">
                <small>Optioneel</small>
            </div>

            <button @click="fetchData" type="button" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded" :class="isLoading ? 'button-disabled' : ''" x-text="isLoading ? 'Data wordt geladen…' : 'API data ophalen'"></button>
        </form>

        <!-- Results -->
        <template x-if="apiData">
            <div>
                <div class="flex flex-wrap w-full gap-x-4 jusitfy-between mb-4">
                    <div class="flex flex-col">
                        <h2 class="text-lg font-bold">API response data</h2>
                        <div class="flex flex-row flex-wrap text-sm">
                            <span x-text="apiData.length + ' onderdelen'"></span>
                        </div>
                    </div>


                    <div class="inline-flex items-center justify-start gap-x-2 ml-auto">
                        <select class="px-4 py-1.5 border-gray-400 appearance-none text-white rounded" x-model="apiShowItem" name="showValues" id="showValues">
                            <!-- <option :selected="'all' == apiShowItem" value="all">Toon alle onderdelen</option> -->
                            <template x-for="(item, index) in apiData" :key="index">
                                <option :selected="index == apiShowItem" x-text="'Toon onderdeel ' + (index + 1)" :value="index"></option>
                            </template>
                        </select>
                        <button @click="apiView = 'card'" :class="apiView === 'card' ? 'px-4 py-1.5 bg-blue-600 text-white rounded' : 'px-4 py-1.5 bg-white border rounded'" type="button">Toon kaartjes</button>
                        <button @click="apiView = 'code'" :class="apiView === 'code' ? 'px-4 py-1.5 bg-blue-600 text-white rounded' : 'px-4 py-1.5 bg-white border rounded'" type="button">Toon code</button>
                    </div>
                </div>

                <!-- Code view -->
                <template x-if="apiData && apiView === 'code'">
                    <div class="cardcontainer">
                        <div class="carditem mt-2 bg-white p-3 border rounded">
                            <pre x-text="JSON.stringify([apiData[apiShowItem]], null, 2)"></pre>
                        </div>
                    </div>
                </template>

                <!-- Card view -->
                <template x-if="apiData && apiView === 'card'">
                    <div class="cardcontainer">
                        <raadhuis-apicard :data="[apiData[apiShowItem]]"></raadhuis-apicard>
                    </div>
                </template>
            </div>
        </template>
    </div>

    <!-- Data tonen -->
    <div class="">
        <form action="#" class="w-full bg-white p-5 rounded border mb-8 h-[250px]">
            <!-- API URL invoer -->
            <div class="mb-4">

                <!-- WP REST URL invoer -->
                <div class="mb-4">
                    <label for="wpUrl" class="block text-sm font-medium text-gray-700">WP REST URL</label>
                    <input type="text" x-model="wpUrl" id="wpUrl" placeholder="https://api.example.com/data" class="w-full mt-1 p-2 border rounded">
                </div>

                <div class="mb-4 flex flex-row flex-nowrap items-center justify-start gap-2 mt-4">
                    <input type="checkbox" id="overwrite" placeholder="********" class="" />
                    <label for="overwrite" class="block text-sm font-medium text-gray-700">Data overschrijven?</label>
                </div>
            </div>

            <button @click="fetchWPData" type="button" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded">WordPress data ophalen</button>
        </form>

        <!-- Results -->
        <template x-if="wpData">
            <div>
                <div class="flex flex-wrap w-full gap-x-4 jusitfy-between mb-4">
                    <div class="flex flex-col">
                        <h2 class="text-lg font-bold">WordPress voorbeeld data</h2>
                        <div class="flex flex-row flex-wrap text-sm">
                            <span x-text="wpData.length + ' onderdelen'"></span>
                        </div>
                    </div>
                    <div class="inline-flex items-center justify-start gap-x-2 ml-auto">
                        <select class="px-4 py-1.5 border-gray-400 appearance-none text-white rounded" x-model="wpShowItem" name="showValues" id="showValues">
                            <!-- <option :selected="'all' == wpShowItem" value="all">Toon alle onderdelen</option> -->
                            <template x-for="(item, index) in wpData" :key="index">
                                <option :selected="index == wpShowItem" x-text="'Toon onderdeel ' + (index + 1)" :value="index"></option>
                            </template>
                        </select>
                        <button @click="wpView = 'card'" :class="wpView === 'card' ? 'px-4 py-1.5 bg-blue-600 text-white rounded' : 'px-4 py-1.5 bg-white border rounded'" type="button">Toon kaartjes</button>
                        <button @click="wpView = 'code'" :class="wpView === 'code' ? 'px-4 py-1.5 bg-blue-600 text-white rounded' : 'px-4 py-1.5 bg-white border rounded'" type="button">Toon code</button>
                    </div>
                </div>

                <!-- Code view -->
                <template x-if="wpData && wpView === 'code'">
                    <div class="cardcontainer">
                        <div class="carditem mt-2 bg-white p-3 border rounded">
                            <pre x-text="JSON.stringify([wpData[wpShowItem]], null, 2)"></pre>
                        </div>
                    </div>
                </template>

                <!-- Card view -->
                <template x-if="wpData && wpView === 'card'">
                    <div class="cardcontainer">
                        <raadhuis-wpcard :data="[wpData[apiShowItem]]"></raadhuis-wpcard>
                    </div>
                </template>
            </div>
        </template>
    </div>

    <?php include_once(WP_PLUGIN_DIR . '/raadhuis-api-import-mapper/admin/partials/api-card-item.php') ?>
    <?php include_once(WP_PLUGIN_DIR . '/raadhuis-api-import-mapper/admin/partials/wp-card-item.php') ?>
</div>