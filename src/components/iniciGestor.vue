<template>
    <div class="div1">
        <RouterLink to="/works">
            <button class="works" id="works" name="works">WORKS</button>
        </RouterLink>
    </div>

    <div class="div2">
        <RouterLink to="/myWorks">
            <button class="myWorks" id="myWorks" name="myWorks">MY WORKS</button>
        </RouterLink>
    </div>
</template>

<script>
    export default{
        name:"iniciGestor"
    }
</script>

<style src="../../styles/gestor.css" scoped>

</style>