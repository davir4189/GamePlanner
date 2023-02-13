<template>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./myWorks.css" rel="stylesheet" type="text/css" content="width=device-width, initial-scale=1.0">
        <title>My Works</title>
    </head>
    <body>
        <div class="header">
            <div class="header-1">
                <img src="../../images/logo.png" width="50" height="50" alt="Logo Game Planner"><p class="role">My Works</p>
            </div>
            <div class="header-2">
                <RouterLink to="/amin">
                    <button class="button-2" id="goBack">GO BACK</button>
                </RouterLink>
            </div>
        </div>
        
        <div>
            <hr>
        </div>

        <div class="container">
            <myWorks>

            </myWorks>
        </div>

        <div class="footer">
            <p>Game Planner</p>
        </div>

    </body>
    </html>
</template>

<script>
    import myWorks from '@/components/myWorks.vue'

    export default{
        name:"misTrabajos",
        components:{myWorks}
    }
</script>
    
<style src="../../styles/myWorks.css">

</style>