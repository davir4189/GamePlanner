<template>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Menu Gestor</title>
    </head>

    <body>
        <div class="header">
            <div class="header-1">
                <img src="../../images/logo.png" width="50" height="50" alt="Logo Game Planner" title="Game Planner"><p class="role">Admin</p>
            </div>
            <div class="header-2"><button class="button-2" id="logOut">LOG OUT</button></div>
        </div>

        <div>
            <hr>    
        </div>

        <!-- V-IF segun la usuari que nos llegue -->
        <div class="container">
            <iniciAdmin></iniciAdmin>
            <!-- <iniciGestor></iniciGestor>
            <iniciTecnic></iniciTecnic> -->
        </div>

        <footer>
            <div class="footer">
                <p>Game Planner</p>
            </div>    
        </footer>

    </body>
    </html>

</template>

<script>
import iniciAdmin from '@/components/iniciAdmin.vue';
// import iniciGestor from '@/components/iniciGestor.vue';
// import iniciTecnic from '@/components/iniciTecnic.vue';

export default{
    name:"iniciOpcions",
    components:{iniciAdmin,}
}
</script>
    
<style src="../../styles/admin.css" scoped>

</style>