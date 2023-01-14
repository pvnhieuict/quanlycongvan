<!-- 
    + Tao form tim kiem
    + List ket quan tra ve 
-->
<template>
    <div>
        <input type="text" v-model="keywords">
        <ul v-if="results.lenght>0">
            <li v-for="result in results" :key="result.id" v-text="result.name"></li>
        </ul>
    </div>
</template>
<script>
import { assertExpressionStatement } from '@babel/types';
import { response } from 'express';

    export default{
        data(){
            return{
                keywords:null,
                results:[]
            };
        },
        watch:{
            keywords(after,before){
                this.fetch();
            }
        },
        methods:{
            fetch(){
                axios
                    .get('/response-research',{params:{keywords:this.keywords}})
                    .then(response=>this.results = response.data)
                    .catch(error=>{});
            }
        }
    }
</script>
