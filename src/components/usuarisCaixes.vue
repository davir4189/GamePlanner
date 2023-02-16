<template>
    <div class="container-1">
        <p class="name" id="name">{{ item.nom }}</p>
        <p class="role" id="role">{{ item.rol }}</p>
        <div class="container-2">
            <div class="div2">
                <RouterLink to="employees/editEmployee">
                    <button class="button" id="edit" name="edit">Edit</button>
                </RouterLink>
            </div>

            <div class="div2-2">
                <RouterLink to="/employees">
                    <button class="button" id="delete" name="delete">Delete</button>
                </RouterLink>
            </div>
        </div>
    </div>
</template>

<script>
export default{
    name:"usuarisCaixes",
    props:['item']
}
</script>

<style src="../../styles/employees.css" scoped>

</style>