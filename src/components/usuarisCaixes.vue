<template>
    <div class="container-1" :id="item.idUsuari">
        <p class="name" id="name">{{ item.nom }}  {{ item.cognom }}</p>
        <p class="role" id="role">{{ item.idUsuari }}</p>
        <p class="role" id="role">{{ item.rol }}</p>
        <div class="container-2">
            <div class="div2">
                <RouterLink to="employees/editEmployee">
                    <button class="button" :id="'edit-' + item.idUsuari" name="edit">Edit</button>
                </RouterLink>
            </div>

            <div class="div2-2">
                    <button class="button" :id="'delete-' + item.idUsuari" name="delete">Delete</button>
            </div>
        </div>
    </div>
</template>

<script>
export default{
    name:"usuarisCaixes",
    props:['item'],
    methods: {
        //funcion mirar rol
        mirarRol(){
            //si rol admin, cambiamos estilo caja
            if(this.item.rol === "admin"){
                var admins = document.getElementById(this.item.idUsuari)
                admins.classList.add("admins");

                var editButton = document.querySelector('#edit-' + this.item.idUsuari);
                var deleteButton = document.querySelector('#delete-' + this.item.idUsuari);
                editButton.disabled = true;
                deleteButton.disabled = true;
                editButton.style.opacity = "70%";
                deleteButton.style.opacity = "70%";
            }
        }
    },
    mounted(){
        this.mirarRol();
    }

}
</script>

<style src="../../styles/employees.css" scoped>

</style>