<template>
    <div>
        <h1>ActiveLeads Component</h1>
        <ul id="example-1">
            <li v-for="item in data" :key="item.name">
                {{ item.name }}
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props : {
            data : {
                type : Array,
                required : true
            }
        },

        mounted () {
            console.log( 'Component ActiveLeads mounted' );
            /*console.log( 'data:' );
            console.log( this.data );*/
        }
    }
</script>

<style>

</style>