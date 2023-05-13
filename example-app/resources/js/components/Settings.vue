<template>

<div>
  
    <h2>{{ user.id }}</h2>

    <div>
      <label>First Name:</label>
      <input type="text" v-model="user.first_name">
    </div>

    <div>
      <label>Last Name:</label>
      <input type="text" v-model="user.last_name">
    </div>

    <div>
      <label>Nick Name:</label>
      <input type="text" v-model="user.nick_name">
    </div>

    <div>
      <label>Email:</label>
      <input type="text" v-model="user.email">
      <p v-if="errors && errors.email">{{ errors.email[0] }}</p>
    </div>

    <!-- <div>
      <label>Birthday:</label>
      <input type="date" v-model="user.birthday">
    </div> -->

    <button @click="saveChanges">Save Changes</button>
  </div>


  </template>
  
  <script>
  export default {
    props: {
      user: {
        type: Object,
        required: true,
      },
    },
  
    data() {
      return {
        originalUser: null,
        errors: {
            first_name: [],
            last_name: [],
            nick_name: [],
            email: [],
            password: []
         }
      };
    },
  
    created() {
      this.originalUser = JSON.parse(JSON.stringify(this.user));
    },
  
    methods: {
      saveChanges() {
        let dataChanged = false;
        for (const key in this.user) {
          if (this.user[key] !== this.originalUser[key]) {
            dataChanged = true;
            break;
          }
        }
  
        if (dataChanged) {
        console.log("дані змінено");

        axios.post('/api/settings',{ user: this.user })
            .then(response => {
                console.log( response.data);
                this.errors = {};
            })
            .catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors;
                } else {
                    console.log(error);
                }
            });
        }

        //this.originalUser = JSON.parse(JSON.stringify(this.user));

    

      },
    },
  };
  </script>
  
<style>
  
  
  
</style>

  