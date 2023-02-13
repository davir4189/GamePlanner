<template>
    <div class="div1">
        <RouterLink to="/works">
            <button class="works" id="works" name="works">WORKS</button>
        </RouterLink>
    </div>

    <div class="div2">
        <RouterLink to="/employees">
            <button class="employees" id="employees" name="employees">EMPLOYEES</button>
        </RouterLink>
    </div>  
</template>

<script>
    export default{
        name:"iniciAdmin"
    }
</script>

<style src="../../styles/admin.css" scoped>

</style>