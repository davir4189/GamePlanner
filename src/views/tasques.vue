<template>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Works</title>
    </head>
    <body>
        <div class="header">
            <div class="header-1">
                <img src="../../images/logo.png" width="50" height="50" alt=""><p class="role">Works</p>
            </div>
            <div class="header-2"><button class="button-2" id="goBack">GO BACK</button></div>
        </div>

        <div>
            <hr>
        </div>

        <div class="containerButton">
            <button class="button-2">ADD TASK</button>
        </div>

        <div class="container">
            <tasquesCaixes>
                
            </tasquesCaixes>
        </div>

        <div class="footer">
            <p>Game Planner</p>
        </div>
    </body>
    </html>

</template>

<script>
    import tasquesCaixes from '@/components/tasquesCaixes.vue';

    export default{
        name:"totesTasques",
        components:{tasquesCaixes}
    }
</script>

<style src="../../styles/works.css" scoped>

</style>