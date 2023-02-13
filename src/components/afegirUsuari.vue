<template>

    <div class="container">
        <div class="dades1">
            <input type="text" name="name" id="name" placeholder="Name" class="dades2">
            <input type="text" name="lastName" id="lastName" placeholder="Last name" class="dades2">
            <input type="text" name="email" id="email" placeholder="Email" class="dades2">
        </div>
    </div>

    <div class="container">
        <div class="dades1">
            <input type="password" name="password" id="password" placeholder="Password" class="dades2">
            <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password" class="dades2">
        </div>
    </div>

    <div class="container">
        <div class="dades1">
            <select name="role" id="role" class="dades3">
                <option disabled selected>Role</option>
                <option value="admin">Admin</option>
                <option value="manager">Manager</option>
                <option value="technical">Technical</option>
            </select>
        </div>
    </div>

    <RouterLink to="/employees">
        <div class="container">
            <button class="button-1" id="addEmployee">ADD EMPLOYEE</button>
        </div>
    </RouterLink>

</template>

<script>
export default{
    name:"afegirUsuari"
}
</script>

<style src="../../styles/addEmployee.css" scoped>

</style>