<style>
table.bg-color,
.top-header {
    margin: auto;
    width: 25%;
}
.top-header{
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.btn-add{
    background-color : blue;
    color: #fff;
    padding: 0.5rem;
}
table.bg-color, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
table.bg-color th {
    background: #dfdfdf;
}
table.bg-color td{
    text-align: center;
}
.text-primary{
    color: blue;
}
.text-danger{
    color: red;
}
</style>
<template>
    <main class="container ">
      <div class="flex flex-col">
        <div class="overflow-x-auto">
          <div class="p-1.5 w-full inline-block align-middle">
            
            
            <div class="mt-3 overflow-hidden border rounded-lg">
              <div class="top-header">
                <div class="left">
                    <h2>Contact List</h2>
                </div>
                <div class="left">
                  <router-link :to="{ name: 'create' }" class="btn-add">Add Contact</router-link>
                </div>
              </div>  
              <table class="bg-color" >
                <thead class="">
                  <tr>
                    <th
                      scope="col"
                     >
                      Name
                    </th>
                    <th
                      scope="col"
                    >
                      Email
                    </th>
                    <th
                      scope="col"
                    >
                      Phone
                    </th>
                    <th
                      scope="col"
                    >
                      Action
                    </th>
                  </tr>
                </thead>
                <tbody>
                    <tr  v-for="contact in contacts" >
                      <td>  {{ contact.name }} </td>
                      <td>  {{ contact.email }} </td>
                      <td>  {{ contact?.get_type[0]?.phone_number }} </td>
                     
                     
                      <td class="text-sm text-gray-800 whitespace-nowrap">
                         <router-link :to="{name: 'edit', params: { id: contact.id }}" class="btn btn-primary">Edit
                        </router-link>
                     
                      <button
                        @click.prevent="contactDelete(contact.id, index)"
                        class="text-red-600"
                      >
                        DELETE
                      </button>
                    </td>
                    </tr>
                    
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </main>
  </template>
  <script lang="ts">
  import axios from 'axios';
  import { onMounted, ref } from 'vue';
  export default {
    setup() {
      let contacts = ref([]);
  
      onMounted(() => {
        // fetch api from laravel backend
        axios
          .get('http://127.0.0.1:8000/api/showContact')
          .then((res) => {
            // console.log(res);
            contacts.value = res.data.data;

          })
          .catch((error) => {
            console.log(error.res.data);
          });
      });
      function contactDelete(id, index) {
        axios
          .get(`http://127.0.0.1:8000/api/deleteContact/${id}`)
          .then(() => {
            contacts.value.splice(index, 1);
          })
          .catch((error) => {
            console.log(error.response.data);
          });
      }
      return {
        contacts,
        contactDelete,
      };
    },
  };
  </script>