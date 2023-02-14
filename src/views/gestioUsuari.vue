<template>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./addEmployee2.css" rel="stylesheet" type="text/css" content="width=device-width, initial-scale=1.0">
        <title>Add Employee</title>
    </head>
    <body>
        <div class="header">
            <div class="header-1">
                <img src="../../images/logo.png" width="50" height="50" alt="Logo Game Planner" title="Game Planner"><p class="role2" title="Page">Add Employee</p>
            </div>
            <div class="header-2">
                <RouterLink to="/admin">
                    <button class="button-2" id="goBack" title="Go back">GO BACK</button>
                </RouterLink>
            </div>
        </div>

        <div>
            <hr>
        </div>

        <afegirUsuari></afegirUsuari>
        <editarUsuari></editarUsuari>

        <footer>
            <div class="footer">
                <div class="ft1">
                    <img src="../../images/facebook.png" alt="" width="30" height="30" class="imgFooter">
                    <img src="../../images/instagram.png" alt="" width="30" height="30" class="imgFooter">
                    <img src="../../images/twitter.png" alt="" width="30" height="30" class="imgFooter">
                </div>

                <div class="ft2">
                    <button class="ft3">Privacy policy</button>
                    <button class="ft3">Legal warning</button>
                    <button class="ft3">Cookies policy</button>
                </div>
            </div>    
        </footer>
    </body>
    </html>

</template>

<script>
    import afegirUsuari from '@/components/afegirUsuari.vue';
    import editarUsuari from '@/components/editarUsuari.vue';

    export default{
        name:"gestioUsuari",
        components:{afegirUsuari,editarUsuari}
    }
</script>
    
<style src="../../styles/addEmployee.css" scoped>

</style>