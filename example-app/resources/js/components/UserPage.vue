<template>


  <div class="profile-overlay-test"></div>


  <div class="profile-container">

    <div class="profile-image">
      <img :src="`${user.avatar}`">
      <div class="profile-image-bottom-div">

        <div v-for="pet in Pets">
          <div title="{{ pet.name }}" class="profile-bottom-button">
            <img @click="showModalEdit(pet)" :src="`${pet.avatar}`">
          </div>
        </div>
 <!--======================= добавити public для сервера ================================= -->
        <div v-if="myPage && Pets.length<3" class="profile-bottom-button">
          <img @click="showModalAdd" :src="'/img/addPet.png'">
        </div>

        <!-- вікно інформація про тварину  -->
     <div class="profile-modal-info" v-if="showModalInfoPet">
          <div class="profile-modal-info-content">
            <span @click="closeModalEdit"> &#10006;</span>
            <h4>інформація про тварину</h4>
            <div class="profile-modal-info-input-fields-content">

              <div class="profile-modal-info-input-info">
                <p>Кличка</p>
                <p>Вид улюбленця</p>
                <p>Стать</p>
                <p>Вік</p>
              </div>

              <div class="profile-modal-info-input-text">    
                <p>{{PetEdit.name}}</p>
                <p>{{PetEdit.kind_of}}</p>
                <p>{{PetEdit.gender}}</p>
                <p>{{PetEdit.age}}</p>
              </div>

              <div class="profile-modal-info-input-photo-content">
                <div class="profile-modal-info-input-photo">
                  <img :src="`${PetEdit.avatar}`">
                </div>
              </div>
            </div>

            <div class="profile-modal-info-input-about-pet-content">
              <div class="profile-modal-info-input-about-pet">
                <p>Про улюбленця</p>
              </div>

              <div class="profile-modal-info-input-about-pet-text">
                <textarea v-model="PetEdit.about" name="" rows="6" readonly></textarea>
              </div>
            </div>
            <div class="profile-modal-button-content"> </div>
          </div>
        </div>

        <!-- вікно редагування -->
        <div class="profile-modal-add" v-if="showModalEditPet">
          <div class="profile-modal-add-content">
            <span @click="closeModalEdit"> &#10006;</span>
            <h4>редагування</h4>
            <div class="profile-modal-add-input-fields-content">

              <div class="profile-modal-add-input-info">
                <p>Кличка</p>
                <p>Вид улюбленця</p>
                <p>Стать</p>
                <p>Вік</p>
              </div>
              <div class="profile-modal-add-input-text">
                <input type="text" v-model="PetEdit.name" placeholder="імя тварини..." />
        
                <select v-model="PetEdit.kind_of" name="options">
                  <option value=""> </option>
                  <option value="Жінка">собака </option>
                  <option value="Чоловік">кіт</option>
                </select>

                <select v-model="PetEdit.gender" name="options">
                  <option value=""> </option>
                  <option value="Жінка">Жінка </option>
                  <option value="Чоловік">Чоловік</option>
                  <option value="Нон-бінарний">Нон-бінарний</option>
                  <option value="Чоловік">Поза гендером</option>
                  <option value="Бігендер">Бігендер</option>
                </select>

                <input v-model="PetEdit.age" class="profile-modal-add-input-number" type="number" min="1" max="100">
              </div>

              <div class="profile-modal-add-input-photo-content">
                <div class="profile-modal-add-input-photo">
                  <input type="file" ref="fileInput" style="display: none" @change="onFileSelected">
                  <img :src="`${PetEdit.avatar}`">
                  <img @click="openFileInput"
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQJODoz1fSZOpbbKokY2sMWoOkIojZDba9BprAO_dtzaslXlxCtKoFnbgS9JelQv7MCi0I&usqp=CAU">
                  <span @click="openFileInput">вибрати фото</span>
                  <p v-if="selectedFileName"> {{ selectedFileName }}</p>
                </div>
              </div>
            </div>

            <div class="profile-modal-add-input-about-pet-content">
              <div class="profile-modal-add-input-about-pet">
                <p>Про улюбленця</p>
              </div>
              <div class="profile-modal-add-input-about-pet-text">
                <textarea v-model="PetEdit.about"   name="" rows="6"></textarea>
              </div>
            </div>
            <div class="profile-modal-button-content">
              <button class="profile-edit-modal-button" @click="deletePet(PetEdit.id)">видалити тварину</button>
              <button class="profile-edit-modal-button" @click="EditPet">Редагувати тварину</button>
            </div>
          </div>
        </div>

        <!-- вікно добавлення  тварини-->
        <div class="profile-modal-add" v-if="showModalAddPet">
          <div class="profile-modal-add-content">
            <span @click="closeModalAdd"> &#10006;</span>
            <h4>Додати улюбленця</h4>
            <div class="profile-modal-add-input-fields-content">

              <div class="profile-modal-add-input-info">
                <p>Кличка</p>
                <p>Вид улюбленця</p>
                <p>Стать</p>
                <p>Вік</p>
              </div>
              <div class="profile-modal-add-input-text">
                <input type="text" v-model="textInput" placeholder="імя тварини..." />
      
                <select v-model="kindOfPet" name="options">
                  <option value=""> </option>
                  <option value="Жінка">собака </option>
                  <option value="Чоловік">кіт</option>
                </select>

                <select v-model="genderPet" name="options">
                  <option value=""> </option>
                  <option value="Жінка">Жінка </option>
                  <option value="Чоловік">Чоловік</option>
                  <option value="Нон-бінарний">Нон-бінарний</option>
                  <option value="Чоловік">Поза гендером</option>
                  <option value="Бігендер">Бігендер</option>
                </select>
      
                <input class="profile-modal-add-input-number" v-model="agePet"  type="number" min="1" max="100">
              </div>

              <div class="profile-modal-add-input-photo-content">
                <div class="profile-modal-add-input-photo">
                  <input type="file" ref="fileInput" style="display: none" @change="onFileSelected">
                  <img @click="openFileInput"
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQJODoz1fSZOpbbKokY2sMWoOkIojZDba9BprAO_dtzaslXlxCtKoFnbgS9JelQv7MCi0I&usqp=CAU">
                  <span @click="openFileInput">вибрати фото</span>
                  <p v-if="selectedFileName"> {{ selectedFileName }}</p>
                </div>
              </div>
            </div>

            <div class="profile-modal-add-input-about-pet-content">
              <div class="profile-modal-add-input-about-pet">
                <p>Про улюбленця</p>
              </div>
              <div class="profile-modal-add-input-about-pet-text">
                <textarea  v-model="aboutPet"  name="" rows="6"></textarea>
              </div>
            </div>
            <div class="profile-modal-add-button-content">
              <button class="profile-add-modal-button" @click="PetStore">Додати тварину</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="profile-info-container">
      <div class="profile-user-name-button">
        <div class="profile-user-name">
          <h3><strong>{{ user.first_name }}</strong> &nbsp;
            <strong>{{ user.last_name }}</strong>
          </h3>
        </div>

        <div v-if="thisUser.id != user.id" class="profile-user-button">
          <a class="profile-button-orange" v-if="checkIfFriend" @click="deleteFriend" >видалити з друзів</a>
          <p v-if="checkFriendsRequest">запит на дружбу відправлений</p>
          <a v-if="!checkIfFriend && !checkFriendsRequest" class="profile-button-orange" @click="addFriends">добавити в друзі</a>
          <a class="profile-button-sending-message" :href="`/sendingMessage/${this.user.id}`">Написати</a>
        </div>

      </div>
      <div class="profile-user-info-container">
        <div class="profile-user-info">

          <div v-if="user.nick_name" class="profile-info-field"><b>Нікнейм: </b> {{ user.nick_name }}</div>

          <div v-if="user.gender" class="profile-info-field"><b>Стать: </b> {{ user.gender }}</div>

          <div v-if="user.city" class="profile-info-field"><b>Місто: </b> {{ user.city }}</div>

          <div v-if="user.date_of_birth" class="profile-info-field"><b>Дата народження: </b> {{ user.date_of_birth }}
          </div>

        </div>
        <div class="profile-user-description">
          <a :href="`/pageFriends/${this.user.id}`">
            <p><b>Друзі:</b> {{ friendsCount }}</p>
          </a>
          <div v-if="user.about_me" class="profile-info-field">
            <b>Про себе: </b>{{ user.about_me }}
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="profile-post-container">
    <Post :id="user.id" :thisUser="thisUser" />
  </div>
