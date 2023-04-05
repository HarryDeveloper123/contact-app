<style>
.form-group {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
    padding-bottom: 0.5rem;
}
form {
    width: 25%;
    margin: auto;
}
button.btn-add-number{
    background-color: green;
    color: #fff;
    padding: 0.5rem;
    border: none;
    outline: none;
    box-shadow: none;
}
button.btn-add{
    background-color : blue;
    color: #fff;
    padding: 0.5rem;
}
.form-group {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
}
.text-center{
    width: 100%;
    text-align: center;
}


.filed select {
    width: 100%;
    display: block;
}

.form-group .filed {
    width: 100%;
}
.top-space{
    margin-top: 2rem;
}
</style>
<template>
    <div class="flex items-center justify-center h-screen">
      <div>
        <form @submit.prevent="addPost">
          <div class="left">
                  <router-link :to="{ name: 'index' }" class="btn-add">Back</router-link>
                    <!-- <RouterLink to="/contacts/create" class="btn-add"
                    >Add Contact</RouterLink> -->
                </div>
          <h2>Add Contact Form</h2>
          <div class="form-group">
            <div class="filed">
                <label for="">Name</label> <br>
                <input type="text" placeholder="Name" v-model="post.name" required>
            </div>
            <div class="filed">
                <label for="">Email</label><br>
                <input type="text" placeholder="Email" v-model="post.email" required>
            </div>
          </div>
          <div class="form-group top-space" >
            <div class="filed">
                <h4>Add Phone Number</h4>
            </div>
            <div class="filed">
                <button class="btn-add-number"> Add</button>
            </div>
          </div>
          <div class="form-group">
            <div class="filed">
                <select v-model="post.phone_type">
                    <option value="HOME" selected>Home </option>
                    <option value="WORK" selected>work </option>
                </select>
            </div>
            <div class="filed">
                <input type="text" placeholder="Number" v-model="post.phone_number" required>
            </div>
          </div>
          <div class="form-group top-space">
            <div class="filed">
                <h4>Add Address</h4>
            </div>
            <div class="filed">
                <button class="btn-add-number"> Add</button>
            </div>
          </div>
          <div class="form-group">
            <div class="filed">
                <input type="text" placeholder="address" v-model="post.address_line" required>
            </div>
            <div class="filed">
                <input type="text" placeholder="Pincode" v-model="post.pincode" required>
            </div>
          </div>
          <div class="text-center top-space">
              <button type="button" class="btn btn-primary" @click="createProduct()">Create</button>
          </div>
          
        </form>
      </div>
    </div>
</template>
  
<script >
import axios from 'axios'
    export default {
        data() {
            return {
                post: {}
            }
        },
        methods: {
            createProduct() {
                axios.post('http://127.0.0.1:8000/api/saveContact', this.post)
                    .then(response => (
                        this.$router.push({ name: 'index' })
                    ))
                    .catch(err => console.log(err))
                    .finally(() => this.loading = false)
            }
        }
    }
</script>