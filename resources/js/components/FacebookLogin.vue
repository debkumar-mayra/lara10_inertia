<template>
  
  <v-facebook-login app-id="641285517824665" @logout="logout" @login="handleLogin" @loginFailed="handleLoginFailed"></v-facebook-login>
  <!-- <v-facebook-login app-id="485074820359599" @logout="logout" @login="handleLogin" @loginFailed="handleLoginFailed"></v-facebook-login> -->
</template>


<script setup>
import VFacebookLogin from 'vue-facebook-login-component-next';
import 'vue-facebook-login-component-next/dist/style.css'
import { reactive, ref } from 'vue';


// const userValue = ref({ scope: 'email',return_scopes:true,enable_profile_selector:true});
const getuserValue = ref({});
const handleLogin = async (response) => {
  if (response.authResponse) {
    FB.api('/me', { fields: 'name, email' }, async (userData) => {
      const myArray = userData.name.split(" ");
      let pro = {
        "first_name": myArray[0],
        "last_name": myArray[1],
        "email": userData.email,
        "provider_id": userData.id,
        "provider_name": 'Facebook'
      }
       router.post(route('socialLogin'),pro);

      // if (res.status) {
      //   log
      // }



    });
  }
}

const handleLoginFailed = () => {
  console.log('fail');
}

const logout = () => {
  console.log('fail');
}

</script> 