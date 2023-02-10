<template>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Game Planner</title>
    </head>
    <body>
        <div class="div1">
            <img src="../../images/logo2.png" class="logo" width="150" height="150" alt=""><br><br>
            <img src="../../images/slogan2.png" class="slogan" width="400" height="35" alt="">
        </div>

        <div class="div2">
            <loginComponent>
            
            </loginComponent>
        </div>
    </body>
    </html>
</template>

<script>
    import loginComponent from '@/components/loginComponent.vue';

    export default{
        name:"loginUsuaris",
        components:{loginComponent}
    }
</script>

<style src="../../styles/portada.css" scoped>
</style>
