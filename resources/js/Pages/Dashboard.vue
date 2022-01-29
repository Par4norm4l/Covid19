<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 bg-white border-b pb-8 border-gray-200">
                        
                        <div class="flex">

                            <div class="w-1/2">
                                <div id="map" 
                                    class="relative w-full h-96"
                                ></div>
                            </div>
                           
                            <div class="block bg-white shadow rounded ml-20 pb-8 relative p-3">
                                <div class="flex items-center justify-around">
                               <img src="data:image/png;base64,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" class="w-10"/>
                               <h1 class="text-3xl">
                                World Statistics
                                </h1>   
                              </div>
                              <div class="shadow rounded  ml-10 p-6 flex text-center gap-2">
                                <div class=" p-1 shadow bg-white0 rounded">
                                                <h1 class="w-1/2 p-1 text-indigo-400 text-sm">    
                                                TodaysCases
                                                </h1>
                                                <h1 class="text-indigo-400">
                                                    {{ this.covidstatistics.todayCases }}
                                                    
                                                </h1>
                                            </div>
                                            <div class=" w-1/2 p-1  shadow bg-white rounded">
                                                <h1 class="text-indigo-400 text-sm">
                                                TodaysDeaths
                                                </h1>
                                                 <h1 class="text-indigo-400">
                                                    {{ this.covidstatistics.todayDeaths }}
                                                </h1>
                                            </div>
                                            <div class="w-1/2 p-1 shadow bg-white rounded">
                                                
                                                <h1 class="text-indigo-400 text-sm">
                                                TodaysRecovered
                                                </h1>
                                                <h1 class="text-indigo-400">
                                                    {{ this.covidstatistics.todayRecovered }}
                                                </h1>
                                </div>  
                            </div>
                             
                              </div>
                            
                        </div>
                        <div class="w-1/2 relative">
                              <div class="block bg-white shadow rounded relative  mt-5 ml-20 p-3">
                                <h3>Add Your Country</h3>
                                <Select2 
                                v-model="visitedCountry" 
                                :settings="{ width: '80%', 
                                ajax: { 
                                     url: '/api/countries/list',
                                     dataType: 'json'
                                     } 
                                }" 
                                @select="selectVisitedCountry($event)" 
                                />
                                <a @click="addVisitedCountry" class="rounded bg-indigo-300 hover:bg-indigo-400 px-4 py-1 shadow pointer
                                    absolute right-3 top-8
                                ">Add</a>
                                <br />
                                <div v-for="country in visitedCountries" :key="country.id"
                                    class = "p-2 border-b-2 relative"
                                >
                                    <p class="text-violet-900 text-xl text-center">
                                        {{ country.name }}    
                                    </p>
                                    <p class="text-violet-700 ">
                                    TodaysCases =
                                    {{this.VisitedCountriesinfo[country.country_code]['todayCases']}}
                                    </p>
                                    <p class="text-violet-700 ">
                                    TodaysDeath =
                                    {{this.VisitedCountriesinfo[country.country_code]["todayDeaths"]}}
                                    </p>
                                    <p class="text-violet-700">
                                    TodaysRecovered =
                                    {{this.VisitedCountriesinfo[country.country_code]["todayRecovered"]}}
                                    </p>
                                    <a href="javascript:void(0)"
                                    @click="removeVisitedCountry(country.id)"
                                    class="absolute right-1 top-2"
                                    ><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAABmJLR0QA/wD/AP+gvaeTAAACdUlEQVR4nO2aPWsUURSGnzuTrCa7ssY6acQEhHQWxkbX0lp3/drGRpBU4n/QQoygBksDiRiyrZUgxsYEBP9A1MagBBuNH5FJZo9FNmo0s5nMzniUOU8zA/fec5954R524YJhGIZhGHnFZVn83OjTox5yCxgG/JhG75xwe3K8ci1Lt5/bZUT18rN9u4LgFbA3WQV3emr82EyqUlvQlVXhwmpwmNbHC8w5WIy5tLq+Rk4A/28AHpRk491xc/JOpRFnXX10VgAcFLNy+xXvb2zyL5O4B5y/9GTEee5Km8r9CCOt93kk9hE41XouAvNt5s1NjVfGYtaMJPER8Hw3IPJD9k9k0/tIgi36oU39lMj9Ech9ADvuAfXR2RkA33cHw1CG01eKh++5j2FTHgFIU8bu3z3erl9EkqQHVAHCULablylhU8obLp7vGrRvmJHk/ghYANoC2iTpAQ2A3p6u/lKx+8hWE1a+rbHW6hF7it2pjwMEQbj4YTmYA2iG8mbnn7FO4l+C96YXqiBb/ll5u/SVz19WARjaX059vEXjwpmhWgL1TeT+CFgA2gLaWADaAtpYANoC2lgA2gLaWADaAtpYANoC2lgA2gLaWADaAtpYANoC2lgA2gLaWADaAtpYANoC2uQ+gMR3hJyTpkRcEejZ3b5sp+MAIlG774xO7gm+jxroKxfoKxciF3Y6DuCcW4rhuC2Jj0Cv63kOfEpDIgmCe5xGncQB1GoDKwjX05BIwIuSd+BhGoU6aoJFf/CqEx6kIRIXBy+R8GSt5sKU6nWGiLiJ6YWzwEXnOCRQSsHrdwLgtSAzhTXvRr0+uJzBHoZhGIZh5Izvx2mmbR11DwwAAAAASUVORK5CYII=" class="w-8"/></a>    
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

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Select2
    },
       data() {
        return {
            visitedCountry: '',            
            visitedCountries: [],
            VisitedCountriesinfo: {}, 
            covidstatistics: {},
            map: null
        }
    },
    methods: {
        selectVisitedCountry({id, text}){
            console.log({id, text})
        },
        addVisitedCountry(){
            if(this.visitedCountry !== "")
            {
                axios.post("/api/add-visited-country", 
                {
                    countryID: this.visitedCountry
                }
                ).then((response) => {
                    this.getVisitedCountries(); 
                    this.map.updateChoropleth({ 
                        [response.data.country_code] : '#FF0000'
                        
                    });
                });
            }else{
                console.log("country is not selected from selector!");
            }

        },
        removeVisitedCountry(countryID){
            axios.delete("/api/remove-visited-country/"+countryID)
            .catch(function(error){
                console.log(error);
            }).then((response) => {this.getVisitedCountries();
                this.map.updateChoropleth({
                    [response.data.country_code] : '#ABDDA4'
                });
            });
        },
        getVisitedCountries(){
            axios.get("/api/countries/visited")
                .then((response) => {this.visitedCountries = response.data;
                });
        },
        GetCovidCases(countryID) {
            
            let url = `https://disease.sh/v3/covid-19/countries/georgia`;
            axios.get(url).then((response) => (this.VisitedCountriesinfo[countryID] = response.data))
                .catch((error) => console.log(error));
        },
        GetCountriesStatistics() {
            axios.get("https://disease.sh/v3/covid-19/all").then((response) => (this.covidstatistics = response.data))
                .catch((error) => console.log(error));
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

    created(){
        this.GetCovidCases();
        this.GetCountriesStatistics();
        this.getVisitedCountries();
            setTimeout(() => {
                this.initMap();
            }, 500);
    },

};
</script>
