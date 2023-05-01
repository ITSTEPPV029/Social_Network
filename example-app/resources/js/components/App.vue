<template>
    <h1>{{ title }}</h1>
    
      <div v-for="user in users">
          <img style="height:100px;"  :src="`${user.avatar}`" ><br/>
           <strong>{{user.first_name}}</strong> 
           <strong>{{user.last_name}}</strong> 
           <strong>{{user.nick_name}}</strong> 
      </div>
  <br/>

</template>
<script>

export default {

    setup: () => ({
        title: 'Dolia'
    }),

    data(){
        return{
            users: null
        } 
    },

   mounted(){
    this.getUsers()
   },
   
    methods: {
        getUsers(){
            axios.get('/allUser').
            then(data=>{
                this.users=data.data   
            })               
        }
    }

}
</script>