</template>

<script>
import Post from './Post'
export default {

  components: {
    Post,
  },

  data() {
    return {
      selectedFile: null,
      textInput: null,
      showModalAddPet: false,
      showModalEditPet: false,
      selectedFileName: '',
      Pets: [],
      PetEdit: [],
      PetEditOriginal: [],
      myPage: false,
      checkIfFriend: false,
      checkFriendsRequest: false,
      showModalInfoPet: false,

      kindOfPet: '',
      genderPet: '',
      agePet: '',
      aboutPet: '',
      friendsCount: '',

    };
  },


  props: {
    user: {//користувач на чію сторінку ми перейшли 
      type: Object,//Number,// String,id
      required: true
    },
    thisUser: {// зареєстрований користувач
      type: Object,
      required: true
    },
  },

  created() {

    if (this.user.id == this.thisUser.id)
      this.myPage = true;

    this.getPets();
    this.getCheck();
    this.getFriends();
  },

  methods: {

    closeModalEdit() {
      this.showModalEditPet = false;
      this.PetEdit = null;
      this.PetEditOriginal = null;

      this.showModalInfoPet = false;
    },

    showModalEdit(pet) {

      this.PetEdit = JSON.parse(JSON.stringify(pet));
      if (this.myPage) {
        this.showModalEditPet = true;
        this.PetEditOriginal = JSON.parse(JSON.stringify(pet));
      }
      else
        this.showModalInfoPet = true;
    },

    openFileInput() {
      this.$refs.fileInput.click();
    },

    onFileSelected(event) {
      this.selectedFile = event.target.files[0];
      this.selectedFileName = this.selectedFile.name;
    },

    //вікно добавлення тварини
    showModalAdd() {
      this.showModalAddPet = true;
    },
    closeModalAdd() {
      this.showModalAddPet = false;
    },

    deleteFriend() {
      axios.post('/api/deleteFriendVueJs/', { id: this.user.id })
        .then(data => {
          this.checkFriendsRequest = false;
          this.checkIfFriend = false;
        })
        .catch(error => {
          console.log(error.response.data);
        });
    },

    addFriends() {
      axios.post('/api/friendRequest/', { id: this.user.id })
        .then(data => {
          this.checkFriendsRequest = data.data;
          // console.log(data.data);
        })
        .catch(error => {
          console.log(error.response.data);
        });
    },

    getFriends() {
      axios.post('/api/getFriendsCount/', { id: this.user.id })
        .then(data => {
          // console.log(data.data);
           this.friendsCount= data.data;
        })
        .catch(error => {
          console.log(error.response.data);
        });
    },

    deletePet(id) {
      axios.post('/api/deletePets', { id: id })
        .then(data => {
          this.Pets = data.data;
        })
        .catch(error => {
          console.log(error.response.data);
        });

      this.showModalEditPet = false;
      this.$refs.fileInput.value = null;
      this.selectedFile = null;
      this.selectedFileName = '';
    },


    EditPet() {
      let dataChanged = false;
      const formData = new FormData();

      for (const key in this.PetEditOriginal) {
        if (this.PetEditOriginal[key] !== this.PetEdit[key]) {
          dataChanged = true;
          formData.append(key, this.PetEdit[key]);
        }
      }

      if (dataChanged || this.selectedFile) {
        formData.append('id', this.PetEdit.id);
        formData.append('file', this.selectedFile);

        axios.post('/api/PetUpdate', formData, {
          headers: { 'Content-Type': 'multipart/form-data' }
        }).then(data => {
          //console.log(data.data);
          this.Pets = data.data;
        },).catch(error => {
          console.log(error);
        });
      }

      this.showModalEditPet = false;
      this.$refs.fileInput.value = null;
      this.selectedFile = null;
      this.textInput = null;
      this.selectedFileName = '';
      this.PetEdit = null;
      this.PetEditOriginal = null;
    },

    //перевірка чи друг чи відправлено запит на дружбу
    getCheck() {
      axios.post('/api/getCheckUser', { id: this.user.id })
        .then(data => {
          this.checkIfFriend = data.data['checkIfFriend'];
          this.checkFriendsRequest = data.data['checkFriendsRequest'];
        })
        .catch(error => {
          console.log(error.response.data);
        });
    },

    getPets() {
      axios.post('/api/getPets', { id: this.user.id })
        .then(data => {
          this.Pets = data.data;
        })
        .catch(error => {
          console.log(error.response.data);
        });
    },

    PetStore() {
      if (!this.selectedFile) {
        alert('Please select a file');
        return;
      }

      const formData = new FormData();
      formData.append('file', this.selectedFile);
      formData.append('name', this.textInput);

      formData.append('kindOfPet', this.kindOfPet);
      formData.append('genderPet', this.genderPet);
      formData.append('agePet', this.agePet);
      formData.append('aboutPet', this.aboutPet);

      axios.post('/api/PetStore', formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }).then(data => {
        //console.log(data.data);
        this.Pets = data.data;
      },).catch(error => {
        console.log(error);
      });

      this.showModalAddPet = false;
      this.$refs.fileInput.value = null;
      this.selectedFile = null;
      this.textInput = null;
      this.selectedFileName = '';
    },

  }



}
</script>
