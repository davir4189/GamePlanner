<template>
    <!-- V-IF segun la usuari que nos llegue -->
    <iniciAdmin></iniciAdmin>
    <iniciGestor></iniciGestor>
    </template>

<script>
import iniciAdmin from '@/components/iniciAdmin.vue';
import iniciGestor from '@/components/iniciGestor.vue';
export default{
    name:"iniciOpcions",
    components:{iniciAdmin,iniciGestor}
}
</script>
    
    <style>

    </style>