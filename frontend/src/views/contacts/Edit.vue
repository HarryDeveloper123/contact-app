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
    <div>
        <h3 class="text-center">Edit Contact</h3>
        <div class="flex items-center justify-center h-screen">
            <div>
                <form @submit.prevent="updatePost">
                    <div class="form-group">
                      <div class="filed">
                          <label for="">Name</label> <br>
                          <input type="text" placeholder="Name" v-model="post.name">
                      </div>
                      <div class="filed">
                          <label for="">Email</label><br>
                          <input type="text" placeholder="Email" v-model="post.email">
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
                          <select>
                              <option value="HOME" selected>Home </option>
                              <option value="WORK" selected>Work </option>
                          </select>
                      </div>
                      <div class="filed">
                          <input type="text" placeholder="Number" v-model="post.get_type[0].phone_number ">
                      </div>
                    </div>
                    <div class="form-group top-space">
                      <div class="filed">
                          <h4>Add Phone Number</h4>
                      </div>
                      <div class="filed">
                          <button class="btn-add-number"> Add</button>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="filed">
                          <input type="text" placeholder="address" v-model="post.get_address[0].address_line">
                      </div>
                      <div class="filed">
                          <input type="text" placeholder="Pincode" v-model="post.get_address[0].pincode">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Post</button>
                </form>
            </div>
        </div>
    </div>
</template>
  
<script>
   import { reactive, ref, onMounted } from 'vue';
import { useRouter, useRoute } from 'vue-router';
    import axios from 'axios';
    export default {
        data() {
            return {
                post: {}
            }
        },
     
        created() {
          const router = useRouter();
    const route = useRoute();
          console.log(`${route.params.id}`)
            axios
                .get(`http://127.0.0.1:8000/api/edit/${route.params.id}`)
                .then((response) => {
                    this.post = response.data;
                    console.log(response.data);
                });
        },
        methods: {
            updatePost() {
              const router = useRouter();
              const route = useRoute();
              axios.post(`http://127.0.0.1:8000/api/updateContact/${route.params.id}`, this.post)
                    .then((response) => {
                        console.log("response",response);
                        router.push({name: 'index'});
                    });
            }
        }
    }
</script>