<template>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Employees</title>
    </head>
    <body>
        <div class="header">
            <div class="header-1">
                <img src="../../images/logo.png" width="50" height="50" alt="Logo Game Planner" title="Game Planner"><p class="role2">Employees</p>
            </div>
            <div class="header-2"><button class="button-2" id="goBack">GO BACK</button></div>
        </div>

        <div>
            <hr>
        </div>

        <div class="containerButton">
            <button class="button-2" id="addEmployee">Add Employee</button>
        </div>

        <div class="container">
            <usuarisCaixes>
                
            </usuarisCaixes>
        </div>    

        <div class="footer">
            <p>Game Planner</p>
        </div>
    </body>
    </html>

</template>

<script>

import usuarisCaixes from '@/components/usuarisCaixes.vue';

export default{
    name:"totsUsuaris",
    components:{usuarisCaixes}
}

</script>

<style src="../../styles/employees.css" scoped>

</style>