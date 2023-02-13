<template>
    <div class="container-1">
        <p class="name" id="name">ENDRIT QUKOVCI</p>
        <p class="role" id="role">Admin</p>
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
    name:"usuarisCaixes"
}
</script>

<style src="../../styles/employees.css" scoped>

</style>