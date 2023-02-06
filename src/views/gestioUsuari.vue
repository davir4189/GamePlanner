<template>
    <afegirUsuari></afegirUsuari>
    <editarUsuari></editarUsuari>
    </template>

<script>
import afegirUsuari from '@/components/afegirUsuari.vue';
import editarUsuari from '@/components/editarUsuari.vue';
export default{
    name:"gestioUsuari",
    components:{afegirUsuari,editarUsuari}
}
</script>
    
    <style>

    </style>