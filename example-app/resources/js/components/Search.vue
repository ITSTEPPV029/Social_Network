<template>
<div class="search-container">
  <div class="search-users">           
  <h3>Результати пошуку</h3>
  <hr>
    <div  v-for="user in localUsers" class="search-user">
        <div class="search-img">
          <a :href="`/profile/${user.id}`"> <img :src="`${user.avatar}`" ></a> 
        </div>
      
        <div class="search-user-info">
            <strong>{{user.first_name}}</strong> 
            <strong>{{user.last_name}}</strong> 
            <div class="search-user-actions">
              <!-- <a href="{{route('friendRequest.friendRequest',$user) }}">добавити в друзі</a> -->
            </div>
        </div>  
    </div>
  </div>
  <div class="search-filter"> 

      <label>імя</label>
      <input  v-model="frist" type="text">  

      <input @click="applyFilter" class="inputSubmit" type="submit"  value="Фільтрувати">
  </div>
</div>

</template>

<script>

export default {

    data(){
        return{
          frist:'',
          localUsers: {},
        } 
    },
    props: {
      users: {
        type:  Object,
        required: true,
      }
    },
   mounted(){
    this.localUsers = { ...this.users }; 
   },

    methods: {
      applyFilter() {

        const formData = new FormData();

        formData.append('first', this.frist);

        //  formData.append('last_name', this.user.last_name);
        //  formData.append('email', this.user.email);
        //  formData.append('nick_name', this.user.nick_name);

        // formData.append('date_of_birth', this.user.date_of_birth);
        // formData.append('gender', this.user.gender);
        // formData.append('city', this.user.city);
        // formData.append('about_me', this.user.about_me);

       
      axios.post('/api/filter', formData, {
        headers: { 'Content-Type': 'multipart/form-data' }
        }).then(response => {
          this.localUsers = { ...response.data };
          
            })
            .catch(error => {
                console.log(error);
            });
        
      }
    }

}
</script>
