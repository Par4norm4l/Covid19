<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Home
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        
                        <div class='flex'>
                            <div class="w-1/2">
                                <div id="map" 
                                    class="relative w-full h-96"
                                ></div>
                            </div>
                            <div class="w-1/2 relative">
                            <div class="block bg-white shadow shadow rounded relative p-3"> 
                                <h3>Visited Countries</h3>
                                <Select2 v-model="visitedCountry" 
                                :settings="{ 
                                    width: '80%',
                                    ajax:{
                                        url: '/api/countries/list',
                                        dataType: 'json'
                                    }
                                }" 
                                @select="selectVisitedCountry($event)" 
                                />
                                <a @click="addVisitedCountry"  class="rounded bg-cyan-300 hover:bg-cyan-200 px-4 py-1 shadow pointer
                                absolute right-3 top-8
                                ">Add</a>
                                <br />
                                <div v-for="country in visitedCountries" :key="country.id"
                                    class="p-2 border-b-2 relative">
                                    {{ country.name }}
                                    <a href="javascript:void(0)"
                                    @click="removeVisitedCountry(country.id)"
                                    class="absolute right-1 top-2">
                                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAABmJLR0QA/wD/AP+gvaeTAAACSklEQVRYhdWXTU8TURSGnzMfnX4gRQg1qWkCJmWhJGhCgn9B08REFia6RMOKv+DCn+CSNewNIn/Bj1UXykJjWACJtqgwFNrptHNdDC0kQDud1lHf3U3OnPeZue/cMwN/WXJ28UUpK+64i4g8RjENpAbkc4TwEaVWa5a5nBdxzgFsH6vraI03wMyATC9TEc8o5JKy2wbw77zxPgLzNkTNMu7mRRwNIO64ixGaA9yOO+4zAA0AJU8iNPclvqcPINyMHMAP+QkADEUOcOJphLnSbjZ5/rXEp6MaANOpOC9uZLhi6D330rqXnNd6+ZBRU2djZoKNmQlGTJ3Xe5UwrYI9gbLbYKtaZ6taRwEf7Cp1z+Plzh4A3x2XX24TTRQCTCZiTCZijJvd2wvAds1VnYo2flRYKx/w+bgehJepZIwH42nujXWOVi5uSqAtuD82xEJ2NJA5wEJ2tKt5S6Ey0NJsOsFsOtFPi3BvQdrUcT2PO6k4AJuVGqamceA2owF4dC1NtXkam/nMCAldWN752XOvUFugA7qcAuii6P0E6ANgkPo/AQ4bHvsNr73eb3gcnln3olAhXPm2D8DT7FUAXpXsUOahAVpaK1foeIQOEiB9waQrue6FtSM9TMXAGZhKxniYGcbS5NIaSxPmM8Pkk7HAAIGG0Z/S2WEUbpj3JxvaH6VsRm4vvufJR6laiRxAqdU2QM0yl4FihPZF2/f0AfIiDp5RiAiiiGcUbonU2wAAuaTs2pYxB2oJ4R2DDWYF4S2oJdsy5lr/hf+EfgOVMK4PgBOVqwAAAABJRU5ErkJggg=="/></a>
                                </div>
                            </div>
                            <div class="block bg-white shadow shadow rounded relative p-3 mt-6"> 
                                <h3>Countries To Visit</h3>
                                <Select2 v-model="toVisitCountry" 
                                :settings="{ 
                                    width: '80%',
                                    ajax:{
                                        url: '/api/countries/list',
                                        dataType: 'json'
                                    }
                                }" 
                                @select="selectToVisitCountry($event)" 
                                />
                                <a @click="addToVisitCountry"  class="rounded bg-cyan-300 hover:bg-cyan-200 px-4 py-1 shadow pointer
                                absolute right-3 top-8
                                ">Add</a>
                                <br />
                                <div v-for="country in toVisitCountries" :key="country.id"
                                    class="p-2 border-b-2 relative">
                                    {{ country.name }}
                                    <a href="javascript:void(0)"
                                    @click="removeToVisitCountry(country.id)"
                                    class="absolute right-1 top-2">
                                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAABmJLR0QA/wD/AP+gvaeTAAACSklEQVRYhdWXTU8TURSGnzMfnX4gRQg1qWkCJmWhJGhCgn9B08REFia6RMOKv+DCn+CSNewNIn/Bj1UXykJjWACJtqgwFNrptHNdDC0kQDud1lHf3U3OnPeZue/cMwN/WXJ28UUpK+64i4g8RjENpAbkc4TwEaVWa5a5nBdxzgFsH6vraI03wMyATC9TEc8o5JKy2wbw77zxPgLzNkTNMu7mRRwNIO64ixGaA9yOO+4zAA0AJU8iNPclvqcPINyMHMAP+QkADEUOcOJphLnSbjZ5/rXEp6MaANOpOC9uZLhi6D330rqXnNd6+ZBRU2djZoKNmQlGTJ3Xe5UwrYI9gbLbYKtaZ6taRwEf7Cp1z+Plzh4A3x2XX24TTRQCTCZiTCZijJvd2wvAds1VnYo2flRYKx/w+bgehJepZIwH42nujXWOVi5uSqAtuD82xEJ2NJA5wEJ2tKt5S6Ey0NJsOsFsOtFPi3BvQdrUcT2PO6k4AJuVGqamceA2owF4dC1NtXkam/nMCAldWN752XOvUFugA7qcAuii6P0E6ANgkPo/AQ4bHvsNr73eb3gcnln3olAhXPm2D8DT7FUAXpXsUOahAVpaK1foeIQOEiB9waQrue6FtSM9TMXAGZhKxniYGcbS5NIaSxPmM8Pkk7HAAIGG0Z/S2WEUbpj3JxvaH6VsRm4vvufJR6laiRxAqdU2QM0yl4FihPZF2/f0AfIiDp5RiAiiiGcUbonU2wAAuaTs2pYxB2oJ4R2DDWYF4S2oJdsy5lr/hf+EfgOVMK4PgBOVqwAAAABJRU5ErkJggg=="/></a>
                                </div>
                            </div>
                            </div>
                        </div> 

                        
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/inertia-vue3';
import Select2 from 'vue3-select2-component';
import axios from 'axios';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Select2,
    },
    data() {
        return {
            visitedCountry: '',
            toVisitCountry: '',
            visitedCountries: [],
            toVisitCoutries: [],
            map: null
        }
    },
     methods: {
        selectVisitedCountry({id, text}){
            // console.log({id, text})
        },
        selectToVisitCoountry({id, text}){
            // console.log({id, text})
        },
        addVisitedCountry(){
            if(this.visitedCountry !== "")
            {
                axios.post('/api/add-visited-country',
                {
                    countryID: this.visitedCountry
                }
                ).then((response) => {
                    this.getVisitedCountries();
                    this.map.updateChoropleth({ 
                        [response.data.country_code] : '#ff0000'
                    });
                });
            }else{
                console.log('Country is not selected from dropdown');
            }
        },
        addToVisitCountry(){
            if(this.toVisitCountry !== "")
            {
                axios.post('/api/add-country-to-visit',
                {
                    countryID: this.toVisitCountry
                }
                ).then((response) => {
                    this.getToVisitCountries();
                    console.log(response.data);
                    //@todo set color on the map fro the country
                });
            }else{
                console.log('Country is not selected from dropdown');
            }
        },
        removeVisitedCountry(countryID)
        {
            axios.delete("/api/remove-visited-country/"+countryID)
            .catch(function(error){
                console.log(error);
            }).then(() => {
                this.getVisitedCountries();
            });
        },
        removeToVisitCountry(countryID)
        {
               axios.delete("/api/remove-to-visit-country/"+countryID)
            .catch(function(error){
                console.log(error);
            }).then(() => {
                this.getToVisitCountries();
            });
        },
        getVisitedCountries()
        {
            axios.get('/api/countries/visited')
                .then((response) =>{
                    this.visitedCountries = response.data;
                });

        },
        getToVisitCountries()
        {
            axios.get('/api/countries/tovisit')
                .then((response) =>{
                    this.toVisitCoutries = response.data;
                });
        },
        initMap()
        {
            this.map = new Datamap({
            element: document.getElementById("map"),
            projection: 'mercator',
            fills: {
                defaultFill: "#ABDDA4",
                authorHasTraveledTo: "#fa0fa0"
            }
          });
        },
  },
    created() {
        this.getVisitedCountries();
    setTimeout(() => {
        this.initMap();
    }, 500 );
},
};
</script>


