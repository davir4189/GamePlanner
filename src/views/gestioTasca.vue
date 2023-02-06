<template>
   <afegirTasca></afegirTasca>
   <editarTasca></editarTasca>
    </template>
<script>
import afegirTasca from '@/components/afegirTasca.vue';
import editarTasca from '@/components/editarTasca.vue';

export default{
    name:"gestioTasca",
    components:{afegirTasca,editarTasca}
}
</script>
    <style>

    </style>